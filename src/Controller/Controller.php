<?php
namespace Tm\Controller;
use Tm\Database;
use Tm\Router;
use Tm\FlashService;

class Controller
{
	protected function render(string $view, ?array $option = [])
	{
		require_once ROOT.'view_fonction.php';
		ob_start();
		extract($option);
		require_once ROOT. 'views'. DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.html.php';
		return ob_get_clean();
	}

	public function notFoundResponse(?string $msg = null)
	{
		require_once ROOT.'view_fonction.php';
		ob_start();
		$msg;
		require_once ROOT. 'views'. DIRECTORY_SEPARATOR . "errors" . DIRECTORY_SEPARATOR . '404' . '.html.php';
		header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
		return ob_get_clean();
	}

	protected function db(?string $config = null)
	{
		return Database::getDatabase("mysql:host=localhost;dbname=exemple1", 'root');
	}

	protected function redirectToRoute(string $name, ?array $params = [])
	{
		header("location: " . Router::generate($name, $params));
		return;
	}

	protected function addFlash(string $type, string $value): void
	{
		FlashService::add($type, $value);
	}
}
