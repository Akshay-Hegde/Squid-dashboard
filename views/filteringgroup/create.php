<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\FilteringGroup */

$this->title = 'Create Filtering Group';
?>
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= Yii::$app->homeUrl; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= Url::to(['/filteringgroup/index']); ?>">Website Filtering Groups</a></li>
        <li class="active"><?= Html::encode($this->title); ?></li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <?= $this->render('_form', ['model' => $model, 'blists' => $blists, 'users' => $users]); ?>
        </div>
    </div>
</section>

