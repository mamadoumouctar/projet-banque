<?php
namespace Tm\Validator;

use Tm\Database;

class ClientsValidator
{
	private static $is_fillable = ['nom', 'prenom', 'telephone', 'address'];
	private static $data = [];

	public static function validate(array $data)
	{
		foreach(self::$is_fillable as $field){
			self::$data[$field] = $data[$field] ?? '';
		}
		return self::$data;
	}

	public function is_valid(?int $id = 0)
	{
		$errors = [];
		foreach(self::$data as $key => $field){
			if(empty($field)){
				$errors[] = "Le champs $key ne doit pas être vide.";
			}
		}
		foreach(self::$data as $key => $field){
			if(mb_strlen($field) > 200){
				$errors[] = "Le champs $key doit avoir moins de 200 carractères.";
			}
		}
		if(!preg_match("/^[0-9\+]+$/", self::$data['telephone'])){
			$errors[] = "Le telephone n'est pas valide.";
		}else{
			$db = Database::getBD();
			$query = $db->query("SELECT id from clients WHERE telephone = ".self::$data['telephone'])->fetch();
			if(($id != 0 && (!empty($query) & $id != $query['id'])) || ($id == 0 && !empty($query))){
				$errors[] = "Ce numéro de telephone appartient déjà a un autre client.";
			}
		}
		if(empty($errors)){
			return true;
		}else{
			return $errors;
		}
	}
}
