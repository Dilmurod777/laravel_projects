<?php

use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::all()->each(function ($product) {
            $gallery = factory(\App\Models\Gallery::class)->create();
            $product->gallery()->save($gallery);
        });
    }
}
