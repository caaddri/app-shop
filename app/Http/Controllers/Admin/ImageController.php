<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;

class ImageController extends Controller
{
    //
    public function index($id)
    {
      $product = Product::find($id);
      $images = $product->images()->orderBy('featured', 'desc')->get();
      return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id)
    {
      //guardar la imagen en el proyecto
      $file = $request->file('photo');
      $path = public_path() . '/images/products';
      $filename = uniqid() . $file->getClientOriginalName();
      $moved =  $file->move($path, $filename);

      //crear un registro en la tabla product_images
      if ($moved)
      {
        $productImage = new ProductImage();
        $productImage->image = $filename;
        //$productImage->featured = ;
        $productImage->product_id = $id;
        $productImage->save(); //insert
      }
      return back();
    }

    public function destroy(Request $request, $id)
    {
      //eliminar la imagen de la carpeta del proyecto
      $productImage = ProductImage::find($request->input('image_id'));
      if (substr($productImage->image, 0,4) === "http")
      {
        $deleted = true;
      } else {
        $fullPath = public_path() . '/images/products/' .$productImage->image;
        $deleted = File::delete($fullPath);
      }

      //eliminar el registro en la tabla product_images
      if ($deleted)
      {
        $productImage->delete();
      }
      return back();
    }

    public function select($id, $image)
    {
      //destacar la imagen
      ProductImage::where('product_id', $id)->update([
        'featured' => false
      ]);

      $productImage = ProductImage::find($image);
      $productImage->featured = true;
      $productImage->save();

      return back();
    }
}
