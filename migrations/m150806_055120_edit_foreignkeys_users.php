<?php

use yii\db\Migration;
use yii\db\Schema;

class m150806_055120_edit_foreignkeys_users extends Migration
{
    public function up()
    {
        $this->dropForeignKey('FK_USER_FILTERING_GROUP', 'users');
        $this->dropForeignKey('FK_USER_DELAY_GROUP', 'users');

        $this->addForeignKey('FK_USER_FILTERING_GROUP', 'users', 'delay_group_id', 'delay_group', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('FK_USER_DELAY_GROUP', 'users', 'filtering_group_id', 'filtering_group', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        echo "m150806_055120_edit_foreignkeys_users being reverted.\n";

        $this->dropForeignKey('FK_USER_FILTERING_GROUP', 'users');
        $this->dropForeignKey('FK_USER_DELAY_GROUP', 'users');

        $this->addForeignKey('FK_USER_FILTERING_GROUP', 'users', 'delay_group_id', 'delay_group', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_USER_DELAY_GROUP', 'users', 'filtering_group_id', 'filtering_group', 'id', 'CASCADE', 'CASCADE');

        return true;
    }
}
