<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class UsersExportController extends Controller
{    
    public function importView(Request $request)
    {
        return view('importFile');
    }

    public function import(Request $request)
    {
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function export($options = 0)
    {
        $data = [];
        $users = User::all();

        foreach ( $users as $user ) {
            $data[] = [
                'id'    => $user->id,
                'name'  => $user->name,
            ];
        }

        return response()->json( $data );
    }
}
