<?php

namespace App\Exports;

use App\Attendance;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Auth;

class AttendanceExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()

    {
        $startDate =  Carbon::create(request()->input('from'));
        $endDate   = Carbon::create(request()->input('to'))->addDays(1) ;
        
      return Attendance::whereBetween('created_at',[$startDate,$endDate])->where('user_id',Auth::user()->id)->get();
       
    }

    public function map($timeOff) : array {

        return [

            $timeOff->user->name,
            Carbon::parse($timeOff->created_at)->format('d - m - Y H:i:s'),

        ] ;
    }
    
    public function headings() : array {

        return [

            'Nama',
            'Tanggal Dibuat'

        ] ;

    }
}
