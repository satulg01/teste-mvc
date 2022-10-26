<?php
    namespace App\Http;

    class Response {
        /**
         * *Código do status HTTP
         * @var integer
         */
        private $_httpCode = 200;

        /**
         * *Cabeçalho do Response
         * @var array
         */
        private $_headers = [];

        /**
         * *Content Type da Response
         * @var string
         */
        private $_contentType = 'text/html';

        /**
         * *Conteúdo do Response
         * @var mixed
         */
        private $_content;

        /**
         * *Construtor da classe
         * @param integer $httpCode
         * @param mixed $content
         * @param string $contentType
         */
        public function __construct($httpCode, $content, $contentType = 'text/html') {
            $this->_httpCode    = $httpCode;
            $this->_content     = $content;
            $this->setContentType($contentType);
        }

        /**
         * Método responsável por alterar o content-type da Response
         *
         * @param string $contentType
         * @return void
         */
        public function setContentType($contentType) {
            $this->_contentType = $contentType;
            $this->addHeader("Content-Type", $contentType);
        }

        /**
         * Método responsável por adicionar registros ao cabeçalho da resposta
         *
         * @param string $key
         * @param string $value
         * @return void
         */
        public function addHeader($key, $value) {
            $this->_headers[$key] = $value;
        }

        /**
         * Método responsável por enviar os headers para o navegador
         *
         * @return void
         */
        public function sendHeaders() {
            http_response_code($this->_httpCode);

            foreach ( $this->_headers as $key => $value) {
                header($key . ': ' . $value);
            }
        }

        /**
         * Método responsável por retornar ao usuário a resposta 
         *
         * @return void
         */
        public function sendResponse() {
            $this->sendHeaders();
            switch ($this->_contentType) {
                case 'text/html':
                    echo $this->_content;
                    exit();
            }
        }
    }
?>