<?php

use yii\db\Schema;
use yii\db\Migration;

class m150820_122558_create_insert_blacklist_domain_table extends Migration
{
  public function safeUp()
  {
    $this->createTable('blacklist_domains', [
      'id' => Schema::TYPE_PK,
      'domain' => Schema::TYPE_STRING . ' NOT NULL',
      'blacklist_id' => Schema::TYPE_INTEGER . ' NOT NULL',
    ],'ENGINE=InnoDB');

    $this->addForeignKey('FK_BL_DOMAIN_BL_ID','blacklist_domains','blacklist_id','blacklist','id','CASCADE','CASCADE');

    // Limit bulk inserts to 10000 rows at a time
    $maxRecord = 10000;
    $recordNum = 0;

    // Define the blacklist types
    $blType = [
      ['adult', 1],
      ['aggressive', 2],
      ['audio-video', 3],
      ['drugs', 4],
      ['mixed_adult', 5],
      ['violence', 6],
      ['porn', 7],
      ['ads', 8],
      ['dating', 9],
      ['chat', 10],
      ['gambling', 11]
    ];

    // Iterate over the blacklists and bulk insert into the DB
    foreach($blType as $type)
    {
      $handle = fopen("/etc/squidguard/blacklists/" . $type[0] . "/domains", "r");
      if ($handle) {
        $bulkInsertArray = [];
        $recordNum = 0;
        while (($line = fgets($handle)) !== false) {
          ++$recordNum;
          $bulkInsertArray[] = ['', trim($line), $type[1]];
          if ($recordNum == $maxRecord) {
            $this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
            $bulkInsertArray = [];
            $recordNum = 0;
          }
        }
        if ($recordNum < 1000 & $recordNum > 0) {
          $this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
        }
        fclose($handle);
      }
    }
    return true;
  }

  public function down()
  {
    echo "m150805_133741_insert_blacklists TRUNCATED.\n";
    $this->truncateTable('blacklist_domains');

    return true;
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
