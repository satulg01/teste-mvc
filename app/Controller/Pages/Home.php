<?php
    namespace App\Controller\Pages;

	use \App\Utils\View\View;

    /**
     * Método responsável por retornar o conteudo da nossa home
     * @return string
     */
    class Home {
        public static function getHome() {
            return View::render('pages/home', [
                "name" => "Roger Rodrigues | Satulg",
                "description" => "Olá mundo!"
            ]);
        }
    }
?>