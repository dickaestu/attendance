<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestTimeOff;

class RequestTimeOffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items= RequestTimeOff::with('user')->withTrashed()->get();
        return view('pages.admin.request_timeoff',[
            'items'=>$items
        ]);
    }

    public function approved($id)
    {
        $item= RequestTimeOff::find($id);
       $item['status_request'] = 'approved';
       $item->update();

       return redirect('/admin/request-timeoff')->with('approved','Request Berhasil Di Approve');
    }

    public function rejected($id)
    {
        $item= RequestTimeOff::find($id);
       $item['status_request'] = 'reject';
       $item->update();

       return redirect('/admin/request-timeoff')->with('reject','Request Berhasil Di Reject');
    }
}
