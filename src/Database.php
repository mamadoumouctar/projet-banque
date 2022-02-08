<?php
namespace Tm;
use PDO;

class Database
{
	static $db = null;

	public static function getDatabase(string $dns, ?string $user = null, ?string $password = null, ?array $option = [])
	{
		try{
			if(is_null(self::$db)){
				self::$db = new PDO($dns, $user, $password, $option);
			}
		}catch(\PDOException $e){
			require_once ROOT.'view_fonction.php';
			ob_start();
			require_once ROOT. 'views'. DIRECTORY_SEPARATOR . "errors" . DIRECTORY_SEPARATOR . '500' . '.html.php';
			header($_SERVER['SERVER_PROTOCOL']." 500 Internal Server Error");
			echo (ob_get_clean());
			die();
		}
		return self::$db;
	}

	public static function getBD()
	{
		return self::getDatabase("mysql:host=localhost;dbname=exemple1", 'root');
	}

	public function query(string $sql)
	{
		$req = self::getDatabase()->query($sql);
		return $req->fetchAll();
	}
}
