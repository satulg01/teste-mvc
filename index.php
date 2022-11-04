<?php
	require __DIR__ . "/vendor/autoload.php";

	use \App\Http\Router;
	use \App\Utils\View\View;
	use \WilliamCosta\DotEnv\Environment;

	Environment::load(__DIR__);

	define("URL", getenv("URL"));

	#Define o valor padrão das variáveis
	View::init([
		'URL' => URL,
	]);


	#Inicializa o roteador
	$obRouter 	= new Router(URL);

	#Inclui as rotas
	include __DIR__ . "/routes/pages.php";

	
	// $connection = new Connection("localhost", "servidor", "root", "");
	// $db 		= $connection->returnConnection();
	// $relation 	= new Relation($db);
	



	$obRouter->run()
				->sendResponse();

?>
