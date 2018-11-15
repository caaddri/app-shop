<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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

      $categories = Category::has('products')->get();
      return view('welcome')->with(compact('categories'));
    }
}
