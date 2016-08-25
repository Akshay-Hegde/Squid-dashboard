<?php
/**
 * This command creates a default user with username: admin, pass: adminadmin
 * and administration privileges
 *
 * @author George Dimosthenous
 * @author Alexander Phinikarides
 *
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use dektrium\user\models\User;
use dektrium\user\helpers\Password;
use yii\helpers\Console;

class CreateusersController extends Controller {

  public function actionCreate()
  {
    $module = \Yii::$app->getModule('user');

    $user = Yii::createObject([
      'class'    => User::className(),
      'scenario' => 'create',
    ]);

    $user->setAttributes([
      'email' => 'admin@t-nova.eu',
      'username' => 'admin',
      'password' => 'adminadmin',
      'role'=>'admin'
    ]);

    if ($user->create()) {
      $this->stdout('Admin has been created' . "!\n", Console::FG_GREEN);
    } else {
      $this->stdout('Please fix the following errors:' . "\n", Console::FG_RED);

      foreach ($user->errors as $errors) {
        foreach ($errors as $error) {
          $this->stdout(" - ".$error."\n", Console::FG_RED);
        }
      }
    }
  }
}
?>
