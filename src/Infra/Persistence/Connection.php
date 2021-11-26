<?php

	namespace Weliton\Login\Infra\Persistence;

use PDO;

class Connection
{
	private string $dbname;
	

	public static function ConnSqlite(string $dbname):PDO
	{
       
		$connSqLite = new PDO ('sqlite:'.__DIR__.'/var/'.$dbname.'.sqlite');
		return $connSqLite;

	}

	public static function ConnMysql(string $dbname):PDO
	{
		$connMysql = new PDO("mysql:host=localhost;dbname={$dbname}",
      "weliton","well1006");

	  return $connMysql;
	}
}