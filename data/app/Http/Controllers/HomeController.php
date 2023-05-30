<?php 

namespace App\Http\Controllers;

use App\models\Connection;
use App\models\Item;

class HomeController
{
    public function index(){
        return view('home');
    }

     public function buscarItem(){
        $item = new Item();
        $item->setAtributo('_code',$_POST['code']);
        return $item->getDataCode();
     } 

}

