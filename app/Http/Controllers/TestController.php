<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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

      $products = Product::paginate(9);

      return view('welcome')->with(compact('products'));
    }
}
