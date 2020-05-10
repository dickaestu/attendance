<?php

namespace App\Exports;

use App\RequestOvertime;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Auth;

class OvertimeExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()

    {
        $startDate =  Carbon::create(request()->input('from'));
        $endDate   = Carbon::create(request()->input('to'))->addDays(1) ;
        
      return RequestOvertime::whereBetween('created_at',[$startDate,$endDate])->where('user_id',Auth::user()->id)->get();
       
    }

    public function map($timeOff) : array {

        return [

            $timeOff->user->name,
            $timeOff->request_date,
            $timeOff->overtime_duration,
            $timeOff->description,
            $timeOff->status_request,
            Carbon::parse($timeOff->created_at)->toFormattedDateString()

        ] ;
    }
    
    public function headings() : array {

        return [

            'Nama',

            'Tanggal Request',

            'Durasi Overtime',

            'Deskripsi',

            'Status Request',

            'Tanggal Dibuat'

        ] ;

    }
}
