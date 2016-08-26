<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SquidController extends Controller
{
    public function actionDenied()
    {
        $this->layout = 'noheader';
        return $this->render('denied');
    }

}