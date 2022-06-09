<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistics;
use Auth;

class StatisticsController extends Controller
{
  
    public function store()
    {
        $statistics = new Statistics();
        $paths = (
                    'catalog' 
                    || 'school'
                );

        if ( request()->path() == $paths ) {
            $statistics->link = request()->fullUrl();
            $statistics->slug = request()->path();
            $statistics->action = null;
            $statistics->ip = request()->ip();
            $statistics->user_id = Auth::check() ? Auth::user()->id : null;

            $statistics->save();
        }
    }
}
