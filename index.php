<?php
	require __DIR__ . "/vendor/autoload.php";

	define("URL", "http://localhost");

	use \App\Controller\Pages\Home;
	// use \App\Http\Router;

	echo Home::getHome();

	session_start();

	exit;
	/*
	$obRouter 	= new Router(URL);
	$connection = new Connection("localhost", "servidor", "root", "");
	$db 		= $connection->returnConnection();
	$relation 	= new Relation($db);
	*/

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./_css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
		<script src="_js/jquery-3.6.0.min.js"></script>
		<!-- <script src="https://kit.fontawesome.com/6cfdfed1de.js" crossorigin="anonymous"></script> -->
		<script src="_js/jquery.mask.js"></script>
		<link rel="icon" type="image/x-icon" href="./_img/favicon.png">
		<script src="_js/funcoes.js"></script>
		<title>Satulg</title>
	</head>
	<body>
		<div id="line-1">
			<div class="logo"><img src="./_img/logo/logo.png"></div>
			<div class="cliente"></div>
		</div>
		<div id="line-2">
			<div class="header-menu"></div>
			<?php

				$obRouter->get("/", [
					function(){
						return new Response(200, "Olá mundo");
					}
				]);

				$obRouter->run()
						 ->sendResponse();



				exit();

				
				
				
				
				
				
				
				$links = $_GET["url"];
				$links = explode("/", $links);

				if(isset($links[0])) {
					$controller = $links[0];
					array_shift($links);

				}
				print_r($links);
				exit();

				if (isset($_SESSION["UsuarioID"])){
					if(isset($_GET["open"]) && isset($_GET["acao"])){
						if($_GET["open"] == "1" && $_GET["acao"] == "ger") {
							require("combustivel/ger.php");
							$pagina = "Combustível";
						}

						if($_GET["open"] == "1" && $_GET["acao"] == "add") {
							require("combustivel/add.php");
							$pagina = "Combustível";
						}

						if($_GET["open"] == "2" && $_GET["acao"] == "ger") {
							require("chat/ger.php");
							$pagina = "Chat";
						}
					} else {
						if(isset($_GET["site"])) {
							require("site/main.php");
							$pagina = "Site";
						}else{
								//HOME DO SISTEMA
							echo '
								<div  id="container">
									<div href="?open=1&acao=add" class="menu-item" >
										<i class="fas fa-plus"></i>
										<p>Abastecimento</p>
									</div>
									<div href="?open=1&acao=ger" class="menu-item">
										<i class="fas fa-eye"></i>
										<p>Abastecimento</p>
									</div>
									<div href="?open=2&acao=ger" class="menu-item">
										<i class="fas fa-comments"></i>
										<p>Chat</p>
									</div>

								</div>				
							';
						}
					}
				} else {
					require("login/index.php");
					$pagina = "Login";
				}
			?>
		</div>
	</body>
</html>
<script type="text/javascript">
	$("title").html("Satulg - <?php echo $pagina ?>");
	$(document).ready(function(){
  		$('.format-data').mask('00/00/0000');
  		$('.format-hora').mask('00:00:00');
  		$('.format-data-hora').mask('00/00/0000 00:00:00');
  		$('.format-cep').mask('00000-000');
  		$('.format-celular').mask('(00) 0000-0000');
  		$('.format-cpf').mask('000.000.000-00', {reverse: true});
  		$('.format-cnpj').mask('00.000.000/0000-00', {reverse: true});
  		$('.format-real').mask('000.000.000.000.000,00', {reverse: true});
  	});
</script>