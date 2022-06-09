<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->word;
        $slug = Str::slug($title, '-');
        return [
            "menu_id" => \App\Models\Menu::factory(),
            "is_visible" => 1,
            "body" => $this->faker->text,
            "meta_title" => $this->faker->word,
            "meta_description" => $this->faker->word,
            "meta_keywords" => $this->faker->word,
        ];
    }
}
