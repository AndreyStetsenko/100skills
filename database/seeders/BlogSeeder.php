<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

use App\Models\Blog\Category as Category;
use App\Models\Blog\Item as Item;

use Illuminate\Support\Str;

class BlogSeeder extends Seeder
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
                "title" => "Курсы",
                "slug" => "about-course",
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
                "title" => "Фундаментальный JavaScript. С чего начать?",
                "body_short" => "Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте.",
                "body_long" => "Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте. Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте.",
                "meta_title" => "Meta title",
                "meta_description" => "Meta description",
                "meta_keywords" => "Meta keywords",
                "meta_canonical" => "/canonical",
                "is_index" => 1,
            ),
            array(
                "title" => "Data Science и Machine Learning",
                "body_short" => "Изучи Python 3 с нуля для работы с Data Science и и Machine Learning библиотеками.",
                "body_long" => "Специалист по анализу данных - одна из наиболее подходящих профессий для процветания в этом веке. Он цифровой, ориентированный на программирование и аналитический. Поэтому неудивительно, что спрос на специалистов по анализу данных на рынке труда растет",
                "meta_title" => "Meta title",
                "meta_description" => "Meta description",
                "meta_keywords" => "Meta keywords",
                "meta_canonical" => "/canonical",
                "is_index" => null,
            ),
        );
        $category = Category::where("parent_id", 0)->get();
        foreach ( $category as $category_key => $category_value ) {
            foreach( $items as $key => $value ){
                $item = new Item();
                $item->title = $category_value["title"] . " " . $value["title"];
                $item->slug = Str::slug(($value["title"] . " " . $category_value["id"] . " " . $key), '-');
                
                $item->category_id = $category_value["id"];

                $item->body_short = $value['body_short'];
                $item->body_long = $value['body_long'];
                $item->meta_title = $value['meta_title'];
                $item->meta_description = $value['meta_description'];
                $item->meta_keywords = $value['meta_keywords'];
                $item->meta_canonical = $value['meta_canonical'];
                
                $item->is_index = $value['is_index'];
                $item->is_visible = 1;
                
                $item->sort = $key;
                $item->save();
            }
        }
    }
}
