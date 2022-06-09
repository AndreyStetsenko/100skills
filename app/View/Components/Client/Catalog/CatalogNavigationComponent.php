<?php

namespace App\View\Components\Client\Catalog;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class CatalogNavigationComponent extends Component
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
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.catalog.navigation-component");
    }
}
