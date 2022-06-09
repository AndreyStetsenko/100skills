<?php

namespace App\View\Components\Client\Forms;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


class SearchComponent extends Component
{

    /**
     * The meta data of the page.
     *
     * @var string
     */
    public $query = array(
        "raw" => "",
    );

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->query["raw"] = $request->input("query");

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.form.search-component", [
            'query' => $this->query,
            'class' => (Route::current()->uri != "/" ? "submit-await" : ""),
        ]);
    }
}
