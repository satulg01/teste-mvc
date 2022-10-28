<?php
	use \App\Controller\Pages;
	use \App\Http\Response;

    $obRouter->get("/", [
		function(){
			return new Response(200, Pages\Home::getHome());
		}
	]);

    $obRouter->get("/sobre", [
		function(){
			return new Response(200, Pages\About::getAbout());
		}
	]);

	$obRouter->get("/pagina/{idPagina}", [
		function($idPagina){
			return new Response(200, "Olá - " . $idPagina);
		}
	]);
?>