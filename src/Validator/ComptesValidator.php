<?php
namespace Tm\Validator;

use Tm\Database;

class ComptesValidator
{
	private static $is_fillable = ['code'];
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
		if(!empty($errors))
			return $errors;

		$code = self::$data['code'] ?? '';
		if(mb_strlen($code) < 6){ return ["Le code doit avoir au mois 6 caractères."]; }

		if(!preg_match("/[A-Z]+/", $code)){ $errors[] = "Le code doit avoir au mois un caractère de A à Z."; }
		if(!preg_match("/[a-z]+/", $code)){ $errors[] = "Le code doit avoir au mois un caractère de a à z."; }
		if(!preg_match("/[0-9]+/", $code)){ $errors[] = "Le code doit avoir au mois un chiffre."; }

		if(empty($errors)){
			return true;
		}else{
			return $errors;
		}
	}
}
