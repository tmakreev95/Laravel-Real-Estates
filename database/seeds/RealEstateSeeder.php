<?php

use Illuminate\Database\Seeder;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realEstate = new \App\RealEstate(['imagePath'=>'https://unshakable.agency/wp-content/uploads/2020/02/Real-Estate-SEO.jpg',
            'title'=>'Test Real Estate 2 - Title',
            'description'=>'Test Real Estate 2 - Description',
            'dimension'=>250,
            'user_id'=>2
         ]);
        $realEstate->save();
    }
}
