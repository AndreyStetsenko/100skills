<?php

namespace App\View\Components\Client\Header;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

use App\Models\School\Item as School;

class HeaderLkComponent extends Component
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
        $routes = array(); 

        $this->route = ($this->uri == '/') ? null : "/";
        if ( isset($routes[$this->uri]) ) {
            $this->route = $routes[$this->uri];
        }

        # поиск пользователя
        $session = auth()->user()->id;
        $this->school = School::where("user_id", $session)->with(["user", "gallery"])->first();
        $this->user = (!is_null($this->school) ? $this->school->user : null);

        
        $this->view = 'components.client.header.header-lk-component';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view($this->view, [
            'route' => $this->route,
            'user' => $this->user,
            'item' => $this->school,
        ]);
    }
}
