<?php
    namespace App\Utils\View;

    class View {
        /**
         * Variáveis padrões
         */
        private static $vars;

        /**
         * Método 'construtor' da classe
         * @param array $vars
         * @return void
         */
        public static function init ($vars = []) {
            self::$vars = $vars;
        }
        /**
         * Método responsável por retornar uma view renderizada
         *
         * @param string $view
         * @param array $vars (strings, numerics)
         * @return string
         */
        public static function render($view, $vars = []) {
            //Conteudo da view
            $contentView = self::getContentView($view);

            $vars = array_merge(self::$vars, $vars);

            $keys = array_keys($vars);
            $keys = array_map(function($item){
                return '{{'. $item .'}}';
            }, $keys);

            return str_replace($keys, array_values($vars), $contentView);
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