<?php
$parts = [];
$last = null;
$template = null;

function template(string $name)
{
	global $template;
	$template = dirname(__FILE__) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $name) . ".html.php";
}

function wipe(string $name, ?string $default = null)
{
	global $parts;
	echo $parts[$name] ?? $default;
}

function section(string $name, ?string $value = null)
{
	global $last;
	global $parts;
	$last = $name;
	if(is_null($value)){
		ob_start();
	}else{
		$parts[$name] = $value;
	}
}

function endSection()
{
	global $parts;
	global $last;
	global $template;
	$parts[$last] = !empty($parts[$last]) ? $parts[$last] : ob_get_clean();
	require_once $template;
}

function generate(string $name, ?array $option = []): string
{
	return Tm\Router::generate($name, $option);
}

function hasFlashes(?string $type = null): bool
{
	return Tm\FlashService::hasFlashes($type);
}

function getFlashes(string $type)
{
	return Tm\FlashService::get($type);
}
