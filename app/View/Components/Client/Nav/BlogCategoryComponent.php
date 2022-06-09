<?php

namespace App\View\Components\Client\Nav;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

use App\Models\Blog\Category;

class BlogCategoryComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $where = array();
        // $where[] = array("parent_id", "=", "0");
        $where[] = array("is_visible", "=", "1");

        $this->items = Category::where($where)->get();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.nav.blog-category-component", [
            "items" => $this->items,
        ]);
    }

}
