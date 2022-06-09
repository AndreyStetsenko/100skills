<?php

namespace App\Http\Controllers\Client\Account;

use App\Http\Controllers\Client\Catalog\TemplateClass as CourseTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Panel\Course\ItemRequest as CourseRequest;
use App\Models\Course\Item as Course;
use App\Models\Course\Category as Category;
use App\Models\School\Item as School;
use App\Models\Gallery\Gallery;

class CourseController extends Controller
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
        # $items = Course::where("title", "like", "%{$request->input('query')}%")->get(); 
        $response = array(
            "items" =>  (!is_null($this->school()) ? $this->school()->course : null),
            "school" => $this->school(),
            "template" => array(
                "paginated" => "",
            ),
        );
        # dd(__METHOD__, $response);
        $response["template"]["paginated"] = view("/client/account/course/paginated", $response)->render();

        return view("/client/account/courses", $response);
    }

    /**
     * Return model school of registered user
     *
     * @return \Illuminate\Http\Response
     */
    public function school()
    {
        $session = auth()->user()->id;
        $school = School::where("user_id", $session)->with(["course"])->first();
        return $school;
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

        $response = array(
            "form" => array(
                "h1" => "Создание курса",
                "id" => "",
                "title" => "",
                "city" => "",
                "duration" => "",
                "price" => "",
                "link" => "",
                "body_short" => "",
                "body_long" => "",
                "body_goals" => "",
                "body_course" => "",
                "body_course" => "",
                "gallery" => "",
            ),
            "items" => array(
                "category" => Category::latest()->where('parent_id', 0)->with(['childs'])->get(),
            ),
            "template" => array(
                "button" => "Создать",
            ),
        );

        return view("/client/account/course/create", $response);
    }

    /**
     * In this context method store use for: filter and return template
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {

        # валидация входящих полей
        $validatedData = $request->validated();
        

        # создание объекта с данными
        $item = new Course($validatedData);        
        
        # работа с чекбоксами
        $item["is_jobable"] = (isset($validatedData["is_jobable"])) ? 1 : null;

        $item["is_certificate"] = (isset($validatedData["is_certificate"])) ? 1 : null;
        $item["is_online"] = (isset($validatedData["is_online"])) ? 1 : null;
        
        # radio профессия/онлайн
        $item["is_proffession"] = (isset($validatedData["is_proffession"]) && $validatedData["is_proffession"] == 1) ? 1 : null;
        # выставляем видимость по-умолчанию
        $item->is_visible = 1;

        # добавляем школу
        $school = School::where("user_id", auth()->user()->id)->first()->id;
        $item->school_id = $school;
        
        # сохранение объекта
        $result = $item->save();

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
                    $gallery_item["src"] = "/public" . $value["path"];
                    $gallery_item->save();
                    $item->gallery()->save($gallery_item);
                    # $item->gallery()->attach($gallery_item);
                    
                }else{
                    # уже в базе
                }
            }

            # обновим привязку
            $item->is_active_gallery = 1;
            $item->save();

        }

        $response = array(
            "messages" => "Новый курс добавлен.",
            "form" => array(
                "h1" => "Создание курса",
                "id" => "",
                "title" => "",
                "city" => "",
                "duration" => "",
                "price" => "",
                "link" => "",
                "body_short" => "",
                "body_long" => "",
                "body_goals" => "",
                "body_course" => "",
                "body_course" => "",
                "is_jobable" => "",
                "is_certificate" => "",
                "is_online" => "",
                "is_proffession" => "",
                "gallery" => "",
            ),
            "template" => array(
                "button" => "Создать",
            ),
        ); 
        return view("/client/account/course/create", $response);
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
        $item = Course::where("slug", $slug)->with(["gallery", "similar", "category"])->firstOrFail();

        $response = array(
            "form" => array(
                "h1" => "Редактирование курса",
                "id" => $item["id"],
                "title" => $item["title"],
                "category_id" => $item["category_id"],
                "duration" => $item["duration"],
                "price" => $item["price"],
                "link" => $item["link"],
                "body_short" => $item["body_short"],
                "body_long" => $item["body_long"],
                "body_goals" => $item["body_goals"],
                "is_jobable" => $item["is_jobable"],
                "is_certificate" => $item["is_certificate"],
                "is_online" => $item["is_online"],
                "is_proffession" => $item["is_proffession"],
                "body_course" => $item["body_course"],
                "body_course" => $item["body_course"],
                "gallery" => $item["gallery"]->last(),
                "gallery_src" => @$item["gallery"]->last()->src,
                "course" => $item["similar"]->toArray(),
            ),
            "template" => array(
                "button" => "Сохранить",
            ),
            "items" => array(
                "category" => Category::latest()->where('parent_id', 0)->with(['childs'])->get(),
            ),
            "raw" => array(
                "item" => $item,
            ),
        );
        // dd(__METHOD__, $response);
        return view("/client/account/course/show", $response);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        if ( auth()->user()->id == null ) {
            return;
        }
        $validatedData = $request->validated();

        $school = School::where("user_id", auth()->user()->id)->first();

        # поиск обновляемой записи
        $item = $item_original = Course::findOrFail($id);

        $validatedData["author"] = $author = $school->title;
        $validatedData["school_id"] = $school_id = $school->id;
        $validatedData["is_visible"] = 1;
        $validatedData["sort"] = Course::count() + 1;

        # работа с чекбоксами
        $item["is_jobable"] = (isset($validatedData["is_jobable"])) ? 1 : null;

        $item["is_certificate"] = (isset($validatedData["is_certificate"])) ? 1 : null;
        $item["is_online"] = (isset($validatedData["is_online"])) ? 1 : null;
        
        # radio профессия/онлайн
        $item["is_proffession"] = (isset($validatedData["is_proffession"]) && $validatedData["is_proffession"] == 1) ? 1 : null;


        # в лекции есть галерея:

        if ( $request->input('gallery') != null && array_filter($request->input('gallery')) != null ) {
            $gallery = $request->input("gallery");
            # добавляем к $item ссылку на gallery && сохраняем relation gallery
            if ( gettype($request->input("gallery")) === "string" ) {
                $gallery = json_decode($request->input("gallery"), 1);
            }
            foreach ( array($gallery) as $key => $value ) {
                // dd(__METHOD__, $gallery);
                if( !isset($value['id']) ){
                    # в базе нет (id в запросе отсутствует) - добавляем фото
                    $gallery_item = new Gallery($value);
                    $gallery_item->src = "/public" . $value["path"];

                    // dd(__METHOD__, $gallery_item);

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
        # найдены похожие курсы:
        if ( $request->input('course') != null ) {
            $similar = $request->input("course");
            # добавляем к $item ссылку на gallery && сохраняем relation gallery
            if ( gettype($similar) === "string" ) {
                $similar = json_decode($similar, 1);
            }
            $item->similar()->detach();
            foreach ( $similar as $key => $value ) {
                    # в базе нет (id в запросе отсутствует) - добавляем фото
                    if ( is_null($value) ) {
                        continue;
                    }
                    $course_item = Course::find($value);

                    # сохраняем
                    $item->similar()->attach($course_item->id);
            }

            # обновим привязку
            # $item->save();
        }

        $result = $item->update($validatedData);

        # после обновления
        $response = array(
            'result' => array(
                'status' => $result,
                'item' => Course::where("id", $id)->with(["category", "similar", "gallery"])->get(),
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
            $item = Course::find($value);
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
            "items" => $this->school()->course,
            "school" => $this->school(),
            'success' => array(
                "Информация сохранена."
            ),
        );
        $response["template"]["paginated"] = view("/client/account/course/paginated", $response)->render();
        return $response;
    }

    public function visibleTrue(Request $request) {
        $log = array();
        foreach ( $request->input('id') as $key => $value) {
            # поиск обновляемой записи
            $item = Course::find($value);
            if ( is_null($item) ) {
                continue;
            }
            $item->is_visible = ($request->input('is_visible') === true) ? null : 1;

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
            "items" => $this->school()->course,
            "school" => $this->school(),
            'success' => array(
                "Информация сохранена."
            ),
        );
        $response["template"]["paginated"] = view("/client/account/course/paginated", $response)->render();
        return $response;
    }

    /**
     * Define similar relations
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $where = array();
        $items = Course::where("title", "LIKE", "%{$request["input"]}%");
        $response = array(
            'result' => array(
                'status' => $items->count(),
                "items" => $items->limit(6)->get(),
            ),
        );
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
        $course = Course::whereIn('id', $request->input('id') )->get();
        foreach ( $course as $key => $value ) {
            $result[] = $value->delete();
        }
        $response = array(
            'result' => array(
                'status' => !in_array(!1, $result),
            ),
            "template" => array(
                "paginated" => "",
            ),
            "items" => $this->school()->course,
            "school" => $this->school(),
            'success' => array(
                "Информация сохранена."
            ),
        );
        $response["template"]["paginated"] = view("/client/account/course/paginated", $response)->render();
        return $response;
    }
}
