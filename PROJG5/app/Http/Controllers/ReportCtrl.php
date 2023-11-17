<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ReportCtrl extends Controller
{
    public function listAll($id)
    {
        $report = DB::table('report')->select('UE', 'acquired')->where('numbers', $id)->get();
        return view('reportView', ['reports' => $report], ['id'=> $id]);
    }
    /*
{{ $student->links() }}  --> pour pagination
https://medium.com/justlaravel/paginated-data-with-search-functionality-in-laravel-ee0b1668b687*/

}
