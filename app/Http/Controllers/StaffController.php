<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StaffController extends Controller
{
    //
    public function index() {
        $ar_staff = DB::table('staff')->get();
        //$ar_staff = Staff::all();
        return view('admin.staff.index', compact('ar_staff'));
    }
}
