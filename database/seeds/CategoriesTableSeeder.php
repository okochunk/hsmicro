<?php

use App\Categories;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Categories();
        $category->uuid = 'X1X2';
        $category->name = 'default';
        $category->save();

        $category = new Categories();
        $category->uuid = 'b217an';
        $category->name = 'Bread';
        $category->save();

        $category = new Categories();
        $category->uuid = 'b327an';
        $category->name = 'Baps';
        $category->save();

        $category = new Categories();
        $category->uuid = 'c317an';
        $category->name = 'Cakes';
        $category->save();

        $category = new Categories();
        $category->uuid = 'm217an';
        $category->name = 'Morning Goods';
        $category->save();
    }
}
