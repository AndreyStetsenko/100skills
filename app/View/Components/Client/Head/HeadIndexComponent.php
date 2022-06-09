<?php

namespace App\View\Components\Head;

use Illuminate\View\Component;

use Illuminate\Support\Facades\Route;

use App\Models\Page\Page;
use App\Models\Page\Menu;

class HeadIndexComponent extends Component
{

    /**
    * The current path.
    *
    * @var string
    */
   public $uri;
   
     /**
     * The view template
     *
     * @var string
     */
     public $view;
    /**
     * The meta data of the page.
     *
     * @var string
     */
    public $meta = array(
        'title' => "",
        'description' => "",
        'kaywords' => "",
        'h1' => "",
    );

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $route = Route::current();
        # главная страница
        $this->uri = $route->uri;
        $this->meta = array(
            'title' => "Главная страница",
            'description' => "Главная страница",
            'keywords' => "Главная страница",
            'h1' => "Главная страница",
        );
        $this->view = 'components.client.head.head-index-component';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view($this->view, [
            'meta' => $this->meta,
        ]);
    }
}
