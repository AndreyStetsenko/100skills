<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Course\Category as Category;
use App\Models\Course\Item as Course;
use App\Models\School\Item as School;

use Illuminate\Support\Str;

class CourseSeeder extends Seeder
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
                "title" => "PHP",
                "slug" => "php-code",
            ),
            array(
                "title" => "Управление",
                "slug" => "managment",
            ),
            array(
                "title" => "Маркетинг",
                "slug" => "marketing",
            ),
            array(
                "title" => "Геймдизайн",
                "slug" => "gamedesign",
            ),
            array(
                "title" => "Образ жизни",
                "slug" => "lifestyle",
            ),
            array(
                "title" => "UX/UI-дизайн",
                "slug" => "ux-ui",
            ),
            array(
                "title" => "SMM",
                "slug" => "smm",
            ),
        );
        $subcategory = array(
            array(
                "title" => "Театр, опера, балет",
                "slug" => "theater",
            ),
            array(
                "title" => "Здоровье и уход за собой",
                "slug" => "healthcare",
            ),
            array(
                "title" => "Хобби и творчество",
                "slug" => "hobby",
            ),
            array(
                "title" => "Искусство",
                "slug" => "paits",
            ),
            array(
                "title" => "Кино: создание и как смотреть",
                "slug" => "movies",
            ),
            array(
                "title" => "Рецепты",
                "slug" => "recipe",
            ),
            array(
                "title" => "Новости HiTech",
                "slug" => "h-tec",
            ),
            array(
                "title" => "Темы из жизни",
                "slug" => "commonlife",
            ),
            array(
                "title" => "Лонгриды",
                "slug" => "longrids",
            ),
            array(
                "title" => "Биология",
                "slug" => "biology",
            ),
            array(
                "title" => "Велоспорт",
                "slug" => "bikes",
            ),
            array(
                "title" => "Путешествия",
                "slug" => "travel",
            ),
            array(
                "title" => "Хоккей",
                "slug" => "hockey",
            ),
            array(
                "title" => "IT-безопасность",
                "slug" => "itsecure",
            ),
            array(
                "title" => "Блогинг",
                "slug" => "bloging",
            ),
            array(
                "title" => "Футбол",
                "slug" => "Soccer",
            ),
            array(
                "title" => "Домашние животные",
                "slug" => "animals",
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

            foreach ($subcategory as $k => $v) {
                $sitem = new Category();
                $sitem->title = $v["title"];
                $sitem->slug = $v["slug"] . "-" . $item->slug;
                $sitem->parent_id = $item->id;
                $sitem->is_visible = 1;
                $sitem->sort = $k;
                $sitem->save();
            }
        }

        $items = array(
            array(
                "title" => "Мастер-класс",
                "is_online" => 2,
                "is_recomended" => 1,
                "duration" => 30,
                "price" => 900,
                "is_proffession" => null,
                "is_action" => 1,
                "is_certificate" => 1,
            ),
            array(
                "title" => "Ознакомительное занятие",
                "is_online" => 1,
                "duration" => 30,
                "price" => 900,
                "is_action" => 1,
                "is_proffession" => null,
            ),
            array(
                "title" => "Начинающий",
                "is_online" => 1,
                "duration" => 30,
                "price" => 900,
                "is_proffession" => null,
            ),
            array(
                "title" => "Продвинутый уровень",
                "is_online" => 1,
                "duration" => 90,
                "price" => 1900,
                "is_recomended" => 1,
                "is_proffession" => null,
            ),
            array(
                "title" => "Профессионал",
                "is_online" => 2,
                "duration" => 30,
                "price" => 900,
                "is_proffession" => 1,
                "is_certificate" => 1,
            ),
            array(
                "title" => "Мастер",
                "is_online" => 2,
                "duration" => 90,
                "price" => 1900,
                "is_recomended" => 1,
                "is_proffession" => 1,
                "is_jobable" => 1,
                "is_certificate" => 1,
            ),
        );
        
        $category = Category::where("parent_id", 0)->get();
        
        $school = School::first();

        foreach ( $category as $category_key => $category_value ) {
            foreach( $items as $key => $value ){
                $item = new Course();
                $item->title = $category_value["title"] . " " . $value["title"];
                $item->slug = Str::slug(($value["title"] . " " . $category_key . " " . $key), '-');
                $item->category_id = $category_value["id"];
                # $item->category_id = $value["category_id"];
                $item->is_online = $value["is_online"];
                $item->duration = ++$key;
                $item->price = $value["price"];
                $item->school_id = $school->id;
                $item->is_visible = 1;
                $item->is_action = isset($value["is_action"]) ? $value["is_action"] : 0;
                $item->is_recomended = isset($value["is_recomended"]) ? $value["is_recomended"] : null;
                $item->is_proffession = isset($value["is_proffession"]) ? $value["is_proffession"] : null;
                $item->is_jobable = isset($value["is_jobable"]) ? $value["is_jobable"] : null;
                $item->is_certificate = isset($value["is_certificate"]) ? $value["is_certificate"] : null;

                
                $item->is_online = isset($value["is_online"]) ? $value["is_online"] : null;
                // $item->is_online = ($key % 2 == 0 ? 1 : 0);
                $item->is_popular = ((($category_key % 2 == 0) && ($key % 2 == 0)) ? 1 : 0);                

                $item->sort = $key;
                $item->save();
            }
        }
    }
}
