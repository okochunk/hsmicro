<?php

use App\Categories;
use App\Products;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Categories::where('id', 1)->first();

        $product = new Products();
        $product->uuid = 'P4I';
        $product->name = 'Small Cakes';
        $product->internal_code = '1017';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 10;
        $product->save();

        $product = new Products();
        $product->uuid = 'H41';
        $product->name = 'Fresh Cream Cakes';
        $product->internal_code = '1016';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 20;
        $product->save();

        $product = new Products();
        $product->uuid = 'C41';
        $product->name = 'Photos Cakes';
        $product->internal_code = '1015';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

        $product = new Products();
        $product->uuid = 'W41';
        $product->name = 'Wedding Cakes';
        $product->internal_code = '1014';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

        $product = new Products();
        $product->uuid = 'N41';
        $product->name = 'Novelty Cakes';
        $product->internal_code = '1013';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

        $product = new Products();
        $product->uuid = 'FM2';
        $product->name = 'Farmhouse Loaf';
        $product->internal_code = '1012';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

        $product = new Products();
        $product->uuid = 'SL2';
        $product->name = 'Sandwich Loaf';
        $product->internal_code = '1011';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

        $product = new Products();
        $product->uuid = 'BL2';
        $product->name = 'Bloomers';
        $product->internal_code = '2017';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

        $product = new Products();
        $product->uuid = 'TG2';
        $product->name = 'Tiger Bread';
        $product->internal_code = '3017';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

        $product = new Products();
        $product->uuid = 'FS2';
        $product->name = 'French Sticks';
        $product->internal_code = '4017';
        $product->category_id = $category->id;
        $product->quantity = 50;
        $product->price = 30;
        $product->save();

    }
}
