@extends('layouts.admin')
@section('title','patient_medicines Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">patient_medicines</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('patient_medicines.index') }}">patient_medicines</a>
            </li>
            <li class="breadcrumb-item active">patient_medicines Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('patient_medicines.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">patient_medicines Info</h4>

                    <input type="hidden" name="doctor_id" value="{{ auth()->user()->id }}">

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">Medicines
                            </label>
                                   <select  class="form-control" name="medicine_id" >
                                       @foreach ($Medicines as $Medicine)
                                        <option value="{{ $Medicine->id }}">{{ $Medicine->name }}</option>
                                        @endforeach

                                </select>
                            @error("medicine_id")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">patient
                            </label>
                                   <select  class="form-control" name="patient_id" >
                                       @foreach ($Patients as $Patient)
                                        <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                                        @endforeach

                                </select>
                            @error("patient_id")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">hourTime:</label>
                          <input type="number" id="projectinput2" class="form-control" placeholder="hourTime" name="hourTime">
                        </div>
                          @error("hourTime")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">doseAmount:</label>
                          <input type="number" id="projectinput2" class="form-control" placeholder="doseAmount" name="doseAmount">
                        </div>
                          @error("doseAmount")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="projectinput2">reason:</label>
                          <textarea class="form-control" rows="10"  name="reason" ></textarea>

                        </div>
                          @error("reason")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                  </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                </div>
              </form>

              </div>
         </div>


@endsection

