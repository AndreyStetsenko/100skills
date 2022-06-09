<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Models\Page;
// use App\Models\Tarif\Category as Category;
use App\Models\Tarif\Item as Item;

use Illuminate\Support\Str;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $items = array(
            array(
                "title" => "Тариф Демо",
                "price_1" => "0",
                "price_3" => "0",
            ),
            array(
                "title" => "Тариф 1",
                "price_1" => "1999",
                "price_3" => "4999",
            ),
            array(
                "title" => "Тариф MAX",
                "price_1" => "3999",
                "price_3" => "6999",
            ),
        );

        foreach( $items as $key => $value ){
            $item = new Item();
            $item->title = $value["title"];
            $item->slug = Str::slug($value["title"], '-');
            $item->price_1 = $value["price_1"];
            $item->price_3 = $value["price_3"];
            
            $item->is_visible = 1;
            
            $item->sort = $key;
            $item->save();
        }
    }
}
