<?php

namespace App\Http\Controllers\Client\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Course\Item as Course;

class ActionController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_action', 1)->get();

        return redirect('catalog?is_action=1');
    }
}
