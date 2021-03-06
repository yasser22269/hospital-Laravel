@extends('layouts.admin')
@section('title','surgeries index')
@section('style')
<style>
    .table th, .table td {
        padding: 0.75rem 1rem;
    }
</style>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">surgeries create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">surgeries index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Surgeries.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add surgery</button>
        </a>

      </div>
    </div>
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="card">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table id="datatable" class="table">
              <thead class="bg-success white">
                <tr>
                    <th> id</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>start Time</th>
                    <th>End Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($surgeries as $index => $surgery)


                  <tr>
                    <td>{{ ($index++)+1 }}</td>
                    <td>{{ $surgery->doctorName->name }}</td>
                    <td>{{ $surgery->patient->name }}</td>

                    <td>{{ $surgery->startTime  }}</td>
                    <td>{{ $surgery->endTime  }}</td>
                  <td>
                  <a href="{{ route('Surgeries.edit',$surgery->id) }}">
                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Edit </button>
                   </a>
                  </td>
                  <td>

                     <form class="form" method="POST" action="{{ route('Surgeries.destroy',$surgery->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  surgeries  --}}
                          <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" ><i class="la la-remove la-sm"></i> DELETE </button>

                      </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

      </div>
      {{ $surgeries->links() }}
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
