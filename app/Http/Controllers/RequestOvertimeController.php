<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestOvertime;
use Auth;
use App\Exports\OvertimeExport;
use Maatwebsite\Excel\Facades\Excel;

class RequestOvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RequestOvertime::where('user_id',Auth::user()->id)->orderBy('created_at','asc')->get();
        return view('pages.request_overtime',[
            'items'=>$items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'request_date'=>['required','date'],
            'hour'=>['required','string'],
            'minutes'=>['required','string'],
            'description'=>['required','string'],
        ],[
            'request_date.required'=> 'Request Date Tidak Boleh Kosong',
            'hour.required'=> 'Hour Tidak Boleh Kosong',
            'minutes.required'=> 'Minutes Tidak Boleh Kosong',
            'description.required'=> 'Description Tidak Boleh Kosong',
            ]);

        $data=$request->all();
        $data['user_id']= Auth::user()->id;
        $data['status_request']= 'pending';
        $data['overtime_duration'] = $request->hour.'Hour '.$request->minutes.'Minutes';
        RequestOvertime::create($data);

        return redirect('/request-overtime')->with('sukses','Data Berhasil Di Buat');
    }

    public function export(Request $request) 
    {
       return Excel::download(new OvertimeExport, 'request_overtime.xlsx');
    }
}
