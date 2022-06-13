<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class UsersExportController extends Controller
{    
    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function export(Request $request){
        // return Excel::download(new UsersExport, 'users.csv');

        // $users = User::all();

        // $delimiter = ","; 
        // $filename = "data_" . date('Y-m-d') . ".xlsx"; 
        
        // // Create a file pointer 
        // $f = fopen('php://memory', 'w'); 
        
        // // Set column headers 
        // $fields = array('NAME', 'EMAIL'); 
        // fputcsv($f, $fields, $delimiter); 
        
        // // Output each row of the data, format line as csv and write to file pointer 
        // foreach($users as $row){ 
        //     $lineData = array($row->name, $row->email); 
        //     fputcsv($f, $lineData, $delimiter); 
        // } 
        
        // // Move back to beginning of file 
        // fseek($f, 0); 
        
        // // Set headers to download file rather than displayed 
        // header('Content-Type: text/csv'); 
        // header('Content-Disposition: attachment; filename="' . $filename . '";'); 
        
        // //output all remaining data on a file pointer 
        // fpassthru($f); 

        return Excel::download(new UsersExport, 'user.csv');
    }
}
