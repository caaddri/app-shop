<?php

Route::get('/', 'TestController@welcome');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Lo pasamos antes de /products/{id} para que se resuelva primero esta ruta sino se resuleve por la otra
Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/home', 'HomeController@index')->name('home');
//Listado de productos
Route::get('/products/{id}', 'ProductController@show');
Route::get('/categories/{category}', 'CategoryController@show'); //se puede usar tanto id como category como parametro el instructor esta usando esta otra forma

//Agregar productos al carrito
Route::post('/cart', 'CartDetailController@store');
//Eliminar productos de carrito
Route::delete('/cart', 'CartDetailController@destroy');

//Pedidos o ordenes
Route::post('/order', 'CartController@update');

//Rutas para el administrador de la página
Route::middleware(['auth', 'admin'])->group(function () {
  //////////Para los productos//////////
  Route::get('/admin/products', 'Admin\ProductController@index'); //listado
  //Insertar
  Route::get('/admin/products/create', 'Admin\ProductController@create'); //formulario de registro
  Route::post('/admin/products', 'Admin\ProductController@store'); //registrar
  //Editar
  Route::get('/admin/products/{id}/edit', 'Admin\ProductController@edit'); //formulario de edición
  Route::post('/admin/products/{id}/edit', 'Admin\ProductController@update'); //editar
  //Eliminar
  Route::post('/admin/products/{id}/delete', 'Admin\ProductController@destroy'); //eliminar

  //////////Para las imágenes de los productos//////////
  Route::get('/admin/products/{id}/images', 'Admin\ImageController@index'); //listado
  Route::post('/admin/products/{id}/images', 'Admin\ImageController@store'); //registrar
  Route::delete('/admin/products/{id}/images', 'Admin\ImageController@destroy'); //eliminar
  Route::get('/admin/products/{id}/images/select/{image}', 'Admin\ImageController@select'); //destacar

  //////////Para las categorías//////////
  Route::get('/admin/categories', 'Admin\CategoryController@index'); //listado
  //Insertar
  Route::get('/admin/categories/create', 'Admin\CategoryController@create'); //formulario de registro
  Route::post('/admin/categories', 'Admin\CategoryController@store'); //registrar
  //Editar
  Route::get('/admin/categories/{id}/edit', 'Admin\CategoryController@edit'); //formulario de edición
  Route::post('/admin/categories/{id}/edit', 'Admin\CategoryController@update'); //editar
  //Eliminar
  Route::post('/admin/categories/{id}/delete', 'Admin\CategoryController@destroy'); //eliminar
});
