<?php

namespace App\View\Components\Client\Catalog;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Course\Item;

class SimilarComponent extends Component
{

    /**
     * The meta data of the page.
     *
     * @var string
     */
    public $items = array(
        "category" => array(),
        "similar" => array(),
    );

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $id)
    {
        $item = Item::where("id", $id)->with(["similar", "similar.gallery"])->orderBy("sort");
        $this->items["item"] = $item->first()->toArray();
        $this->items["similar"] = $item->first()->similar()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.catalog.similar-component", [
            'items' => $this->items,
        ]);
    }
}
