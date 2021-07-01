@extends('layouts.admin')
@section('title','surgery Show')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">surgeries Show</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">surgeries Show
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
            <table class="table">
              <thead class="bg-success white">
                <tr>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>start Time</th>
                    <th>End Time</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $Surgery->doctor->name }}</td>
                    <td>{{ $Surgery->patient->name }}</td>

                    <td>{{ $Surgery->startTime  }}</td>
                    <td>{{ $Surgery->endTime  }}</td>
              </tbody>
            </table>
          </div>

        </div>

      </div>
    </div>
  </div>
@endsection


