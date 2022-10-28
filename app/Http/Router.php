<?php
    namespace App\Http;

    use \Closure;
    use \Exception;
    use \ReflectionFunction;

    class Router {

        /**
         * URL completa do projeto
         *
         * @var string
         */
        private $_url = '';

        /**
         * Prefixo de todas as rotas
         *
         * @var string
         */
        private $_prefix = '';

        /**
         * Todas as rotas
         *
         * @var array
         */
        private $_routes = [];

        /**
         * Instância de Request
         *
         * @var Request
         */
        private $_request;

        /**
         * Método responsável por iniciar a classe
         *
         * @param string $url
         */
        public function __construct($url) {
            $this->_request = new Request();
            $this->_url     = $url;
            $this->setPrefix();
        }

        /**
         * Método responsável por definir o prefixo das rotas
         *
         * @return void
         */
        private function setPrefix() {
            $parseUrl = parse_url($this->_url);

            $this->_prefix = $parseUrl["path"] ?? '';
        }
        
        /**
         * Método responsável por definir adicionar uma rota na classe
         *
         * @param string $method
         * @param string $route
         * @param array $params
         * @return void
         */
        public function addRoute($method, $route, $params = []) {
            #Validação dos parâmetros
            foreach ($params as $key => $value) {
                if($value instanceof Closure) {
                    $params["controller"] = $value;
                    unset($params[$key]);
                }
            }

            #Variáveis da rota
            $params["variables"] = [];

            #Padrão de validação das rotas 
            $patternVariable = '/{(.*?)}/';

            if(preg_match_all($patternVariable, $route, $matches)) {
                $route = preg_replace($patternVariable, '(.*?)', $route);

                $params["variables"] = $matches[1]; 
            }

            #Padrão de validação da URL
            $patternRoute = '/^' . str_replace("/", "\/", $route) . '$/';
            
            #Adiciono a rota
            $this->_routes[$patternRoute][$method] = $params;
            
        }

        /**
         * Método responsável por retornar a URI sem o prefixo
         *
         * @return void
         */
        public function getUri() {
            #Uri da Request
            $uri = $this->_request->getUri();

            #Quebro a Uri com o prefixo
            $xUri = strlen($this->_prefix) ? explode($this->_prefix, $uri) : [$uri];

            #Retorno a URI sem prefixo
            return end($xUri);
        }

        /**
         * Método responsável por retornar os dados da rota atual
         *
         * @return void
         */
        public function getRoute() {
            #Pego a Uri da requisição
            $uri = $this->getUri();

            #Pego o método HTTP da requisição
            $httpMethod = $this->_request->getHttpMethod();

            #Percorro todas as rotas e vejo se bate com o padrão
            foreach ($this->_routes as $patternRoute => $methods) {
                if(preg_match($patternRoute, $uri, $matches)) {
                    if(isset($methods[$httpMethod])) {
                        #Não preciso da primeira posição
                        unset($matches[0]);
                        
                        #Chaves
                        $keys = $methods[$httpMethod]["variables"];
                        $methods[$httpMethod]["variables"] = array_combine($keys, $matches);
                        $methods[$httpMethod]["variables"]["request"] = $this->_request;

                        return $methods[$httpMethod];
                    }

                    throw new Exception("Método não permitido", 405);
                    
                }
            }
            
            throw new Exception("URL não encontrada", 404);
        }

        /**
         * Método responsável por definir uma rota GET
         *
         * @param string $route
         * @param array $params
         * @return void
         */
        public function get($route, $params = []) {
            return $this->addRoute("GET", $route, $params);
        }

        /**
         * Método responsável por definir uma rota POST
         *
         * @param string $route
         * @param array $params
         * @return void
         */
        public function post($route, $params = []) {
            return $this->addRoute("POST", $route, $params);
        }

        /**
         * Método responsável por definir uma rota GET
         *
         * @param string $route
         * @param array $params
         * @return void
         */
        public function put($route, $params = []) {
            return $this->addRoute("PUT", $route, $params);
        }

        /**
         * Método responsável por definir uma rota GET
         *
         * @param string $route
         * @param array $params
         * @return void
         */
        public function delete($route, $params = []) {
            return $this->addRoute("DELETE", $route, $params);
        }

        /**
         * Método responsável por renderizar a rota atual
         * 
         * @return Response
         */
        public function run() {
            try {
                
                $route = $this->getRoute();

                if(!isset($route["controller"])) {
                    throw new Exception("A URL não pôde ser processada!", 500);
                }

                $args = [];

                $reflection = new ReflectionFunction($route["controller"]);

                foreach($reflection->getParameters() as $parameter) {
                    $name = $parameter->getName();

                    #Verifico se existe o parâmetro pego 
                    $args[$name] = $route["variables"][$name] ?? '';
                }
                
                return call_user_func_array($route["controller"], $args);

            } catch (Exception $e) {
                return new Response($e->getCode(), $e->getMessage());
            }
        }
    }
?>