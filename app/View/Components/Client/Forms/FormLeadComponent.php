<?php

namespace App\View\Components\Client\Forms;

use Illuminate\View\Component;

class FormLeadComponent extends Component
{
    /**
     * 
     * @param array $response
     *  
     */
    public $response;


    /**
     * 
     * Собираем параметры
     * 
     * @param  \Illuminate\Http\Request  $request 
     * 
     */
    public function __construct()
    {

    }
 
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.client.form.form-lead-component', []);
    }
}
