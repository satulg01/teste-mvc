<?php
    namespace App\Utils\View;

    class View {
        /**
         * Método responsável por retornar uma view renderizada
         *
         * @param string $view
         * @return string
         */
        public static function render($view) {
            //Conteudo da view
            $contentView = self::getContentView($view);

            return $contentView;
        }

        /**
         * Método responsável por retornar o conteúdo de uma view
         *
         * @param string $view
         * @return string
         */
        private static function getContentView($view) {
            $file = __DIR__ . "/../../../resources/view/" . $view . ".html";
            return file_exists($file) ? file_get_contents($file) : "";
        }
    }
?>