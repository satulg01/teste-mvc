<?php
    class Relation {

        private $_connection;
        
        function __construct ($_connection) {
            $this->_connection = $_connection;
        }

        #Função para consultar todas as linhas de uma tabela
        #Recebe o nome da tabela
        function consultaCampos($tabela) {
            $stmt = $this->_connection->prepare("SELECT * FROM `$tabela`");
            $stmt -> execute();
            $retorno = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $retorno []= $row;
            }

            return $retorno;
        }

        #Função para consultar linhas de uma tabela com where
        #Recebe o nome da tabela
        #e um array sendo a chave do array a coluna e o valor, o valor procurado
        function consultaCamposWhere($tabela, $array_where) {
            $retorno = array();
            $string_where = "";

            foreach($array_where as $campo_where => $valor_where) {
                $string_where .= "AND `". $campo_where ."`" . " = :" . $campo_where . " ";
            }

            $string_consulta = "SELECT * FROM `$tabela` WHERE 1 $string_where";

            $stmt = $this->_connection->prepare($string_consulta);
            $stmt -> execute($array_where);


            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $retorno []= $row;
            }

            return $retorno;
        }
    }
?>