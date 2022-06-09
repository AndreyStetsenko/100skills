<?php
namespace App\View\Components\Panel\Nav;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class NavComponent extends Component
{
    /*
     * Список доступных модулей
     */
    public $catalog = null;
    
    /*
     * Активная страница
     */
    public $uri = "Панель управления";
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->catalog = array(
            array(
                'title' => 'Панель управления',
                'link'  => "admin",
            ),
        );

        if( auth()->user()->roles()->first()->name == 'Admin'){
            $this->catalog = $this->avaliableModules();
        }
        
        $route = Route::current();

        foreach ($this->catalog as $key => $value) {
            if( $value['link'] == $route->uri ){
                $this->uri = $value['title'];
            }
            continue;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.panel.nav.nav-component', [
            'catalog' => $this->catalog,
            'uri' => $this->uri,
        ]);
    }

    /**
     * Get list of availiable admin modules
     *
     * @return array()
     */
    public function avaliableModules()
    {
        $catalog = array();
        $catalog[] = array(
            'title' => 'Курсы',
            'link'  => "component/course",
        );
        $catalog[] = array(
            'title' => 'Акции',
            'link'  => "component/action",
        );
        $catalog[] = array(
            'title' => 'Блог',
            'link'  => "component/blog",
        );
        $catalog[] = array(
            'title' => 'Контакты',
            'link'  => "component/contact",
        );
        $catalog[] = array(
            'title' => 'Тарифы',
            'link'  => "component/tarif",
        );
        $catalog[] = array(
            'title' => 'Учёт школ и преподавателей',
            'link'  => "component/school",
        );

        /**
         * 
         * Обязательные разделы 
         * 
         */
        $catalog[] = array(
            'title' => 'Меню и контент страница',
            'link'  => "component/page",
        );
        $catalog[] = array(
            'title' => 'Пользователи',
            'link'  => "component/users",
        );
        $catalog[] = array(
            'title' => 'Формы и настройки сайта',
            'link'  => "component/settings",
        );

        return $catalog;
    }
}
