@extends('layouts.app')
@section('title','Request Attendance')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
     <ul>
         @foreach ($error->all() as $error)
             <li>{{$error}}</li>
         @endforeach
     </ul>
</div>       
@endif

@if (session('sukses'))
<div class="alert alert-success" role="alert">
    {{session('sukses')}}
  </div>    
@endif

    <div class="container-fluid mt-5 mb-3">
        <div class="row">
           <div class="col-md-8 offset-md-2 col-12">
            <h4>Request Attendance</h4>
          
           </div>
           <div class="col-md-8 offset-md-2 col-12">
            <form class="" action="{{ route('attendance-export') }}" method="post">
              @csrf
                <div class="form-group">
                  <div class="row">
                      <div class="col-auto">
                          <label for="from">From</label>
                          <input required type="date" name="from" class="form-control form-control-sm" id="from">
                     </div>
                     
                     <div class="col-auto">
                          <label for="to">To</label>
                          <input required type="date" name="to" class="form-control form-control-sm" id="to" >
                     </div>
                     
                     <div class="col-auto mt-2">
                      <button type="submit" class="btn btn-sm btn-info shadow mb-3 mt-4 ">Export</button>
                     </div>
                  </div>
              </div>
            </form>
          </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2 col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-dark">Data Request Attendance</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableTimeOff" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Attendance Date</th>
                                    <th>Created At</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse ($items as $item)
                              <tr>
                               <td>{{ $item->attendance_date }}</td>
                               <td>{{ $item->created_at }}</td>
                               <td><a target="_blank" href="{{Storage::url($item->image)}}">Detail</a></td>
                             
                           </tr>
                              @empty
                                  <tr>
                                     <td colspan="3" class="text-center">Empty</td>
                                  </tr>
                              @endforelse
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    




  
  
        

@push('addon-script')
<script>
$(document).ready( function () {
    $('#tableTimeOff').DataTable();
} );
$('#tableTimeOff').dataTable( {
    "columnDefs": [
    { "orderable": false, "targets": 0 }
  ]
} );
</script>    

@endpush
@endsection