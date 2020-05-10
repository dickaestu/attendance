@extends('layouts.app')
@section('title','Request Time Off')

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
            <h4>Request Time Off</h4>
            <a href="#" class="btn btn-sm btn-primary shadow mb-3 mt-4" data-toggle="modal" data-target="#exampleModal">Make Request</a>
          </div>
          <div class="col-md-8 offset-md-2 col-12">
            <form class="" action="{{ route('time-off-export') }}" method="post">
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
                      <h6 class="m-0 font-weight-bold text-dark">Data Request Time Off</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableTimeOff" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Off Type</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($items as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::create($item->start_date)->format('d - m - Y') }}</td>
                                        <td>{{ \Carbon\Carbon::create($item->end_date)->format('d - m - Y') }}</td>
                                        <td>{{ $item->time_off_type }}</td>
                                        <td>{{ $item->notes }}</td>
                                        <td>{{ $item->status_request }}</td>
                                        <td><a href="{{ Storage::url($item->file) }}" target="_blank">Detail</a></td>
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
          <h5 class="modal-title" id="exampleModalLabel">Make Request Time Off</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

          
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('create-time-off') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="time_off_type">Time Off Type</label>
                    <select required class="form-control form-control-sm" name="time_off_type" id="time_off_type">
                  
                      <option value="sick leave doctor notes">sick leave doctor notes</option>
                      <option value="entertaint">entertaint</option>
                      <option value="working from home">working from home</option>
                      <option value="cuti menikah">cuti menikah</option>
                    </select>
                  </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-auto">
                            <label for="start_date">Start Date</label>
                            <input required type="date" name="start_date" class="form-control form-control-sm" id="start_date">
                       </div>
                       
                       <div class="col-auto">
                            <label for="end_date">End Date</label>
                            <input required type="date" name="end_date" class="form-control form-control-sm" id="end_date" >
                       </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                   <textarea required class="form-control form-control-sm" name="notes" id="notes" cols="10" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="file">Upload File</label>
                    <input required type="file" class="form-control form-control-sm" name="file" id="file">
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
 
     "ordering": false
  
} );
</script>    

@endpush
@endsection