<?php
use App\Controllers;

class Router {

    protected $conn;

    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(\PDO $conn) {
        $this->conn = $conn;
    }
    public function loadRoutes(array $routes){

        $this->routes = $routes;
    }

    public function getRoutes(){
        return $this->routes;
    }

    public function dispatch() {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url = trim($url, '/');

    $method = $_SERVER['REQUEST_METHOD'];
    //return $this->processQueue($url, $method);
    //GET['post/create']
   if(array_key_exists($method, $this->routes)
            &&
            array_key_exists($url, $this->routes[$method])
            ){
            return $this->route($this->routes[$method][$url]);
            }
            else{
                return $this->processQueue($url, $method);

            }

    }

    protected function processQueue($uri, $method = 'GET'){
        // routes ['GET'] =
        $routes = $this->routes[$method];
        //print_r($routes);

        foreach($routes as $route => $callback){
            // converte url '/post/:id' in regular expression
            $regMatch = preg_quote($route);
            // :id ([a-zA-Z0-9\-\_]+)

            // post/([a-zA-Z0-9\-\_]+) # nota: ([a-zA-Z0-9\-\_]+) == ([a-z0-9\-\_]i+)
            $subPattern = preg_replace('/\\\:[a-zA-Z0-9\_\-]+/','([a-zA-Z0-9\-\_]+)', $regMatch);

            // @^post/([a-zA-Z0-9\-\_]+)$@
            $pattern = "@^" .$subPattern. "$@D";

            // echo $pattern . '<br>';

            $matches = Array();
            // check if the current request matches the expression
            if(preg_match($pattern, $uri, $matches)){
                // remove the first match

                array_shift($matches);
                return $this->route($callback, $matches);
            }
        }
        throw new Exception('Nessuna rotta corrispondente per ' . $uri);
    }

    protected function route($callback, array $matches=[]){
        try{
            if(is_callable($callback)){
               return call_user_func_array($callback, $matches);
            }

        $tokens = explode('@', $callback);

        $controller = $tokens[0];
        $method = $tokens[1];

            $class = new $controller($this->conn);

            if(method_exists($class, $method)){

                call_user_func_array([$class, $method], $matches);
                return $class;
            }else{
                throw new Exception('Metodo '.$method.' non trovato nella class '.$controller);
            }
        //$controller = new $class
        } catch(Exception $e){
            die($e->getMessage());
        }
    }
}
