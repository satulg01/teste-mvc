<?php
    class Connection {

        private $_servername;
        private $_dbname;
        private $_username;
        private $_password;

        public $_conn;

        function __construct ($server, $db, $user, $pass) {
            $this->_servername = $server;
            $this->_dbname = $db;
            $this->_username = $user;
            $this->_password = $pass;

            try {

                $_conn = new PDO("mysql:host=$this->_servername;
                                        dbname=$this->_dbname", 
                                        $this->_username, 
                                        $this->_password);

                $_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->_conn = $_conn;

            } catch(PDOException $e) {
                echo "Falha na conexão com o banco de dados";
                echo "Erro: " . $e->getMessage();
            }
        }

        function returnConnection () {
            return $this->_conn;
        }
    }
?>