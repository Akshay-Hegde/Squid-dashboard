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
      ['ads', 1],
      ['adult', 2],
      ['aggressive', 3],
      ['astrology', 4],
      ['audio-video', 5],
      ['celebrity', 6],
      ['chat', 7],
      ['dangerous_material', 8],
      ['dating', 9],
      ['ddos', 10],
      ['dialer', 11],
      ['download', 12],
      ['drugs', 13],
      ['gambling', 14],
      ['games', 15],
      ['hacking', 16],
      ['lingerie', 17],
      ['malware', 18],
      ['marketingware', 19],
      ['mixed_adult', 20],
      ['phishing', 21],
      ['redirector', 22],
      ['sect', 23],
      ['social_networks', 24],
      ['special', 25],
      ['sports', 26],
      ['strict_redirector', 27],
      ['strong_redirector', 28],
      ['update', 29],
      ['warez', 30]
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
