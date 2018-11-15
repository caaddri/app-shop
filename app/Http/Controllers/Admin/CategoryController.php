<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{
  //
  public function index()
  {
    $categories = Category::orderBy('name')->paginate(10);
    return view('admin.categories.index')->with(compact('categories')); //listado
  }

  public function create()
  {
    return view('admin.categories.create'); //formulario de registro
  }

  public function store(Request $request)
  {
    //Validar datos
    $messages = [
      'name.required' => 'Es necesario ingresar un nombre para la categoría',
      'name.min' => 'El nombre de la categoría debe tener almenos 3 caracteres',
      'description.max' => 'La descripción debe tener un máximo de 200 caracteres'
    ];
    $rules = [
      'name' => 'required|min:3',
      'description' => 'max:200'
    ];
    $this->validate($request, $rules, $messages);

    //registrar la nueva categoría en la bd
    //dd($request->all());
    $category = new Category();
    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->save(); //insert

    return redirect('/admin/categories');
  }

  public function edit($id)
  {
    $category = Category::find($id);
    return view('admin.categories.edit')->with(compact('category')); //formulario de registro
  }

  public function update(Request $request, $id)
  {
    //Validar datos
    $messages = [
      'name.required' => 'Es necesario ingresar un nombre para la categoría',
      'name.min' => 'El nombre de la categoría debe tener almenos 3 caracteres',
      'description.max' => 'La descripción debe tener un máximo de 200 caracteres'
    ];
    $rules = [
      'name' => 'required|min:3',
      'description' => 'max:200'
    ];
    $this->validate($request, $rules, $messages);

    $category = Category::find($id);
    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->save(); //update

    return redirect('/admin/categories');
  }

  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete(); //delete

    return back();
  }
}
