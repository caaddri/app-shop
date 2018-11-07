<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model factory (en este caso alguna categoría puede quedar sin productos o productos sin imagen)
        // factory(Category::class, 5)->create();
        // factory(Product::class, 100)->create();
        // factory(ProductImage::class, 200)->create();

        //Model factory (en este caso extrictamente todas las categorías deben tener almenos un producto y los
        //productos almenos una imagen asociada)
        $categories = factory(Category::class, 4)->create();
        $categories->each(function ($category) {
          $products = factory(Product::class, 5)->make();
          $category->products()->saveMany($products);

          $products->each(function ($p) {
            $images= factory(ProductImage::class, 3)->make();
            $p->images()->saveMany($images);
          });
        });
    }
}
