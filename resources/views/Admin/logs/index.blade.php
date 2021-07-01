@extends('layouts.admin')
@section('title','Logs index')
@section('style')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Logs create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Logs index
            </li>
          </ol>
        </div>
      </div>
    </div>

  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="card">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table id="datatable" class="table ">
              <thead class="bg-success white">
                <tr>
                  <th> id</th>
                  <th>Name</th>
                  <th>email</th>
                  <th>Title</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($Logs as $index => $Log)


                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $Log->user->name  }}</td>
                  <td>{{ $Log->user->email }}</td>
                  <td>{{ $Log->title  }}</td>
                  <td>{{ $Log->created_at  }}</td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

      </div>
      {{ $Logs->links() }}
    </div>
  </div>
@endsection



@section('js')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection
