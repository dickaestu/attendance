
    

@extends('layouts.app')
@section('title','Dashboard')

@section('content')
<div class="alert alert-warning text-center" role="alert">
   Pastikan Anda Sudah Absen Hari Ini! <i class="mdi mdi-open-source-initiative:"></i>
  </div>
  @if (session('profile'))
  <div class="alert alert-success" role="alert">
      {{session('profile')}}
    </div>    
  @endif
  

  {{-- Today Activites & Request Time Off --}}
  <div class="container">
    <div class="row">
        {{-- Today Activites --}}
        <div class="col-md-5 mt-5 col-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                           @if (Auth::user()->user_picture == null)
                           <img  src="{{ url('frontend/images/1.png') }}" class="user-pic rounded-circle img-thumbnail">
                           @else                          
                           <img  src="{{ Storage::url(Auth::user()->user_picture) }}" class="user-pic rounded-circle img-thumbnail">
                           @endif
                        </div>
    
                        <div class="col-8 ">
                            <h4 class="mt-1">Welcome, {{ Auth::user()->name }}</h4>
                          
                            <div class="today-act">
                                <table class="table table-borderless">
                                  
                                  <tbody>
                             
                                   
                                    <tr>
                                        <th>Attendance</th><td>:</td><td>
                                         
                                          @if ($attendance->count() > 0)
                                            Done
                                          @else
                                            -
                                            @endif
                                    
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    @if (session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{session('sukses')}}
                      </div>    
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                      </div>    
                    @endif
                </div>    
            </div> 
            
                @if ($attendance->count() > 0)
                  <button type="submit" disabled class="btn btn-secondary btn-md btn-block">Done</button>
                  @else
                 
              <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-info btn-md btn-block">Click To Attendance</button>
               
                  @endif
              
         
     
        </div>

        {{-- Request Time Off --}}
     
        <div class="col-md-6 offset-md-1 mt-3 col-auto">
            <h4>Request Time Off</h4>
           <div class="card shadow-sm">
               <div class="card-body">
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
</div>

<section class="sectionDashboard mt-5">

  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 col-auto">
            <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Attendance
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                     <table class="table table-responsive text-center table-borderless">
                         <thead>
                             <tr>
                                 <th>Attendance Date</th>
                        
                                 <th>Created At</th>
                                 <th>Image</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                           @forelse ($attendanceTable as $item)
                           <tr>
                            <td>{{ $item->attendance_date }}</td>
                  
                            <td>{{ $item->created_at }}</td>
                            <td><a target="_blank" href="{{Storage::url($item->image)}}">Detail</a></td>
                            <td><a class="btn btn-info btn-sm" href="{{ route('request-attendance') }}">See More</a></td>
                        </tr>
                           @empty
                               <tr>
                                  <td colspan="5" class="text-center">Empty</td>
                               </tr>
                           @endforelse
                         </tbody>
                     </table>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Request Time Off
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-responsive text-center table-borderless">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Off Type</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse ($timeoffTable as $item)
                                <tr>
                                  <td>{{ $item->start_date }}</td>
                                  <td>{{ $item->end_date }}</td>
                                  <td>{{ $item->time_off_type }}</td>
                                  <td>{{ $item->status_request }}</td>
                                  <td>{{ $item->notes }}</td>
                                  <td><a target="_blank" href="{{Storage::url($item->file)}}">Detail</a></td>
                                  <td><a class="btn btn-info btn-sm" href="{{ route('request-time-off') }}">See More</a></td>
                              </tr>
                             @empty
                                 <tr>
                                   <td colspan="7" class="text-center">Empty</td>
                                 </tr>
                             @endforelse
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Request Overtime
                      </button>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-borderless text-center ">
                            <thead>
                                <tr>
                                    <th>Request Date</th>
                                    <th>Overtime Duration</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse ($overtimeTable as $item)
                                <tr>
                                  <td>{{ $item->request_date }}</td>
                                  <td>{{ $item->overtime_duration }}</td>
                                  <td>{{ $item->description }}</td>
                                  <td>{{ $item->status_request }}</td>
                                  <td><a class="btn btn-info btn-sm" href="{{ route('request-overtime') }}">See More</a></td>
                              </tr>
                             @empty
                                 <tr>
                                   <td colspan="5" class="text-center">Empty</td>
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
      </div>
  </div>


</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bukti Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('attendance',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="image">Upload Bukti Foto</label>
          <input required type="file" class="form-control form-control-sm" name="image" id="image">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection