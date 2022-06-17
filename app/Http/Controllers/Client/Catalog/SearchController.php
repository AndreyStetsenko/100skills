<?php

namespace App\Http\Controllers\Client\Catalog;

use App\Http\Controllers\Client\Catalog\TemplateClass as CourseTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course\Category as Category;
use App\Models\Course\Item as Course;
use App\Models\School\Item as School;
use App\Models\Action\Item as Action;

class SearchController extends Controller
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
        $response = $this->store($request);

        return view( "client/catalog/index", $response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * In this context method store use for: filter and return template
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $is_action = Action::where('course_id');

        # заполняем $where, $whereIn
        $whereIn = array();
        $where = array();
        $query = "?";
        $url = "";
        $queryArray = array();
        $iteration = 0;

        # условие is_visible
        $where[] = array("is_visible", "=", 1);

        # в запрос могут пройти только разрешенные параметры
        $params_allowed = array(
            "adress",
            "query",
            "limit",
            "page",
            "duration",
            "is_online",
            "is_proffession",
            "is_jobable",
            "is_certificate",
            "category_id",
            "is_recomended",
            "is_popular",
            "is_action",
        );

        $params_notallowed = array();
        foreach ( $request->all() as $key => $value ) {
            if ( !in_array($key, $params_allowed) ) {
                $params_notallowed[] = $key;
            }
        }
        if ( !empty($params_notallowed) ) {
            abort(404);
        }
        
        foreach ( $request->except(["null", "-1", "adress", "limit", "query", "page", "category"]) as $key => $value ) {
            if ( is_null($value) || $value == "null" || $value == "-1" || $key == "adress" || $key == "limit" || $key == "query" || $key == "page" ) {
                continue;
            }
            $where[] = array($key, "=", $value);

            # добавили href с параметрами
            $query .= $key . "=" . $value . "&"; 
            $url .= $key . "=" . $value . "&"; 
            $queryArray[$key] = $value;
            $iteration++;
        }

        if ( $request->input("adress") != null ){
            # поисковой запрос
            $schools = School::where( "adress", "=", $request->input("adress"))->pluck("id")->toArray();
            # $school_id = School::where( "adress", "=", $request->input("adress"))->first()->id;
            $whereIn["school_id"] = $schools;

            $schools = implode(",", $schools);
            # добавили href с параметрами
            $query .= "school_id" . "=" . $schools . "&"; 
            $url .= "adress" . "=" . $request->input("adress") . "&"; 
            $queryArray["adress"] = $request->input("adress");
        }
        if ( $request->input("query") != null ){
            # поисковой запрос
            $where[] = array("title", "like", "%{$request->input('query')}%"); 
            $queryArray["query"] = $request->input('query');  
            $url .= "query" . "=" . $request->input('query') . "&";  
        }
        if ( $request->input("limit") != null ){
            # поисковой запрос
            $queryArray["limit"] = $request->input('limit');  
            $url .= "limit" . "=" . $request->input('limit') . "&";  
        }

        # добавили limit
        $limit =  ($request->input("limit") != null && intval($request->input("limit")) != 0) ? $request->input("limit") : 15;

        # добавили offset
        $offset = $page = ($request->input("page") != null) ? intval($request->input("page")) : 1;

        # поисковой запрос
        $items_request = Course::where($where);
        if ( isset($whereIn["school_id"]) ) {
            # поисковой запрос: включая адрес школы
            $items_request->whereIn("school_id", $whereIn['school_id']);
        }
        $items_request->orderBy("sort")->limit($limit)->with(["gallery", "category", "school"]);
        $items = $items_request->get();
        $pagination = $items_request->paginate($limit);

        $templateClass = new CourseTemplate(); 
        $items_template = $templateClass->item($items);

        # формирование строки query для добавления в url
        $query = substr($query, 0, -1);

        if ( !empty($url) ) {
            $url = "?" . substr($url, 0, -1);
        }

        # формирование пагинации
        $pagination_template = $templateClass->pagination($offset, $limit, $query, $pagination);

        $response = array(
            "form" => array(
                "is_online" => $request->input("is_online"),  
                "is_proffession" => $request->input("is_proffession"),  
                "city_id" => $request->input("city_id"),  
                "duration" => $request->input("duration"),  
                "is_jobable" => $request->input("is_jobable"),  
                "is_certificate" => $request->input("is_certificate"), 
                "sql" => $items_request->toSql(),
                "where" => $where,
                "query" => $query,
                "queryArray" => $queryArray,
                "url" => $url,
            ),   
            "template" => array(
                "render" => "",
                "items" => @$items_template,
                "pagination" => @$pagination_template,
            ),   
            "pagination" => $pagination,
            "items" => $items,
            "course" => array(
                "count" => $items->count(),
            ),
        );   
        # dd(__METHOD__, $items);
        $response["template"]["render"] = view( "client/catalog/paginated", $response)->render();
        return $response;
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
        $item = Course::latest()->with(["gallery", "similar", "similar.gallery"])->where("slug", "=", $slug)->firstOrFail();
        $course = Course::where('slug', $slug)->first();

        $response = array(
            "template" => array(
                "render" => "",
            ),
            "item" => $item,
        );   
        # $response["template"]["render"] = view( "client/catalog/paginated", $response)->render();
        return view( "client/course/index", [
            'course' => $course,
        ]);    
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
     * Show the form for editing the specified resource.
     */
    public function nearme()
    {
        return view("/client/catalog/nearme");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
