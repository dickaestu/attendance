@extends('layouts.admin')
@section('title','Attendance')
@section('content')

<div class="container-fluid">

    @if (session('approved'))
    <div class="alert alert-success" role="alert">
        {{session('approved')}}
      </div>    
    @endif
    
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Attendance</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
     
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="attendance" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Tanggal Absen</th>
                <th>Nama</th>
                <th>Bukti Foto</th>
              </tr>
            </thead>

            <tbody>
             @foreach ($items as $item)
             <tr>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d - m - Y H:i:s') }}</td>
                <td>{{ $item->user->name }}</td>
                <td><a href="{{ Storage::url($item->image) }}" target="_blank">Lihat Bukti</a></td>
                @endforeach 
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('addon-script')
<script>
$(document).ready( function () {
    $('#attendance').DataTable();
} );
$('#attendance').dataTable( {
   
   "order": [[0, 'desc']]

} );
</script>    

@endpush