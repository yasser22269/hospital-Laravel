@extends('layouts.admin')
@section('title','patients index')
@section('style')
<style>
    .table th, .table td {
        padding: 0.75rem 1rem;
    }
</style>
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">patients create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">patients index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Patients.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add patient</button>
        </a>

      </div>
    </div>
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table class="table display nowrap table-striped table-bordered scroll-horizontal">
              <thead class="bg-success white">
                <tr>
                  <th> id</th>
                  <th>Name</th>
                  <th>gander</th>
                  <th>isIsolted</th>
                  <th>admitted</th>
                  <th>discharged</th>
                  <th>bed</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($patients as $index => $patient)


                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $patient->name  }}</td>
                 <td>{{ $patient->gender }}</td>
                 <td>{{ $patient->getIsIsolted() }}</td>
                  <td >{{ $patient->admitted  }}</td>
                  <td>{{ $patient->discharged == (null && '0000-00-00 00:00:00' )?  'NO' : $patient->discharged  }}</td>
                   <td>{{ $patient->bed->name   }}</td>
                  <td>
                  <a href="{{ route('Patients.edit',$patient->id) }}">
                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Edit </button>
                   </a>
                  </td>
                  <td>

                     <form class="form" method="POST" action="{{ route('Patients.destroy',$patient->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  patients  --}}
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
      {{ $patients->links() }}
    </div>
  </div>
@endsection

