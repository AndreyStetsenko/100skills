<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

use App\Models\Action\Category as Category;
use App\Models\Action\Item as Item;
use App\Models\School\Item as School;

use Illuminate\Support\Str;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = array(
            array(
                "title" => "Весенние акции",
                "slug" => "spring-action",
            ),
        );

        foreach ( $category as $key => $value ) {
            $item = new Category();
            $item->title = $value["title"];
            $item->slug = $value["slug"];
            $item->parent_id = 0;
            $item->is_visible = 1;
            $item->sort = $key;
            $item->save();
        }

        $items = array(
            array(
                "title" => "Акция на майские праздники",
                "body_short" => "Краткое описание акции",
                "body_long" => "Полное описание акции",
                "meta_title" => "Meta title",
                "meta_description" => "Meta description",
                "meta_keywords" => "Meta keywords",
                "meta_canonical" => "/canonical",
            ),
        );
        $school = School::first();

        foreach ( $category as $category_key => $category_value ) {
            foreach( $items as $key => $value ){
                $item = new Item();
                $item->title = $category_value["title"] . " " . $value["title"];
                $item->slug = Str::slug(($value["title"] . " " . $category_key . " " . $key), '-');
                
                $item->category_id = ($category_key + 1);

                $item->body_short = $value['body_short'];
                $item->body_long = $value['body_long'];
                $item->meta_title = $value['meta_title'];
                $item->meta_description = $value['meta_description'];
                $item->meta_keywords = $value['meta_keywords'];
                $item->meta_canonical = $value['meta_canonical'];
                
                $item->is_visible = 1;
                
                $item->sort = $key;

                $item->save();

                # School::first()->action()->save($item);
                $school->first()->action()->attach($item->id);
            }
        }
    }
}
