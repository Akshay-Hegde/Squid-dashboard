<?php

use yii\db\Schema;
use yii\db\Migration;

class m150805_133741_insert_blacklists extends Migration
{
  public function safeUp()
  {
    $this->insert('blacklist', array('id'=>'', 'name'=>'ads', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'adult', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'aggressive', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'astrology', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'audio-video', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'celebrity', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'chat', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'dangerous_material', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'dating', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'ddos', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'dialer', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'download', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'drugs', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'gambling', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'games', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'hacking', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'lingerie', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'malware', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'marketingware', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'mixed_adult', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'phishing', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'redirector', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'sect', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'social_networks', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'special', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'sports', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'strict_redirector', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'strong_redirector', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'update', 'comments'=>''));
    $this->insert('blacklist', array('id'=>'', 'name'=>'warez', 'comments'=>''));
  }

  public function safeDown()
  {
    echo "m150805_133741_insert_blacklists cannot be reverted.\n";
    return false;
  }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
     */
}
