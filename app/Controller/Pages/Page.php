<?php
    namespace App\Controller\Pages;

	use \App\Utils\View\View;

    
    class Page {
        /**
        * Método responsável por retornar o conteudo do nosso header
        * @return string
        */
        private static function getHeader() {
            return View::render('pages/header');
        }

        /**
        * Método responsável por retornar o conteudo do nosso footer
        * @return string
        */
        private static function getFooter() {
            return View::render('pages/footer');
        }

        /**
        * Método responsável por retornar o conteudo da nossa pagina genérica
        * @return string
         */
        public static function getPage($title, $content) {
            return View::render('pages/page', [
                "header" => self::getHeader(),
                "footer" => self::getFooter(),
                "title" => $title,
                "content" => $content
            ]);
        }
    }
?>