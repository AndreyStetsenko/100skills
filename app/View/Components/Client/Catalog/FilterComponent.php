<?php

namespace App\View\Components\Client\Catalog;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Course\Category as Category;
use App\Models\Course\Item as Course;
use App\Models\School\Item as School;

class FilterComponent extends Component
{


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->adress = School::get()->unique('adress')->pluck("adress");
        $this->duration = Course::get()->unique('duration')->pluck("duration");
        $this->category = Category::all();
        $this->inputs = $request->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.client.catalog.filter-component", [
            'inputs' => $this->inputs,
            'adress' => $this->adress,
            'duration' => $this->duration,
            'category' => $this->category,
        ]);
    }
}
