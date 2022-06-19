<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Statistics;
use Illuminate\Support\Facades\Auth;
use App\Exports\StatisticsExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\Course\Item as Course;

class StatisticsController extends Controller
{
    /**
     * Добавление записи статистики
     */
    public function store($page_type, $page_id)
    {
        $statistics = new Statistics();
        $paths = ('catalog' || 'school');

        if ( request()->path() == $paths ) {
            if ( $page_type == 'school' ) {
                $statistics->action = 'open_page';
                $statistics->school_id = $page_id;
            }

            if ( $page_type == 'course' ) {
                $statistics->action = 'open_page_course';
                $statistics->course_id = $page_id;
                $statistics->school_id = Course::where('id', $page_id)->first()->school_id;
            }

            $statistics->ip = request()->ip();
            $statistics->user_id = null;

            if (Schema::hasTable('statistics')) {
                $statistics->save();
            }
        }
    }

    /**
     * Добавление записи статистики через ajax запрос
     */
    public function storeAction(Request $request)
    {
        $statistics = new Statistics();
        
        $statistics->action = $request->body['type'];

        if ( $request->body['type_page'] == 'school' ) {
            $statistics->school_id = $request->body['page_id'];
        }

        if ( $request->body['type_page'] == 'course' ) {
            $statistics->course_id = $request->body['page_id'];
        }

        $statistics->ip = request()->ip();
        $statistics->user_id = null;

        if (Schema::hasTable('statistics')) {
            $statistics->save();

            $response = [
                'status' => '200',
                'data' => $request->body
            ];
    
            return response()->json( $response );
        }
    }

    /**
     * Очистка всей статистики сайта
     */
    public function allclear() {
        Statistics::getQuery()->delete();

        $response = [
            'status' => '200'
        ];

        return response()->json( $response );
    }

    /**
     * Экспорт статистики
     */
    public function export(Request $request)
    {
        $data = null;
        $req = $request->body;

        $date_start = date('d-m-Y', strtotime($req['date_start'])) ." 00:00:00";
        $date_end = date('d-m-Y', strtotime($req['date_end'])) ." 23:59:59";

        $statistics = Statistics::whereRaw(
            "(created_at >= ? AND created_at <= ? and school_id = " . $req['school_id'] . ")", 
            [
                $date_start, 
                $date_end
            ]
          )->get();

        // foreach ( $statistics as $item ) {
        //     $data[] = [
        //         'id'            => $item->id,
        //         'action'        => $item->action,
        //         'school_id'     => $item->school_id,
        //         'course_id'     => $item->course_id,
        //         'ip'            => $item->ip,
        //         'user_id'       => $item->user_id,
        //         'created_at'    => $item->created_at,
        //         'updated_at'    => $item->updated_at,
        //     ];
        // }

        $data[] = [
            'Opening school pages' => count($statistics->where('action', 'open_page')),
            'Course openings' => count($statistics->where('action', 'open_page_course')),
            'Opening contacts' => count($statistics->where('action', 'open_contacts')),
            'Links to the school website' => count($statistics->where('action', 'move_to_school_site')),
            'Date From' => $req['date_start'],
            'Date To' => $req['date_end']
        ];

        $response = [
            'status' => '200',
            'data' => $data
        ];

        return response()->json( $response );
    }
}
