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

    //Assesor o método mágico
    public function getFeaturedImageUrlAttribute()
    {
      $featuredProduct = $this->products()->first();
      return $featuredProduct->featured_image_url;
    }
}
