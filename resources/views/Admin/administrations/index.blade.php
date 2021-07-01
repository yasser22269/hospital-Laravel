


@extends('layouts.admin')
@section('title','Administrations index')
@section('style')
<style>
    .table th, .table td {
        padding: 0.75rem 1rem;
    }
</style>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection
@section('content')

@if (auth('admin')->user()->type_id == 'nurse')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">patient_medicines index</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Administrations index
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table id="datatable" class="table display nowrap table-striped table-bordered scroll-horizontal">
              <thead class="bg-success white">
                <tr>
                  <th> id</th>
                  <th>patient Name</th>
                  <th>doctor Name</th>
                  <th>medicine Name</th>
                  <th>Time Now</th>
                  <th>Bed Name</th>
                  <th>doseAmount</th>
                  <th>Update Now</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($patient_medicines as $index => $patient_medicine)
                <?php
                $date = $patient_medicine->updated_at;
                $carbon_date = Carbon\Carbon::parse($date);
                $carbon_date->addHours($patient_medicine->hourTime );
                ?>
                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $patient_medicine->patient->name  }}</td>
                  <td >{{ $patient_medicine->doctor->name  }}</td>
                   <td>{{ $patient_medicine->medicine->name   }}</td>
                   <td>{{  $carbon_date }}</td>
                   <td>{{ $patient_medicine->patient->bed->name   }}</td>
                   <td>{{ $patient_medicine->doseAmount   }}</td>
                  <td>

                     <form class="form" method="POST" action="{{ route('administrations.update',$patient_medicine->id) }}">
                      @csrf
                      @method('PUT')
                  {{--  patient_medicines  --}}
                          <button class="btn btn-primary btn-sm  round  box-shadow-2 px-1"type="submit" >UPDATE </button>

                      </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

      </div>
      {{ $patient_medicines->links() }}
    </div>
</div>
  @endif



  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Administrations index</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Administrations index
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
<div class="row" id="header-styling">
    <div class="col-12">
      <div class="">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table id="datatable2" class="table display nowrap table-striped table-bordered scroll-horizontal">
              <thead class="bg-success white">
                <tr>
                  <th> id</th>
                  <th>patient Name</th>
                  <th>doctor Name</th>
                  <th>medicine Name</th>
                  <th>Nurse</th>
                  <th>created At</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($administrations  as $index => $administration)


                <tr>
                  <td>{{ ($index++)+1 }}</td>
                   <td>{{ $administration->prescription->patient->name  }}</td>
                  <td >{{ $administration->prescription->doctor->name  }}</td>
                   <td>{{ $administration->prescription->medicine->name   }}</td>

                   <td>{{ $administration->userAdmin->name   }}</td>
                   <td>{{ $administration->created_at   }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

      </div>
      {{ $administrations->links() }}
    </div>
  </div>
@endsection




@section('js')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
            $('#datatable2').DataTable();
        });
       
    </script>
@endsection
