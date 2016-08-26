<?php

use yii\db\Migration;
use yii\db\Schema;

class m150731_070309_add_squid_password_to_users extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'squid_password', Schema::TYPE_STRING . '(60) NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('user', 'squid_password');
    }
}
