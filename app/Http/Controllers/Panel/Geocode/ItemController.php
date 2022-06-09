<?php

namespace App\Http\Controllers\Panel\Geocode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course\Item as Course;
use App\Models\School\Item as School;

use App\Http\Controllers\Client\Catalog\TemplateClass as CourseTemplate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #return view("panel/blog/index", $response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $response = array();
        if ( is_null($request["input"]) || empty($request["input"]) ) {
            return $response = array("error" => 1, "message" => "No input data found.");
        }
        $api = new \Yandex\Geo\Api();

        // Или можно икать по адресу
        $api->setQuery($request["input"]);

        // Настройка фильтров
        $api
            ->setToken("863d870d-eab4-48e5-b2aa-a97143ff0dc1")
            ->setLimit(10)
            ->setLang(\Yandex\Geo\Api::LANG_RU)
            ->load();

        $response = $api->getResponse();
        $response->getFoundCount(); // кол-во найденных адресов
        $response->getQuery(); // исходный запрос
        $response->getLatitude(); // широта для исходного запроса
        $response->getLongitude(); // долгота для исходного запроса

        // Список найденных точек
        $collection = $response->getList();
        $items = array();
        foreach ($collection as $key => $item) {
            $items[$key]["adress"] = $item->getAddress();
            $items[$key]["longitude"] = $item->getLatitude();
            $items[$key]["latitude"] = $item->getLongitude();
            $item->getData(); // необработанные данные
        }

        $response = array(
            'result' => array(
                'items' => $items,
            ),
        );    
        return $response;        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function point(Request $request)
    {   
        $coordinates = array();
        // $coordinates["latitude"] = "31.484903";
        // $coordinates["longitude"] = "55.197263";

        # задать координаты
        $coordinates["latitude"] = $request->input("latitude");
        $coordinates["longitude"] = $request->input("longitude");
        $coordinates["multiplication"] = 0.06;
        # создать запрос
        $where = array();
        $where["longitude"][] = array('longitude', ">=", ($coordinates["longitude"] - $coordinates["multiplication"]));
        $where["longitude"][] = array('longitude', "<=", ($coordinates["longitude"] + $coordinates["multiplication"]));
        $where["latitude"][] = array('latitude', ">=", ($coordinates["latitude"] - $coordinates["multiplication"]));
        $where["latitude"][] = array('latitude', "<=", ($coordinates["latitude"] + $coordinates["multiplication"]));
        // dd(__METHOD__, $where);

        # выполнить запрос
        $all = School::all();
        $item = School::find(4);
        $items = School::where($where["longitude"])->where($where["latitude"])->with(["course"])->get();
        $toSql = School::where($where["longitude"])->where($where["latitude"])->toSql();
        $getBindings = School::where($where["longitude"])->where($where["latitude"])->getBindings();
        // dd(__METHOD__, $items, $items->pluck("course"));
        # отделяем курсы от школ
        // $course = array();
        // foreach ( $items->pluck("course") as $key => $value ) {
        //     $course[] = $value->first();
        // }
        $whereCourse = array();
        $whereCourse[] = $items->pluck("id");
        $course = null;
        if ( count($items) != 0) {
            $course = Course::whereHas("school", function($query) use ($whereCourse){
                return $query->whereIn("id", $whereCourse);
            })->get();
        }

        $response = array(
            'result' => array(
                'status' => 1,
                'items' => $items,
                'template' => $this->template($items),
                'course' => $course,
            ),
            "items" => $course,
            "template" => array(
                "render" => "",
            ),
        ); 
        $response["template"]["render"] = view( "client/catalog/paginated", $response)->render();

        return $response;        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function coord(Request $request)
    {   
        $point = \YandexGeocoding::setPoint($request->input("longitude"), $request->input("latitude"))->load();
// setArea
// useAreaLimit
        $location = array();
        $location['point'] = $point->getResponse()->getData();

        $response = array();
        $response["Longitude"] = (isset($location['point']['Longitude']) ? $location['point']['Longitude'] : "Не указано");
        $response["Latitude"] = (isset($location['point']['Latitude']) ? $location['point']['Latitude'] : "Не указано");
        $response["AdministrativeAreaName"] = (isset($location['point']['AdministrativeAreaName']) ? $location['point']['AdministrativeAreaName'] : "Не указано");
        $response["LocalityName"] = (isset($location['point']['LocalityName']) ? $location['point']['LocalityName'] : "Не указано");

        return $response;
        
    }

    
    /**
     * Build template 
     */
    public function template($list = array())
    {
        $template = new CourseTemplate(); 
        return $template->item($list);
    }

}
