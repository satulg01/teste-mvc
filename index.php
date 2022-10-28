<?php
	require __DIR__ . "/vendor/autoload.php";

	use \App\Http\Router;
	use \App\Utils\View\View;

	define("URL", "http://localhost/teste-mvc");

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
