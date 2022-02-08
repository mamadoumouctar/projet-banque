<?php
namespace Tm;
use AltoRouter;

class Router
{
	private static $altoRouter = null;

	public static function getRouter(): AltoRouter
	{
		if(is_null(self::$altoRouter)){
			self::$altoRouter = new AltoRouter();
		}
		return self::$altoRouter;
	}

	public static function get(string $uri, callable $calback, ?string $name = null): AltoRouter
	{
		self::getRouter()->map('GET', $uri, $calback, $name);
		return self::$altoRouter;
	}

	public static function post(string $uri, callable $calback, ?string $name = null): AltoRouter
	{
		self::getRouter()->map('POST', $uri, $calback, $name);
		return self::$altoRouter;
	}

	public static function store(string $uri, callable $calback, ?string $name = null): AltoRouter
	{
		self::getRouter()->map('GET|POST', $uri, $calback, $name);
		return self::$altoRouter;
	}

	public static function generate(string $name, ?array $option = []): string
	{
		return self::getRouter()->generate($name, $option);
	}
}
