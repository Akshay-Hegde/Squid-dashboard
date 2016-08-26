<?php

use yii\db\Migration;
use yii\db\Schema;

class m150825_064239_add_anonymous_field_users extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'anonymous', Schema::TYPE_BOOLEAN . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('user', 'anonymous');
    }
}
