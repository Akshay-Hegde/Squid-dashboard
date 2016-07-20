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

		// Import the blacklists
		$handle = fopen("/etc/squidguard/blacklists/adult/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			$recordNum = 0;
			while (($line = fgets($handle)) !== false) {
				++$recordNum;
				$bulkInsertArray[] = ['', trim($line), '1'];
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

		$handle = fopen("/etc/squidguard/blacklists/aggressive/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '2'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/audio-video/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '4'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/drugs/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '5'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/mixed_adult/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '6'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/violence/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '7'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/porn/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '8'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/ads/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '9'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/dating/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '10'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/chat/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '11'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		$handle = fopen("/etc/squidguard/blacklists/gambling/domains", "r");
		if ($handle) {
			$bulkInsertArray = [];
			while (($line = fgets($handle)) !== false) {
				$bulkInsertArray[] = ['', trim($line), '12'];
			}
			fclose($handle);
			$this->batchInsert('blacklist_domains', ['id', 'domain', 'blacklist_id'], $bulkInsertArray);
		}

		return true;

	}

	public function down()
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
