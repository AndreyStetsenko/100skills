<?php

namespace App\Http\Controllers\Panel\Tarif;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Panel\Tarif\ItemRequest;
use App\Http\Requests\Panel\Tarif\PageRequest;
use App\Models\Menu;
use App\Models\Page;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        # валидация входящих полей
        $validatedData = $request->validated();

        # если страница не создана ранее, нужно её создать
        $item = new Menu(
            array(
                "parent_id" => 0,
                "title" => "Тарифы",
                "slug" => "tarif",
                "is_visible" => 0,
                "is_managable" => 0,
            )
        );

        # сохранение объекта
        $result = $item->save();
        if( $result ){
            # создание страницы, привязка к пункту меню и сохранение
            $page = new Page($validatedData);

            $item->pages()->save($page);
        }
        # после создания и сохранения отношений - запросим новосозданный объект и вернем его для добавления во view
        $response = array(
            'result' => array(
                'status' => $result,
                'item' => Menu::where('id', $item->id)->with(['pages'])->first(),
            ),
        ); 
        
        return $response;

    }

    /**
     * Update special table with page info
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function update(PageRequest $request, $id)
    {
        $item = Page::where("menu_id", $id)->first();

        # валидация входящих полей
        $validatedData = $request->validated();

        # обновляем
        $result = $item->update( $validatedData );

        # после обновления
        $response = array(
            'result' => array(
                'status' => ( isset($result) ? $result : null ),
                'item' => Menu::where('id', $item->id)->with(['pages'])->first(),
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
                    'items' => Item::latest()->with(["pages"])->get(),
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
                    'items' => Item::latest()->with(["pages"])->get(),
                ),
            );
        }
        
        return $response;
    }

}
