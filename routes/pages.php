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

	$obRouter->get("/depoimentos", [
		function(){
			return new Response(200, Pages\Testimony::getTestimonies());
		}
	]);

	$obRouter->post("/depoimentos", [
		function($request){
			#Vamos fazer o banco e fazer inserir esses depoimentos
			#https://www.youtube.com/watch?v=t6wrq3EopWI 18:00
			return new Response(200, Pages\Testimony::getTestimonies());
		}
	]);

	/*
	$obRouter->get("/pagina/{idPagina}", [
		function($idPagina){
			return new Response(200, "Olá - " . $idPagina);
		}
	]);
	*/
?>