<?php

namespace App\Http\Controllers\Client\School;

use App\Http\Controllers\Client\Catalog\TemplateClass as CourseTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\StatisticsController;

use App\Http\Requests\Panel\Course\ItemRequest as CourseRequest;
use App\Models\Course\Item as Course;
use App\Models\School\Item as School;
use App\Models\Tarif\Item as Tarif;
use App\Models\Gallery\Gallery;

class SchoolController extends Controller
{
    public function show(Request $request, $slug)
    {
        $school = School::where("slug", $slug)->first();
        $course = Course::where("school_id", $school->id)->get();

        $statistic = new StatisticsController;
        $statistic->store('school', $school->id);

        return view( "client.schoolpage.index", [
            "school" => $school,
            "course" => $course,
        ]);
    }
}
