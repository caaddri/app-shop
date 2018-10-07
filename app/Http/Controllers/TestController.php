<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
      //Pruebas varias
      // $a = 5;
      // $b = 10;
      // $c = $a + $b;
      //
      // return "El valor de la suma es $c";
      
      return view('welcome');
    }
}
