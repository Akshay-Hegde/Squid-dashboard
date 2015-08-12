<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\helpers\Squid;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'reloadsquid', 'startsquid', 'stopsquid'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'reloadsquid', 'startsquid', 'stopsquid'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'reloadsquid' => ['post'],
                    'startsquid' => ['post'],
                    'stopsquid' => ['post']
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReloadsquid()
    {
        $status = Squid::writeconfig();

        if(!$status)
        {
            Yii::$app->getSession()->setFlash('reload_message', 'Unable to write to configuration file'); 
            return $this->redirect('index');
        }

        $status = Squid::restart();

        Yii::$app->getSession()->setFlash('reload_message', $status); 
        return $this->redirect('index');
    }

    public function actionStartsquid()
    {
        $status = Squid::writeconfig();

        if(!$status)
        {
            Yii::$app->getSession()->setFlash('reload_message', 'Unable to write to configuration file'); 
            return $this->redirect('index');
        }

        $status = Squid::start();

        Yii::$app->getSession()->setFlash('reload_message', $status); 
        return $this->redirect('index');
    }

    public function actionStopsquid()
    {

        $status = Squid::stop();

        Yii::$app->getSession()->setFlash('reload_message', $status); 
        return $this->redirect('index');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
