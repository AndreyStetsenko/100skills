<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = "Тестовая страница";
        $slug = Str::slug($title, '-');
        return [
            "parent_id" => 0,
            "title" => $title,
            "slug" => $slug,
            "is_visible" => 1,
            "is_managable" => 1,
        ];
    }
}
