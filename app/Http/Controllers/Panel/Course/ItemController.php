<?php

namespace App\Http\Controllers\Panel\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Panel\Course\ItemRequest;
use App\Models\Course\Item;
use App\Models\Course\Category;
use App\Models\Gallery\Gallery;
use App\Models\School\Item as School;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = array();
        $response['items'] = Item::latest()->with(["category", "gallery"])->get();
        $response['category'] = Category::latest()->where('parent_id', 0)->with(['childs'])->get();
        $response['school'] = School::latest()->with(["course"])->get();
        return view("panel/courses/index", $response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {   

        # валидация входящих полей
        $validatedData = $request->validated();

        # создание объекта с данными
        $item = new Item($validatedData);        


        # выставляем видимость по-умолчанию
        $item->is_visible = 1;
        
        # сохранение объекта
        $result = $item->save();

        # в лекции есть галерея:
        if ( $request->input('gallery') != null ) {
            # добавляем к $item ссылку на gallery && сохраняем relation gallery
            foreach ( $request->input("gallery") as $key => $value ) {
                if( !isset($value['id']) ){
                    # в базе нет (id в запросе отсутствует) - добавляем фото
                    $gallery_item = new Gallery($value);
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

        # после создания и сохранения отношений - запросим новосозданный объект и вернем его для добавления во view
        $response = array(
            'result' => array(
                'status' => $result,
                'item' => Item::where('id', $item->id)->with(["category", "gallery"])->get(),
                'items' => Item::latest()->with(["category", "gallery"])->get(),
            ),
        );    
        return $response;
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

        # валидация входящих полей
        $validatedData = $request->validated();

        # поиск обновляемой записи
        $item = $item_original = Item::findOrFail($id);

        # в лекции есть галерея:
        if ( $request->input('gallery') != null ) {
            # добавляем к $item ссылку на gallery && сохраняем relation gallery
            foreach ( $request->input("gallery") as $key => $value ) {
                if( !isset($value['id']) ){
                    # в базе нет (id в запросе отсутствует) - добавляем фото
                    $gallery_item = new Gallery($value);
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

        # сохраним slug
        $item->slug = $request->input('slug');

        # обновим чекбоксы
        $item->is_visible = $request->input("is_visible");
        $item->is_popular = $request->input("is_popular");
        $item->is_online = $request->input("is_online");
       
        # обновим основную запись
        $result = $item->update($validatedData);
        // dd(__METHOD__, $result, $validatedData, $item, $item_original);

        # после обновления
        $response = array(
            'result' => array(
                'status' => $result,
                'items' => Item::latest()->with(["category", "gallery"])->get(),
            ),
        );
        return $response;
    }
    /**
     * Remove gallery to course manyToMany relation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gallery(Request $request)
    {
        # валидация входящих полей
        // $validatedData = $request->validated();

        # поиск обновляемой записи
        $item = Item::findOrFail( $request->input("item_id") );

        # удаляем привязку
        $result = $item->gallery()->detach($request->input("gallery_id"));

        # после обновления
        $response = array(
            'result' => array(
                'status' => ( isset($result) ? $result : null ),
                'items' => Item::latest()->with(["category", "gallery"])->get(),
            ),
        );

        return $response;
    }

    /**
     * Update sort of items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        $items = $request->all();
        foreach ($items as $key => $value) {
            $items[$key]['sort'] = $key;
            # найдем в БД выбранный элемент меню
            $item = Item::where('id', $items[$key]['id'])->first();
            $item['sort'] = $items[$key]['sort'];
            $item->save();
        }
        $response = array(
            'result' => array(
                'status' => 1,
                'itemList' => Item::latest()->with(["category", "gallery"])->get(),
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
    public function destroy(Request $request, $id)
    {

        if( is_null($request->input('ids')) ){
            $result = Item::find($id)->delete();
            $response = array(
                'result' => array(
                    'status' => $result,
                    'items' => Item::latest()->with(["category", "gallery"])->get(),
                ),
            );
        }else{
            # массовое удаление
            $result = array();
            foreach ( Item::whereIn('id', json_decode($request->input('ids'), 1) )->get() as $key => $value ) {
                $result[] = $value->delete();
            }
            $response = array(
                'result' => array(
                    'status' => !in_array(!1, $result),
                    'items' => Item::latest()->with(["category", "gallery"])->get(),
                ),
            );
        }
        
        return $response;
    }

}
