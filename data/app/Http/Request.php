<?php 

namespace App\Http;

use App\Http\Response;

class Request 
{
    protected $segments = [];
    protected $controller;
    protected $method;

    public function __construct(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);        
        $this->setController();
        $this->setMethod();
    }

    public function setController(){
       $this->controller = empty($this->segments[1])?'home':$this->segments[1];
    }

    public function setMethod(){
        $this->method = empty($this->segments[2])?'index':$this->segments[2]; 
    }

    public function getController(){
        $controller = ucfirst($this->controller);
        return "App\Http\Controllers\\{$controller}Controller";
    }

    public function getMethod(){
        return $this->method;
    }

    public function send(){
        $controller = $this->getController();
        $method = $this->getMethod();
        $response = call_user_func([
            new $controller,
            $method
        ]);
                
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                if ($response instanceof Response) {                
                    $response->send();            
                } else {
                    throw new \Exception("Error Processing Request");                
                }
            } catch (\Exception $e) {
                echo "Details {$e->getMessage()}";
            }

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {       

            $post = new Response();
            $post->postSend($response);          
        }                
    }

}
