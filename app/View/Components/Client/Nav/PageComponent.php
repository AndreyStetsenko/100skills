<?php

namespace App\View\Components\Client\Nav;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

use App\Models\Page;
use App\Models\Menu;
use App\Models\Course\Category;

class PageComponent extends Component
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
        $where = array();
        $where[] = array("parent_id", "=", "0");
        $where[] = array("is_visible", "=", "1");

        # формирование меню
        $this->menu = Menu::where($where)->get();
        if ( !1 ) {
            $item = Menu::where([
                ["slug", '=', $url],
                ["is_visible", '=', '1'],
            ])->with(['pages'])->first();

            $routes = array();

            $this->route = ($this->uri == '/') ? null : "/";
            if ( isset($routes[$this->uri]) ) {
                $this->route = $routes[$this->uri];
            }
        }

        # определяем категории
        $this->category = null;
        $this->category = Category::where("parent_id", 0)->with(["childs"])->get();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.nav.page-component", [
            "route" => $this->uri,
            "menu" => $this->menu,
            "category" => $this->category,
        ]);
    }

}
