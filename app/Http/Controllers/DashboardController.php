<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestTimeOff;
use App\Attendance;
use Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $date = Carbon::now()->format('Y-m-d');
        $items = RequestTimeOff::where('user_id',Auth::user()->id)->get();
        $attendance = Attendance::whereDate('attendance_date',$date)->where('user_id',Auth::user()->id)->get();
        $attendanceTable = DB::table('attendance')->take(5)
        ->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        $timeoffTable = DB::table('request_time_off')->take(5)
        ->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        $overtimeTable = DB::table('request_overtime')->take(5)
        ->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('pages.dashboard',[
            'items'=>$items,
            'attendance'=>$attendance,
            'attendanceTable'=>$attendanceTable,
            'timeoffTable'=>$timeoffTable,
            'overtimeTable'=>$overtimeTable
       
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAttendance(Request $request, $id)
    {
        $request->validate([
            'image'=>['required','image','mimes:jpg,png,jpeg']
        ],[
            'image.mimes'=> 'Format yang anda masukkan salah',
            ]);

        $now = Carbon::now()->format('H:i:s');
        $cek = $now;
        $data['user_id'] = $id;
        $data['image'] = $request->file('image')->store(
            'assets/gallery', 'public'
        );
        $data['attendance_date'] = Carbon::now()->format('Y-m-d');

        if (($cek >= '00:00' && $cek <='07:59')||($cek >= '17:00' && $cek <= '24:00')) {
            return redirect('/')->with(['error'=> 'Saat Ini Belum Bisa Melakukan Absen']);
        }
        else {
            Attendance::create($data); 
            return redirect('/')->with(['sukses'=> 'Berhasil Absen']);
        }

        // if (($cek >= '0' && $cek <='8')||($cek >= '17' && $cek <= '24')) {
        //     return redirect('/')->with(['error'=> 'Saat Ini Belum Bisa Melakukan Absen']);
        // }
        // else {
        //     Attendance::create($data); 
        //     return redirect('/')->with(['sukses'=> 'Berhasil Absen']);
        // }
        
        
      
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $item = User::findOrFail($id);
        return view('pages.profile',[
            'item'=>$item
        ]);
    }

    public function updateprofile(Request $request,$id)
    {
        $request->validate([
            'name'=>['string','max:255'],
            'email'=>['email']
        ]);

        $data = $request->all();
        $item = User::findOrFail($id);

        $item ->update($data);
        return redirect('/')->with('profile','Profile Berhasil Di Update');
    }

    public function updateProfilePicture(Request $request,$id)
    {
        $request->validate([
            'user_picture'=>['image','mimes:jpg,png,jpeg']
        ],[
            'user_picture.mimes'=> 'Format gambar yang anda masukkan salah',
            ]);

        $data = $request->all();
        $data['user_picture']= $request->file('user_picture')->store(
            'assets/gallery', 'public'
        );
        $item = User::findOrFail($id);

        $item ->update($data);
        return redirect('/')->with('profile','Profile Berhasil Di Update');
    }
}
