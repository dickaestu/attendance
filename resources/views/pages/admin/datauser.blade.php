@extends('layouts.admin')
@section('title','Data User')
@section('content')

<div class="container-fluid">

    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>    
    @endif

    @if (session('hapus'))
    <div class="alert alert-success" role="alert">
        {{session('hapus')}}
      </div>    
    @endif
    
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Data User</h1>
    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm shadow-sm btn-primary mb-3">
        Tambah User
    </button>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
     
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="datauser" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>User Picture</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
             @foreach ($items as $item)
             <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->roles }}</td>
                <td><a href="{{ Storage::url($item->user_picture) }}" target="_blank">Lihat</a></td>
                <td><form action="{{ route('data-user.destroy',$item->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-sm shadow-sm btn-danger">
                   Hapus
                </button>
                </form></td>
              </tr>
             @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>


  
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

          
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('user-create') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input required type="text" placeholder="masukkan nama" class="form-control form-control-sm" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" placeholder="masukkan email" class="form-control form-control-sm" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" placeholder="masukkan password" class="form-control form-control-sm" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="roles">Pilih Role</label>
                    <select required class="form-control form-control-sm" name="roles" id="roles">
                  
                      <option value="karyawan">karyawan</option>
                      <option value="admin">admin</option>
                    </select>
                  </div>
             
                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
        </div>
     
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<script>
$(document).ready( function () {
    $('#datauser').DataTable();
} );
$('#datauser').dataTable( {
   
    "order": [[0, 'desc']]

} );
</script>    

@endpush