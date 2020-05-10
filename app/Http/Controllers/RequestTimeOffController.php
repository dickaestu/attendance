<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\RequestTimeOff;
use App\Exports\RequestTimeOffExport;
use Maatwebsite\Excel\Facades\Excel;

class RequestTimeOffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RequestTimeOff::where('user_id',Auth::user()->id)->orderBy('created_at','asc')->get();
        return view('pages.request_time_off',[
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
            'time_off_type'=>['required','string'],
            'start_date'=>['required','date'],
            'end_date'=>['required','date'],
            'notes'=>['required','string'],
            'file'=>['required','image','mimes:jpg,png,jpeg']
        ],[
            'time_off_type.required'=> 'Time Off Type Tidak Boleh Kosong',
            'start_date.required'=> 'Start Date Tidak Boleh Kosong',
            'end_date.required'=> 'End Date Tidak Boleh Kosong',
            'notes.required'=> 'Notes Tidak Boleh Kosong',
            'file.image'=> 'Yang anda masukkan bukan gambar',
            'file.mimes'=> 'Format harus jpg/png/jpeg',
            ]);

        $data=$request->all();
        $data['user_id']= Auth::user()->id;
        $data['status_request']= 'pending';
        $data['file'] = $request->file('file')->store(
            'assets/gallery', 'public'
        );
        RequestTimeOff::create($data);

        return redirect('/request-time-off')->with('sukses','Data Berhasil Di Buat');
    }

    public function export(Request $request) 
    {
       return Excel::download(new RequestTimeOffExport, 'request_time_off.xlsx');
    }

  
}
