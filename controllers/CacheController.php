<?php

namespace app\controllers;

use app\models\Cachestatus;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

//use app\models\Cache;
//use app\models\CacheForm;

/**
 * AnonymousController applies anonymity to users.
 */
class CacheController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['preferences'],
                'rules' => [
                    [
                        'actions' => ['preferences'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionPreferences()
    {
        $cachestatus = Cachestatus::findOne(1);

        if ($cachestatus->load(Yii::$app->getRequest()->post()) && $cachestatus->save()) {
            Yii::$app->getSession()->setFlash('Csuccess', 'Caching status has been successfully updated');
            return $this->refresh();
        }

        return $this->render('preferences', [
            'cachestatus' => $cachestatus,
        ]);
    }
}
