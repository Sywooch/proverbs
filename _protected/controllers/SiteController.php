<?php
namespace app\controllers;

use app\models\Announcement;
use app\models\DataCenter;
use app\models\User;
use app\models\LoginForm;
use app\models\AccountActivation;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\rbac\models\AuthAssignment;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\web\Response;
use Yii;
use app\models\Board;
use app\models\BoardSearch;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'sbar', 'write', 'fetch', 'announcement', 'new-announcement'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'fetch' => ['post'],
                    'write' => ['post'],
                    'sbar' => ['post'],
                    'announcement' => ['post'],
                    'mail-check' => ['post'],
                    'cred-check' => ['post'],
                    'new-announcement' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionNewAnnouncement($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;

            $announcement = new Announcement();

            $object = json_decode($data);
            $announcement->content = $object->msg;
            if(!empty(trim($announcement->content)) ){
                Yii::$app->session->setFlash('success', 'New announcement created successfully!');
                $announcement->save();
            }

        }
    }

    public function actionSbar($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $data = json_decode($data);
            $val = $data->val;
            
            $val === 1 ? Yii::$app->session['sidebar'] = '' : Yii::$app->session['sidebar'] = 'sidebar-narrow';
            
            return array('val' => Yii::$app->session->get('sidebar'));
        }
    }
    

    public function actionWrite($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;

            $object = json_decode($data);
            $content = Html::encode($object->msg);

            if(!empty(trim($object->msg))){
                $board = new Board();
                $board->posted_by = Yii::$app->user->identity->id;
                $board->content = $content;
                $board->save();
            }
        }    
    }  

    public function actionFetch($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            $student = $this->findModel($object->uid);

            if($student->updated_at !== $object->upd){
                $data = array('pjax' => true, 'delta' => true, 'upd' => $student->updated_at);
            }else {
                $data = array('pjax' => false, 'delta' => false, 'upd' => $object->upd);
            }


            return $data;
        }
    }

    public function actionPjax($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            $student = $this->findModel($object->uid);

            if($student->updated_at !== $object->upd){
                $data = array('pjax' => true, 'delta' => true, 'upd' => $student->updated_at);
            }else {
                $data = array('pjax' => false, 'delta' => false, 'upd' => $object->upd);
            }


            return $data;
        }
    }

    public function action403(){
        if(Yii::$app->user->isGuest){
            throw new NotFoundHttpException('The requested page does not exist.');
        }else {
            return $this->render('403');
        }
    }

    public function action404(){

        return $this->render('404');
    }

    public function action500(){
        return $this->render('500');
    }

    public function actionMailCheck($email){
        $attempt = 0;

        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;

            if(empty(trim($email))){
                $attempt = 0;
                $object = (object) array('code' => 0, 'attempt' => $attempt);

                return $object;
            } else {
                if(!empty(strpos($email, '@'))){
                    $query = User::find()->where(['email' => $email])->all();
                    
                    if(!empty($query) && $email === $query[0]['email']){

                        if(!empty($query[0]['profile_image']) || $query[0]['profile_image'] !== null){
                            $foto = Yii::$app->request->baseUrl . '/uploads/users/' . $query[0]['profile_image'];
                            $object = (object) array('code' => 200, 'attempt' => $attempt, 'username' => $query[0]['username'], 'foto' => $foto);

                            return $object;
                        } else {
                            $foto = Yii::$app->request->baseUrl .'/uploads/ui/user-blue.png';
                            $object = (object) array('code' => 200, 'attempt' => $attempt, 'username' => $query[0]['username'], 'foto' => $foto);

                            return $object;
                        }

                    } else{ 
                        $object = (object) array('code' => 404, 'attempt' => $attempt);

                        return $object;
                    }
                } else {
                        $object = (object) array('code' => 505, 'attempt' => $attempt);

                        return $object;
                }
            }
        }
    }

    public function actionCred($data) {
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;

            $object = json_decode($data);        

            if( empty(trim($object->username)) && empty(trim($object->email)) ){
                $data = 
                    [
                        'usn' => 'null',
                        'email' => 'null',
                        'code' => 0,
                        'msg' => 'Username and Email cannot be blank'
                    ];

                return $data;
            } elseif( empty(trim($object->username)) ){
                $data = 
                    [
                        'usn' => 'null',
                        'email' => 'null',
                        'code' => 10,
                        'msg' => $empty_username
                    ];

                return $data;
            } elseif( empty(trim($object->email)) ){
                $data = 
                    [
                        'usn' => $object->username,
                        'email' => 'null',
                        'code' => 20,
                        'msg' => $empty_email
                    ];
                return $data;
            }
        }
    }

    public function actionAnnouncement($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            $current_count = DataCenter::countAnnouncement();

            if($object->upd !== $current_count){
                $data = array('pjax' => true, 'delta' => true, 'upd' => $current_count);
            }else {
                $data = array('pjax' => false, 'delta' => false, 'upd' => $object->upd);
            }

            return $data;
        }
    }

    public function actionIndex()
    {   
        if (Yii::$app->user->isGuest) 
            return $this->redirect('site/login');

        return $this->redirect(Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . '/dashboard');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if ($model->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } 
            else 
            {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending email.'));
            }

            return $this->refresh();
        } 

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }

        $lwe = Yii::$app->params['lwe'];

        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        $sidebar = Yii::$app->session->set('sidebar', '');
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            return $this->redirect(Yii::$app->request->baseUrl . '/dashboard');
        }
        elseif($model->status === User::STATUS_INACTIVE)
        {
            Yii::$app->session->setFlash('error', 'You have to activate your account first. Please check your email.');
            return $this->refresh();
        }    
        // ACOUNT ACTIVATED WITH ERRORS
        else
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . '/site/login');
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if ($model->sendEmail()) 
            {
                Yii::$app->session->setFlash('success', 
                    Yii::t('app', 'Check your email for further instructions.'));

                return $this->goHome();
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 
                    Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
            }
        }
        else
        {
            return $this->render('requestPasswordResetToken', [
                'model' => $model,
            ]);
        }
    }

    public function actionResetPassword($token)
    {
        try 
        {
            $model = new ResetPasswordForm($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) 
            && $model->validate() && $model->resetPassword()) 
        {
            Yii::$app->session->setFlash('success', Yii::t('app', 'New password was saved.'));

            return $this->goHome();
        }
        else
        {
            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }       
    }    

    public function actionSignup()
    {  
        $rna = Yii::$app->params['rna'];
        $model = $rna ? new SignupForm(['scenario' => 'rna']) : new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($user = $model->signup()) 
            {
                $this->signupWithActivation($model, $user);
                return $this->redirect('login');       
            }
            else
            {
                Yii::$app->session->setFlash('error', 
                    Yii::t('app', 'We couldn\'t sign you up, please contact us.'));
                Yii::error('Signup failed! 
                    User '.Html::encode($user->username).' could not sign up.
                    Possible causes: something strange happened while saving user in database.');
                return $this->refresh();
            }
        }
                
        return $this->render('signup', [
            'model' => $model,
        ]);     
    }

    private function signupWithActivation($model, $user)
    {
        if ($model->sendAccountActivationEmail($user))
        {
            Yii::$app->session->setFlash('success', 
                Yii::t('app', 'Hello').' '. Html::encode(ucfirst($user->username)) . '. ' .
                Yii::t('app', 'To be able to log in, you need to confirm your registration. Please check your email, we sent you a message.'));
        }
        else 
        {
            Yii::$app->session->setFlash('error', 
                Yii::t('app', 'We couldn\'t send you account activation email, please contact us.'));
            Yii::error('Oops, something went wrong. Signup failed! 
                User '.Html::encode($user->username).' could not sign up.
                Possible causes: verification email could not be sent.');
        }
    }

    public function actionActivateAccount($token)
    {
        try 
        {
            $user = new AccountActivation($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user->activateAccount()) 
        {
            Yii::$app->session->setFlash('success', 
                Yii::t('app', 'Account activated successfully! You can now log in.').' '.
                Yii::t('app', 'Thank you').' '. Html::encode(ucfirst($user->username)).' '.
                Yii::t('app', 'for joining us!'));
        }
        else
        {
            Yii::$app->session->setFlash('error', 
                Html::encode($user->username).
                Yii::t('app', 'Your account could not be activated, please contact us!'));
        }
        return $this->redirect('login');
    }
}

