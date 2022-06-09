<?php

namespace App\View\Components\Client\Nav;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

use App\Models\Page;
use App\Models\Menu;

class BreadcrumbComponent extends Component
{
    public $links = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($links = null)
    {
        $this->links = $links;
        # определяем страницу
        $route = Route::current();
        $this->uri = $route->uri;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.nav.breadcrumb-component", [
            "route" => $this->uri,
            "links" => $this->links,
        ]);
    }

}
