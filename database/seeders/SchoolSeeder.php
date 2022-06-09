<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\School\Item as School;
use App\Models\User;
use App\Models\Tarif\Item as Tarif;

use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
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
                "title" => "Пушкинский лицей",
                "slug" => "pushkin-lyceum",
                "adress" => "Москва",
            ),
            array(
                "title" => "Первая гимназия",
                "slug" => "first-gymnasium",
                "adress" => "Минск",
            ),
            array(
                "title" => "Унивеситет",
                "slug" => "uni",
                "adress" => "Минск",
            ),
        );
        $user_id = User::whereHas("roles", function($query){
            return $query->where( "roles.name", "=", "account" );
        })->first();
        $tarif_id = Tarif::first()->id;
        foreach ( $items as $key => $value ) {
            $item = new School();
            $item->title = $value["title"];
            $item->slug = $value["slug"];
            $item->adress = $value["adress"];
            $item->user_id = $user_id["id"];
            $item->tarif_id = $tarif_id;
            
            $item->is_visible = 1;
            $item->sort = $key;

            $item->save();
        }

    }
}
