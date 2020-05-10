@extends('layouts.admin')
@section('title','Request Overtime')
@section('content')

<div class="container-fluid">

    @if (session('approved'))
    <div class="alert alert-success" role="alert">
        {{session('approved')}}
      </div>    
    @endif
    
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Request Overtime</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
     
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="overtime" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Tanggal Request</th>
                <th>Nama</th>
                <th>Overtime Duration</th>
                <th>Description</th>
                <th>Status Request</th>
                <th>Approve / Reject</th>
              </tr>
            </thead>

            <tbody>
             @foreach ($items as $item)
             <tr>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d - m - Y H:i:s') }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->overtime_duration }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->status_request }}</td>
                <td>@if($item->status_request=='pending')
                    <form action="{{ route('overtime-aprroved',$item->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success mb-1"> Approve</button>
                    </form>
                    <form action="{{ route('overtime-rejected',$item->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger"> Reject</button>
                    </form>
                    @else 
                    <button disabled type="button" class="btn btn-sm btn-secondary"> Approve</button>
                    <button disabled type="button" class="btn btn-sm btn-secondary"> Reject</button>
                    @endif
                </td>
              </tr>
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
    $('#overtime').DataTable();
} );
$('#overtime').dataTable( {
   
    "order": [[0, 'desc']]

} );
</script>    

@endpush