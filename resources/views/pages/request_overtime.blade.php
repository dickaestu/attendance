@extends('layouts.app')
@section('title','Request Overtime')

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
            <h4>Request Overtime</h4>
            <a href="#" class="btn btn-sm btn-primary shadow mb-3 mt-4" data-toggle="modal" data-target="#exampleModal">Make Request</a>
           </div>
           <div class="col-md-8 offset-md-2 col-12">
            <form class="" action="{{ route('overtime-export') }}" method="post">
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
                      <h6 class="m-0 font-weight-bold text-dark">Data Request Overtime</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableTimeOff" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Request Date</th>
                                    <th>Overtime Duration</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($items as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::create($item->start_date)->format('d - m - Y') }}</td>
                                        <td>{{$item->overtime_duration }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->status_request }}</td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    




    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Make Request Overtime</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('create-overtime') }}">
                @csrf
                <div class="form-group">
                  <label for="request_date">Request Date</label>
                  <input required type="date" name="request_date" class="form-control form-control-sm" id="request_date">
                </div>
             
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <label for="hour">Hour</label>
                            <input required type="number" min="0" max="24" name="hour" class="form-control form-control-sm" id="hour">
                       </div>
                       
                       <div class="col-2">
                            <label for="minutes">Minutes</label>
                            <input required type="number" min="0" max="59" name="minutes" class="form-control form-control-sm" id="minutes" >
                       </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                   <textarea required class="form-control form-control-sm" name="description" id="description" cols="10" rows="2"></textarea>
                </div>
               
                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
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