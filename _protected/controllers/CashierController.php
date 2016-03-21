<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\rbac\models\Role;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class CashierController extends AppController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index' , 'create', 'view', 'update'],
                'rules' => [
                    [
                        'actions' => ['index' , 'create', 'view', 'update'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index' , 'create', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /**
         * How many users we want to display per page.
         * @var int
         */
        $pageSize = 11;

        /**
         * Only theCreator role can see all users.
         * Lower roles will not be able to see theCreator @see: search(). 
         * @var boolean
         */
        $dev = (Yii::$app->user->is('dev')) ? true : false ;

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->searchCashier(Yii::$app->request->queryParams, $pageSize, $dev);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     *
     * @param  integer $id The user id.
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = new User(['scenario' => 'create']);
        $role = new Role();

        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role]))
        {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            
            if ($user->save()) 
            {
                $role->user_id = $user->getId();
                $role->save(); 
            }  

            return $this->redirect('index');      
        } 
        else 
        {
            return $this->render('create', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    /**
     * Updates an existing User and Role models.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer $id The user id.
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        // get role
        $role = Role::findOne(['user_id' => $id]);

        // get user details
        $user = $this->findModel($id);

        // Dev/Master can update everyone`s roles
        // admin will not be able to update role of Dev/Master
        if (!Yii::$app->user->is('dev') || !Yii::$app->user->is('master')) 
        {
            if ($role->item_name === 'dev' || $role->item_name === 'master')
            {
                throw new ForbiddenHttpException('Unauthorized Access', 403);
            }
        }
        
        // load user data with role and validate them
        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role])) 
        {
            // only if user entered new password we want to hash and save it
            if ($user->password) 
            {
                $user->setPassword($user->password);
            }

            // if admin is activating user manually we want to remove account activation token
            if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null) 
            {
                $user->removeAccountActivationToken();
            }            

            $user->save(false);
            $role->save(false); 
            
            return $this->redirect(['view', 'id' => $user->id]);
        }
        else 
        {
            return $this->render('update', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param  integer $id The user id.
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // delete this user's role from auth_assignment table
        if ($role = Role::find()->where(['user_id'=>$id])->one()) 
        {
            $role->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param  integer $id The user id.
     * @return User The loaded model.
     *
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
