<?php

namespace App\Exports;

use App\RequestTimeOff;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Auth;

class RequestTimeOffExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()

    {
        $startDate =  Carbon::create(request()->input('from'));
        $endDate   = Carbon::create(request()->input('to'))->addDays(1) ;
        
      return RequestTimeOff::whereBetween('created_at',[$startDate,$endDate])->where('user_id',Auth::user()->id)->get();
       
    }

    public function map($timeOff) : array {

        return [

            $timeOff->user->name,
            $timeOff->start_date,
            $timeOff->end_date,
            $timeOff->notes,
            $timeOff->status_request,
            Carbon::parse($timeOff->created_at)->toFormattedDateString()

        ] ;
    }
    
    public function headings() : array {

        return [

            'Nama',

            'Start Date',

            'End Date',

            'Notes',

            'Status Request',

            'Tanggal Dibuat'

        ] ;

    }

}
