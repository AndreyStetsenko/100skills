<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Statistics;
use Auth;
use App\Exports\StatisticsExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class StatisticsController extends Controller
{
  
    public function store()
    {
        $statistics = new Statistics();
        $paths = (
                    'catalog' 
                    || 'school'
                );

        if ( request()->path() == $paths ) {
            $statistics->link = request()->fullUrl();
            $statistics->slug = request()->path();
            $statistics->action = null;
            $statistics->ip = request()->ip();
            $statistics->user_id = Auth::check() ? Auth::user()->id : null;

            if (Schema::hasTable('statistics')) {
                $statistics->save();
            }
        }
    }

    public function export()
    {
        // return Excel::download(new StatisticsExport, 'stat.xlsx');
        // return Excel::download(new StatisticsExport, 'invoices.xlsx');
        // return Excel::download(new UsersExport, 'users.xls');

        // return (new UsersExport)->download('users.csv', \Maatwebsite\Excel\Excel::CSV);

        // $fileName = 'tasks.csv';
        // $tasks = Statistics::all();

        // $headers = array(
        //     "Content-type"        => "text/csv",
        //     "Content-Disposition" => "attachment; filename=$fileName",
        //     "Pragma"              => "no-cache",
        //     "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        //     "Expires"             => "0"
        // );

        // $columns = array('Link', 'Slug', 'Action', 'IP', 'User ID', 'Created At', 'Updated At');

        // $callback = function() use($tasks, $columns) {
        //     $file = fopen('php://output', 'w');
        //     fputcsv($file, $columns);

        //     foreach ($tasks as $task) {
        //         $row['Link']  = $task->link;
        //         $row['Slug']    = $task->slug;
        //         $row['Action']    = $task->action;
        //         $row['IP']  = $task->ip;
        //         $row['User ID']  = $task->user_id;
        //         $row['Created At']  = $task->created_at;
        //         $row['Updated At']  = $task->updated_at;

        //         fputcsv($file, array($row['Link'], $row['Slug'], $row['Action'], $row['IP'], $row['User ID'], $row['Created At'], $row['Updated At']));
        //     }

        //     fclose($file);
        // };

        // return response()->stream($callback, 200, $headers);

        return (new UsersExport)->download('users.csv', Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
