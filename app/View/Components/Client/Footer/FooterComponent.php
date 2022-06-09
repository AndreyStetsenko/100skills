<?php

namespace App\View\Components\Client\Footer;

use Illuminate\View\Component;

use Illuminate\Support\Facades\Route;

use App\Models\Menu;
use App\Models\Contact\Item as Contact;

class FooterComponent extends Component
{
    public function __construct()
    {
        
        $this->view = 'components.client.footer.footer-component';

        # формирование меню
        $where = array();
        $where[] = array("parent_id", "=", "0");
        $where[] = array("is_visible", "=", "1");
        $this->menu = Menu::where($where)->get();

        # определяем категории
        # поиск пользователя
        $this->contact = Contact::latest()->orderBy("sort")->get();

        # $this->user = School::where("user_id", $session)->with(["user", "gallery"])->first()->user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view($this->view, [
            "menu" => $this->menu,
            "contact" => $this->contact,
        ]);
    }
}
