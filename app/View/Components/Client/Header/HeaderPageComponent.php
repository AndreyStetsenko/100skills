<?php

namespace App\View\Components\Client\Header;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

use App\Models\Page;
use App\Models\Menu;

class HeaderPageComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        # определяем страницу
        $route = Route::current();
        $this->uri = $route->uri;

        $this->menu = Menu::all();

        $where = array();
        $where[] = array("parent_id", "=", "0");
        $where[] = array("is_visible", "=", "1");
        $item = Menu::where($where)->with(['pages'])->first();


        $routes = array();

        $this->route = ($this->uri == '/') ? null : "/";
        if ( isset($routes[$this->uri]) ) {
            $this->route = $routes[$this->uri];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view("components.client.header.header-page-component", [
            "route" => $this->route,
            "menu" => $this->menu,
        ]);
    }

}
