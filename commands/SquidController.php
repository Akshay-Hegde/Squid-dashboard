<?php
/**
 * Commands to configure, start and stop Squid and SquidGuard
 * E.g ./yii squid/start
 *
 * @author George Dimosthenous
 * @author Alexander Phinikarides
 *
 **/

namespace app\commands;

use app\helpers\Squid;
use app\helpers\SquidGuard;
use dektrium\user\helpers\Password;
use dektrium\user\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class SquidController extends Controller
{

    /**
     * Updates Squid and SquidGuard's configuration files and then starts the services
     * @return string
     */
    public function actionStart()
    {
        if (!Squid::status()) {
            $status = Squid::writeconfig();

            if (!$status) {
                $this->stdout('Unable to write to configuration file', Console::FG_RED);
                exit();
            }

            $status = SquidGuard::writeconfig();

            if (!$status) {
                $this->stdout('Unable to write to configuration file', Console::FG_RED);
                exit();
            }

            $status = Squid::start();

            $this->stdout($status, Console::FG_GREEN);
        } else
            $this->stdout('Squid Proxy is already running', Console::FG_RED);
    }

    /**
     * Stops the services
     * @return string
     */
    public function actionStop()
    {
        if (Squid::status()) {
            $status = Squid::stop();

            $this->stdout($status, Console::FG_GREEN);
        } else
            $this->stdout('Squid Proxy is not running', Console::FG_RED);
    }
}
