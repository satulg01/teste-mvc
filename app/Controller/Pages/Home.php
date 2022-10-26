<?php
    namespace App\Controller\Pages;

	use \App\Utils\View\View;

    /**
     * Método responsável por retornar o conteudo da nossa home
     * @return string
     */
    class Home extends Page{
        public static function getHome() {
            $content = View::render('pages/home', [
                "name" => "Roger Rodrigues | Satulg",
                "description" => "Olá mundo!"
            ]);

            return self::getPage("Home Satulg", $content);
        }
    }
?>