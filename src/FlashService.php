<?php
namespace Tm;

class FlashService
{
	const FLASH_FIELD = "_Flash";
	public static function add(string $type, string $value): void
	{
		$_SESSION[self::FLASH_FIELD][$type][] = $value;
	}

	public static function get(string $type): array
	{
		$data = $_SESSION[self::FLASH_FIELD][$type];
		unset($_SESSION[self::FLASH_FIELD][$type]);
		return $data;
	}

	public static function hasFlashes(?string $type = null): bool
	{
		return !empty($_SESSION[self::FLASH_FIELD][$type]) || (is_null($type) &&!empty($_SESSION[self::FLASH_FIELD]));
	}
}
