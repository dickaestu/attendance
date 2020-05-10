<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Attendance;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class RequestAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items= Attendance::where('user_id',Auth::user()->id)->get();
        return view('pages.request_attendance',[
            'items'=>$items
        ]);
    }

    public function export(Request $request) 
    {
       return Excel::download(new AttendanceExport, 'attendance.xlsx');
    }

}
