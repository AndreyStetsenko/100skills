<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Page;

use Illuminate\Support\Str;
class MenuSeeder extends Seeder
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
                "parent_id" => 0,
                "title" => "Акции",
                "slug" => "action",
                "is_visible" => 1,
                "is_managable" => 1,
            ),
            array(
                "parent_id" => 0,
                "title" => "Партнёрам",
                "slug" => "for-partners",
                "is_visible" => 1,
                "is_managable" => 1,
            ),
            array(
                "parent_id" => 0,
                "title" => "Блог",
                "slug" => "blog",
                "is_visible" => 1,
                "is_managable" => 1,
            ),
            array(
                "parent_id" => 0,
                "title" => "Контакты",
                "slug" => "contact",
                "is_visible" => 1,
                "is_managable" => 1,
            ),
        );






        foreach ( $items as $key => $value ) {
            $item = new Menu();
            $item->slug = Str::slug($value["title"], '-');
            $item->title = $value["title"];
            $item->slug = $value["slug"];
            $item->parent_id = $value["parent_id"];
            $item->is_visible = $value["is_visible"];
            $item->is_managable = $value["is_managable"];

            $item->sort = $key;

            $result = $item->save();
            if( $result ){
                # создание страницы, привязка к пункту меню и сохранение
                $page = new Page();
                $page->meta_title = $item->title;
                $item->pages()->save($page);
            }
        }        

        // Menu::factory()
        //         ->count(1)
        //         ->create();
    }
}
