<?php

namespace hospital\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use hospital\models\LoginForm;
use hospital\models\ContactForm;
use hospital\models\SignupForm;
use common\models\auth\Auth;
use common\models\Tenant;
use common\models\User;
use yii\helpers\Url;
use common\components\TenantManager;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onSignUpSuccess'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $cookies_req = Yii::$app->request->cookies;
        // $cookies_res = Yii::$app->response->cookies;
        // $Tenant_id = Yii::$app->request->get('q');
        // if($cookies_req->getValue('Tenant_id') == null){
        //     if($Tenant_id != null){
        //         $Tenant = Tenant::findOne(['id' => $Tenant_id]);
        //         Yii::$app->cookieManager->setcookie('Tenant_id', $Tenant_id);
        //         $q_param = $Tenant->id;
        //     }
        // }else{
        //     $q_param = $cookies_req->getValue('Tenant_id');
        // }

        return $this->render('index',['q' => TenantManager::getTenantId()]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    //public function actionLogin()
    //{
        //if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
        //}

//$model = new LoginForm();
        //if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
//}

        //$model->password = '';
        //return $this->render('login', [
            //'model' => $model,
        //]);
    //}

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = User::retByUserName($model->username);
            if($user === null){
                return $this->render('login', [
                'model' => $model, 'no_user' => true,
                ]);
            }
            if($user->status == User::STATUS_INACTIVE){
                return Yii::$app->response->redirect(['/reguser/create', 'id' => $user->id]);
            }
            if($user->status == User::STATUS_ACTIVE){
                Yii::$app->user->login($user);
                return $this->goBack();
            }            
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model, 'no_user' => false,
        ]);
    }

     /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            
            //Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            //return $this->goHome();
            $user = User::find()->where(['email' => $model->email])->one();
            return Yii::$app->response->redirect(['/reguser/create', 'id' => $user->id]);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('tenant_id');
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function onAuthSuccess($client)
    {
       $attributes = $client->getUserAttributes();
       
        /** @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // signup
                if (User::find()->where(['email' => $attributes['email']])->exists()) {                    
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['email'], 
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }

    public function onSignUpSuccess($client)
    {
       $attributes = $client->getUserAttributes();
       
        /** @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $user = User::find()->where(['email' => $attributes['email']])->one();
                $user = $auth->user;
                if($user->status == '9'){
                    return Yii::$app->response->redirect(['/reguser/create', 'id' => $user->id]);
                };
                if($user->status == '10'){
                    Yii::$app->user->login($user);
                };       
            } else { // signup                
                if (User::find()->where(['email' => $attributes['email']])->exists()) {
                    $user = User::find()->where(['email' => $attributes['email']])->one();
                    $auth = new Auth([
                        'user_id' => $user->id , //Yii::$app->user->id,
                        'source' => $client->getId(),
                        'source_id' => (string)$attributes['id'],
                    ]);
                    if($auth->save()){
                        if($user->status == '9'){
                            return Yii::$app->response->redirect(['/reguser/create', 'id' => $user->id]);
                        };
                        if($user->status == '10'){
                            Yii::$app->user->login($user);
                        };                        
                    } ;                    
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['email'], 
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            return Yii::$app->response->redirect(['/reguser/create', 'id' => $user->id]);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
            $user = User::find()->where(['email' => $attributes['email']])->one();
            if($user->status == '9'){
                return Yii::$app->response->redirect(['/reguser/create', 'id' => $user->id]);
            };
            if($user->status == '10'){
                Yii::$app->user->login($user);
            };        
        }
    }

}
