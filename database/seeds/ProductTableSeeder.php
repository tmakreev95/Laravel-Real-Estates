<?php

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
        $product = new \App\Product(['imagePath'=>'https://d1urewwzb2qwii.cloudfront.net/sys-master/images/hb2/h87/8875452465182/RZ03-01762000-R3M1.png_300Wx300H',
        'title'=>'Razer Keyboard',
        'description'=>'Good keyboard',
        'price'=>120
      ]);
        $product->save();

        $product = new \App\Product(['imagePath'=>'http://www.tmt.my/onlinestore/image/catalog/products/razer-imperator-gallery-21.png',
        'title'=>'Razer Mouse',
        'description'=>'Good mouse',
        'price'=>130
      ]);
        $product->save();

        $product = new \App\Product(['imagePath'=>'http://assets.razerzone.com/eeimages/products/16/razer-electra-gallery-7.png',
        'title'=>'Razer Headphones',
        'description'=>'Good headphones',
        'price'=>100
      ]);
        $product->save();

        $product = new \App\Product(['imagePath'=>'https://www.casadelaudio.com/Image/0/400_400-225-SON-467_1.png',
        'title'=>'Fifa 18',
        'description'=>'Good game',
        'price'=>200
      ]);
        $product->save();

        $product = new \App\Product(['imagePath'=>'http://i0.kym-cdn.com/photos/images/original/001/007/423/282.png',
        'title'=>'WoW Legion',
        'description'=>'Good game',
        'price'=>150
      ]);
        $product->save();

        $product = new \App\Product(['imagePath'=>'https://cdn.wccftech.com/wp-content/uploads/2015/04/God-of-War-1.png',
        'title'=>'God of War',
        'description'=>'Good game',
        'price'=>170
      ]);
        $product->save();
    }
}
