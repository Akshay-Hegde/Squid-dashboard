<?php
/**
 * Helper for editing SquidGuard's configuration file
 *
 * @author George Dimosthenous, Savvas Charalambides
 * @author Alexander Phinikarides
 *
 */

namespace app\helpers;

use yii\helpers\Html;
use app\models\FilteringGroup;
use app\models\User;

class SquidGuard
{
	const SQUIDGUARD_CONF = '/etc/squidGuard/squidGuard.conf';
	const SQUIDGUARD_DEFAULT_CONF = '/var/www/localhost/htdocs/dashboard/squidguard/squidGuard.conf';
	const FILTERING_GROUP_SPECIFICATION_TEMPLATE = "src %s{\n\tuser %s \n}\n";
	const FILTERING_GROUP_ACL_TEMPLATE = "\t%s { \n\t\tpass %s all \n\t\tredirect http://localhost/squid/denied?\n\t}\n";

	/**
	 * Reads configuration data from DB and writes it to SquidGuard's configuration file
	 *
	 * @return bool
	 */
	public static function writeconfig()
	{
		$groups = FilteringGroup::find()->with('users')->all();
		$filtering_groups = [];
		$filtering_group_acls = [];

		foreach ($groups as $group)
		{
			if(!empty($group->users))
			{
				/*
				 * Preparing the filtering group definitions. 

				array_push($filtering_groups, sprintf(SquidGuard::FILTERING_GROUP_SPECIFICATION_TEMPLATE, $group->name, $group->getUsersStringSpaced()));

				/*
				 * Preparing the blacklists for this filetring group
				 */
				$blacklists = '!'.implode(' !',explode(',',$group->getBlacklistsNames()));
				array_push($filtering_group_acls, sprintf(SquidGuard::FILTERING_GROUP_ACL_TEMPLATE,$group->name,$blacklists))
			}
		}

		if (SquidGuard::write("#SOURCE ADDRESSES", "#SOURCE ADDRESSES END", implode('',$filtering_groups), SquidGuard::SQUIDGUARD_DEFAULT_CONF, SquidGuard::SQUIDGUARD_CONF)===false) {
			return false;
		}

		if (SquidGuard::write("#ACL RULES", "#ACL RULES END", implode('',$filtering_group_acls), SquidGuard::SQUIDGUARD_CONF, SquidGuard::SQUIDGUARD_CONF)===false) {
			return false;
		}

		return true;
	}

	/**
	 * Starts Squid server
	 * @return string
	 */
	public static function start()
	{
		$status = shell_exec('sudo /sbin/rc-service squid start');
		return $status;
	}

	/**
	 * Stops Squid server
	 * @return string
	 */
	public static function stop()
	{
		$status = shell_exec('sudo /sbin/rc-service squid stop');
		return $status;
	}

	/**
	 * Restarts Squid server
	 * @return string
	 */
	public static function restart()
	{
		$status = shell_exec('sudo /sbin/rc-service squid restart');
		return $status;
	}

	/**
	 * Writes configuration to SquidGuard configuration file.
	 * @param string $start
	 * @param string $end
	 * @param string $conf the configuration directives to be written
	 * @param string $infile the configuration file path to read the configuration
	 * @param string $outfile the configuration file path to write the configuration 
	 * @return boolean
	 */
	private static function write($start, $end, $conf, $infile = SquidGuard::SQUIDGUARD_CONF, $outfile = SquidGuard::SQUIDGUARD_CONF)
	{
		$file = @file_get_contents($infile);

		if($file === false) {
			return false;
		}

		$pos_start = strpos($file, $start);
		$pos_end = strpos($file, $end);

		if($pos_start === false || $pos_end === false) {
			return false;
		}

		$a = substr($file, 0, $pos_start + strlen($start));
		$b = substr($file, $pos_end);

		if(file_put_contents($outfile, $a."\n". $conf . "\n" .$b) === false) {
			return false;
		}
		return true;
	}
}
