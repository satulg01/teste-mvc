<?php
    namespace App\Controller\Pages;

	use \App\Utils\View\View;

    /**
     * Método responsável por retornar o conteudo da nossa pagina genérica
     * @return string
     */
    class Page {
        public static function getPage($title, $content) {
            return View::render('pages/page', [
                "title" => $title,
                "content" => $content
            ]);
        }
    }
?>