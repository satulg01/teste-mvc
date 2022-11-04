<?php
    namespace App\Controller\Pages;

	use \App\Utils\View\View;

    /**
     * Método responsável por retornar o conteudo de depoimentos
     * @return string
     */
    class Testimony extends Page{
        public static function getTestimonies() {

            $content = View::render('pages/testimonies', [ 
            ]);

            return self::getPage("Satulg > Depoimentos", $content);
        }
    }
?>