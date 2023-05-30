<?php 

namespace App\Http;

class Response 
{
    protected $view;

    public function __construct($view = null)
    {
        $this->view = $view;    
    }
    
    public function getView()
    {
        return $this->view;
    }

    public function send()
    {
        $view = $this->getView();
        $content = file_get_contents(viewPath($view));
        require viewPath('layout');
    }

    public function postSend($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    
}