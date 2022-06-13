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
        $response = array(
            "items" => (!is_null($this->items()) ? $this->items()->action : null),
            "school" => $this->items(),
            "template" => array(
                "paginated" => "",
            ),
        );
        // dd(__METHOD__, $response);
        $response["template"]["paginated"] = view("/client/account/action/paginated", $response)->render();

        return view("/client/account/action/index", $response);
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
        $school_id = School::where("user_id", auth()->user()->id)->first()->id;
        $courses = Course::where('school_id', $school_id)->get();
        return view("/client/account/action/create", [
            "courses" => $courses
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
        $item->fill($request->all());
        $item->is_visible = 1;
        $item->save();

        return redirect()->route("actions.index");

        // # валидация входящих полей
        // $validatedData = $request->validated();

        // # создание объекта с данными
        // $item = new Item($validatedData);        

        // # выставляем видимость по-умолчанию
        // $item->is_visible = 1;

        // # сохранение объекта
        // $result = $item->save();
        
        // # привяжем школу
        // $school = School::where("user_id", auth()->user()->id)->first();
        // $school->action()->attach($item->id);
        // # $item->school_id = $school;
        

        // # в лекции есть галерея:
        // if ( $request->input('gallery') != null ) {
        //     $gallery = $request->input("gallery");
        //     # добавляем к $item ссылку на gallery && сохраняем relation gallery
        //     if ( gettype($request->input("gallery")) === "string" ) {
        //         $gallery = json_decode($request->input("gallery"), 1);
        //     }
        //     foreach ( $gallery as $key => $value ) {
        //         if( !isset($value['id']) ){
        //             # в базе нет (id в запросе отсутствует) - добавляем фото
        //             $gallery_item = new Gallery($value);
        //             $gallery_item["src"] = ($gallery_item["src"] == null) ? ("/public" . $value["path"]) : $gallery_item["src"]; 

        //             $gallery_item->save();
        //             $item->gallery()->save($gallery_item);
        //             # $item->gallery()->attach($gallery_item);
                    
        //         }else{
        //             # уже в базе
        //         }
        //     }

        //     # обновим привязку
        //     $item->is_active_gallery = 1;
        //     $item->save();

        // }

        // $response = array(
        //     "messages" => "Новая акция добавлена.",
        //     "form" => array(
        //         "h1" => "Создание акции",
        //         "id" => "",
        //         "title" => $item->title,
        //         "city" => "",
        //         "duration" => "",
        //         "price" => "",
        //         "link" => "",
        //         "body_short" => $item['body_short'],
        //         "body_long" => "",
        //         "body_goals" => "",
        //         "body_course" => "",
        //         "body_course" => "",
        //         "gallery" => "",
        //         "gallery_src" => "",
        //         "new_price" => "",
        //         "course_id" => "",
        //         "date_start" => "",
        //         "date_end" => "",
        //     ),
        //     "template" => array(
        //         "button" => "Создать",
        //     ),
        // ); 
        // return view("/client/account/course/create", $response);
    }
    /**
     * Display the search results
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {

        $item = Item::where("slug", $slug)->with(["gallery"])->first();

        $response = array(
            "form" => array(
                "h1" => "",
                "id" => $item["id"],
                "title" => $item["title"],
                "city" => $item["city"],
                "duration" => $item["duration"],
                "price" => $item["price"],
                "link" => $item["link"],
                "body_short" => $item["body_short"],
                "body_long" => $item["body_long"],
                "body_goals" => $item["body_goals"],
                "body_course" => $item["body_course"],
                "body_course" => $item["body_course"],
                "gallery" => $item["gallery"]->last(),
                "gallery_src" => @$item["gallery"]->last()->src,
                "new_price" => $item["new_price"],
                "course_id" => $item["course_id"],
                "date_start" => $item["date_start"],
                "date_end" => $item["date_end"],
            ),
            "template" => array(
                "button" => "Сохранить",
            ),
        );
        return view("/client/account/action/show", $response);
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
        if ( auth()->user()->id == null ) {
            return;
        }
        $validatedData = $request->validated();
        $school = School::where("user_id", auth()->user()->id)->first();
        $validatedData["author"] = $author = $school->title;
        $validatedData["school_id"] = $school_id = $school->id;
        $validatedData["is_visible"] = 1;
        $validatedData["sort"] = Item::count() + 1;


        # поиск обновляемой записи
        $item = $item_original = Item::findOrFail($id);

        # в лекции есть галерея:
        if ( $request->input('gallery') != null ) {
            $gallery = $request->input("gallery");
            # добавляем к $item ссылку на gallery && сохраняем relation gallery
            if ( gettype($request->input("gallery")) === "string" ) {
                $gallery = json_decode($request->input("gallery"), 1);
            }
            foreach ( $gallery as $key => $value ) {
                if( !isset($value['id']) ){
                    # в базе нет (id в запросе отсутствует) - добавляем фото
                    $gallery_item = new Gallery($value);
                    
                    $gallery_item["src"] = ($gallery_item["src"] == null) ? ("/public" . $value["path"]) : $gallery_item["src"]; 

                    # сохраняем
                    $item->gallery()->save($gallery_item);
                }else{
                    # уже в базе
                }
            }

            # обновим привязку
            $item->is_active_gallery = 1;
            $item->save();
        }

        $result = $item->update($validatedData);

        # после обновления
        $response = array(
            'result' => array(
                'status' => $result,
                'item' => Item::with(["category", "gallery"])->find($id),
            ),
            'success' => array(
                "Информация сохранена."
            ),
        );
        return $response;

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
