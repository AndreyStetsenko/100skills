<?php

namespace App\Http\Controllers\Client\Account;

use App\Http\Controllers\Client\Catalog\TemplateClass as CourseTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Panel\Action\ItemRequest as ItemRequest;
use App\Models\Action\Item as Item;
use App\Models\School\Item as School;
use App\Models\Course\Item as Course;
use App\Models\Gallery\Gallery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        # необходимые данные
        # $items = Item::where("title", "like", "%{$request->input('query')}%")->get(); 
        // $response = array(
        //     "items" => (!is_null($this->items()) ? $this->items()->action : null),
        //     "school" => $this->items(),
        //     "template" => array(
        //         "paginated" => "",
        //     ),
        // );
        // // dd(__METHOD__, $response);
        // $response["template"]["paginated"] = view("/client/account/action/paginated", $response)->render();

        // return view("/client/account/action/index", $response);

        $actions = School::where("user_id", Auth::id())->first()->action;

        return view("/client/account/action/index", [
            "actions" => $actions,
        ]);
    }

    /**
     * Return model school of registered user
     *
     * @return \Illuminate\Http\Response
     */
    public function items()
    {
        $session = auth()->user()->id;
        $item = School::where("user_id", $session)->with(["action", "action.gallery"])->first();
        return $item;
    }

    /**
     * Display form for new item
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $carbon = Carbon::now();
        $school_id = School::where("user_id", auth()->user()->id)->first()->id;
        $courses = Course::where('school_id', $school_id)->get();
        
        return view("/client/account/action/create", [
            "courses" => $courses,
            "carbon" => $carbon,
        ]);
    }

    /**
     * In this context method store use for: filter and return template
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $item = new Item;
        $isItem = $item->where('course_id', '=', $request->course_id)->first();

        if ( $isItem !== null )
        {
            return redirect()->back()->with('error', 'Данный курс уже имеет акцию');
        }
     
        $item->fill($request->all());
        $item->is_visible = 1;
        $item->date_start = Carbon::createFromFormat('Y-m-d H:i:s', now())->format('Y-m-d');
        $item->date_end = Carbon::createFromFormat('Y-m-d H:i:s', now()->addDays(30))->format('Y-m-d');
        
        # добавляем школу
        $school = School::where("user_id", auth()->user()->id)->first()->id;
        $item->school_id = $school;

        $course = Course::where("id", $request->input("course_id"))->firstOrFail();
        $course->is_action = '1';

        $course->update();
        $item->save();

        return redirect()->route("actions.index");
    }
    /**
     * Display the search results
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $carbon = Carbon::now();
        $action = Item::where("id", $id)->firstOrFail();
        $school_id = School::where("user_id", auth()->user()->id)->first()->id;
        $courses = Course::where('school_id', $school_id)->get();

        
        return view("/client/account/action/show", [
            "action" => $action,
            "courses" => $courses,
            "carbon" => $carbon
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $item = Item::where("id", $id)->firstOrFail();
        
        $item->new_price = $request->input("new_price");
        $item->update();        

        # после обновления
        // $response = array(
        //     'result' => array(
        //         'status' => $result,
        //         'item' => Item::with(["category", "gallery"])->find($id),
        //     ),
        //     'success' => array(
        //         "Информация сохранена."
        //     ),
        // );
        return redirect()->route('actions.view', $id);

    }
    /**
     * Update visible cell
     */
    public function visible(Request $request)
    {
        $log = array();
        foreach ( $request->input('id') as $key => $value) {
            # поиск обновляемой записи
            $item = Item::find($value);
            if ( is_null($item) ) {
                continue;
            }
            $item->is_visible = ($request->input('is_visible') === true) ? 1 : null;

            # update
            $log[] = $item->save();
        }
        
        # после обновления
        $response = array(
            'result' => array(
                'status' => (!in_array(false, $log)),
            ),
            "template" => array(
                "paginated" => "",
            ),
            "items" => $this->items()->action,
            "school" => $this->items(),
            'success' => array(
                "Информация сохранена."
            ),
        );
        $response["template"]["paginated"] = view("/client/account/action/paginated", $response)->render();
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        # массовое удаление
        $result = array();
        $action = Item::whereIn('id', $request->input('id') )->get();
        foreach ( $action as $key => $value ) {
            $result[] = $value->delete();
        }
        $response = array(
            'result' => array(
                'status' => !in_array(!1, $result),
            ),
            "template" => array(
                "paginated" => "",
            ),
            "items" => $this->items()->action,
            "school" => $this->items(),
            'success' => array(
                "Информация сохранена."
            ),
        );
        $response["template"]["paginated"] = view("/client/account/action/paginated", $response)->render();
        return $response;
    }

    public function getCourse($id)
    {
        return response()->json(Course::where('id', $id)->get());
    }
}
