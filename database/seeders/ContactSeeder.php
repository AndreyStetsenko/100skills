<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

use App\Models\Contact\Item as Item;

use Illuminate\Support\Str;

class ContactSeeder extends Seeder
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
                "title" => "Телефон",
                "value" => "+375339116584",
                "slug" => "phone",
                "href" => "tel:+375339116584",
            ),
            array(
                "title" => "Email",
                "value" => "vladislav.workpage@gmail.com",
                "slug" => "email",
                "href" => "mailto:vladislav.workpage@gmail.com",
            ),
            array(
                "title" => "Адрес",
                "slug" => "adress",
                "value" => "г. Минск, пр. Машерова, д. 17/1",
            ),
        );

        foreach( $items as $key => $value ){
            $item = new Item();
            $item->title = $value["title"];
            $item->slug = $value["slug"];
            # $item->slug = Str::slug(($value["title"] . " " . $category_key . " " . $key), '-');
            
            $item->value = $value['value'];
            $item->href = isset($value['href']) ? $value['href'] : null;
            $item->is_visible = 1;
            
            $item->sort = $key;
            $item->save();
        }
    }
}
