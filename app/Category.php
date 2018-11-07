<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Asociar Category->Product
    public function products()
    {
      return $this->hasMany(Product::class);
    }
}
