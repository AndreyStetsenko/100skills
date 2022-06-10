<?php

namespace App\View\Components\Client\Catalog;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Course\Category as Category;
use App\Models\Course\Item as Course;

class PopularComponent extends Component
{

    /**
     * The meta data of the page.
     *
     * @var string
     */
    public $items = array(
        "category" => array(),
    );

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->items["category"] = Category::where("parent_id", 0)->with(["childs", "catalog"])->orderBy("sort")->get()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $courses = Course::where("is_visible", 1)->get();
        $categories = Category::where("parent_id", 0)->with(["childs", "catalog"])->orderBy("sort")->get();

        return view("components.client.catalog.popular-component", [
            'items' => $this->items,
            'categories' => $categories,
            'courses' => $courses
        ]);
    }
}
