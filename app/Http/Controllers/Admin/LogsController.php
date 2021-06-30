<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logs;

class LogsController extends Controller
{

    public function index()
    {
        //permissions 
        typePage("manger");

        $Logs  = Logs::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        //    return $administrations ;
            return view('Admin.logs.index', compact('Logs'));
    }

}
