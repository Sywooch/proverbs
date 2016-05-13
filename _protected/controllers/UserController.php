<?php
namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use app\rbac\models\Role;
use app\rbac\models\AuthAssignment;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use Yii;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AppController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['user'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pjax'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],       
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'fetch' => ['post'],
                    'push' => ['post'],
                    'pjax' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dev = AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'dev' ? true : false ;

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->searchUser(Yii::$app->request->queryParams, $dev);
        
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

    public function actionPjax($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            $u = $this->findModel($object->uid);

            if($u->updated_at !== $object->upd){
                $data = array('pjax' => true, 'delta' => true, 'upd' => $u->updated_at);
            }else {
                $data = array('pjax' => false, 'delta' => false, 'upd' => $object->upd);
            }


            return $data;
        }
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
        if ($user->load(Yii::$app->request->post()) && $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role]))
        {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            
            if ($user->save()) 
            {
                $role->user_id = $user->getId();
                $role->save(); 
            }  

            Yii::$app->session->setFlash('success', implode(' ', [ucfirst($user->username), ' successfully created!']));
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
        if (AuthAssignment::getAssignment(Yii::$app->user->identity->id) !== 'dev' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) !== 'master') 
        {
            if($role === 'dev' || $role === 'master'){
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

            Yii::$app->session->setFlash('success', 'Saved successfully');
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

        Yii::$app->session->setFlash('success', 'Deleted successfully');
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
