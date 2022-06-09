<?php

namespace App\View\Components\Client\Catalog;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Course\Category as Category;
use App\Models\Course\Item as Course;

class FoundComponent extends Component
{

    /**
     * The meta data of the page.
     *
     * @var string
     */
    public $items = array(
        "items" => array(),
    );

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // $this->items["category"] = Category::where("parent_id", 0)->with(["childs", "catalog"])->groupBy("catalog.is_online")->orderBy("sort")->get()->toArray();
        $this->items["online"] = Course::orderBy("sort")->where("is_online", "=", 1)->get();
        $this->items["offline"] = Course::orderBy("sort")->where("is_online", "!=", 1)->get();
        // dd(__METHOD__, $this->items["online"]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.catalog.found-component", [
            'items' => $this->items,
        ]);
    }
}
