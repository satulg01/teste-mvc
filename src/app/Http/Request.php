<?php
    namespace App\Http;

    class Request {
        /**
         * *Método http da requisição
         * @var string
         */
        private $_httpMethod;

        /**
         * *URI da página
         * @var string
         */
        private $_uri;

        /**
         * *Parâmetros da URL
         * @var array
         */
        private $_queryParams = [];

        /**
         * *Variáveis recebidas no POST da página
         * @var array
         */
        private $_postVars = [];

        /**
         * *Cabeçalho da requisição
         * @var array
         */
        private $_headers = [];

        public function __construct() {
            $this->_queryParams = $_GET ?? [];
            $this->_postVars    = $_POST ?? [];
            $this->_headers     = getallheaders();
            $this->_httpMethod  = $_SERVER["REQUEST_METHOD"] ?? '';
            $this->_uri         = $_SERVER["REQUEST_URI"] ?? '';
        }

        /**
         * *Método responsável por retornar o metódo HTTP da requisição
         * @var string
         */
        public function getHttpMethod() {
            return $this->_httpMethod;
        }

        /**
         * *Método responsável por retornar a URI da página
         * @var string
         */
        public function getUri() {
            return $this->_uri;
        }

        /**
         * *Método responsável por retornar os parâmetros da URL
         * @var array
         */
        public function getQueryParams() {
            return $this->_queryParams;
        }

        /**
         * *Método responsável por retornar as variáveis recebidas 
         * @var array
         */
        public function getPostVars() {
            return $this->_postVars;
        }
    }
