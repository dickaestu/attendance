<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestOvertime;

class RequestOvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items= RequestOvertime::orderBy('id','desc')->withTrashed()->get();
        return view('pages.admin.request_overtime',[
            'items'=>$items
        ]);
    }

    public function approved($id)
    {
        $item= RequestOvertime::find($id);
       $item['status_request'] = 'approved';
       $item->update();

       return redirect('/admin')->with('approved','Request Berhasil Di Approve');
    }

    public function rejected($id)
    {
        $item= RequestOvertime::find($id);
       $item['status_request'] = 'reject';
       $item->update();

       return redirect('/admin')->with('reject','Request Berhasil Di Reject');
    }

 
}
