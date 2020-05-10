@extends('layouts.app')
@section('title','Profile')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
     </ul>
</div>       
@endif



  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 mt-5 col-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            @if (Auth::user()->user_picture == null)
                            <img  src="{{ url('frontend/images/1.png') }}" class="user-pic rounded-circle img-thumbnail">
                            @else                          
                            <img  src="{{ Storage::url(Auth::user()->user_picture) }}" class="user-pic rounded-circle img-thumbnail">
                            @endif

                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-link">Ubah Profile</button>
                        </div>   
                    </div>
        <form action="{{ route('update-profile',$item->id) }}" method="post">
            @csrf
                    <div class="row mt-3">
                        <div class="col d-flex justify-content-center">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input  type="text" name="name" value="{{ $item->name }}" class="form-control" id="name">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col d-flex justify-content-center">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input  type="email" name="email" value="{{ $item->email }}" class="form-control" id="email">
                            </div>
                        </div>
                    </div>

                

                    <div class="row mt-3 justify-content-center">
                        <div class="col-auto">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Reset Password') }}
                            </a>
                        @endif
                        </div>

                        <div class="col-auto">
                        
                            <button type="submit" class="btn btn-sm btn-warning text-white">UPDATE</button>
                        
                        </div>
                    </div>
                </form>
                </div>    
            </div> 
            
              
              
         
     
        </div>
      </div>
  </div>

    


  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Your Profile Picture</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('update-picture',$item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_picture">Upload</label>
                <input type="file" name="user_picture" class="form-control" id="user_picture">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning text-white">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  
  
        

@endsection