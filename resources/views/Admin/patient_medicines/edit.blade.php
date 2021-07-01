@extends('layouts.admin')
@section('title','patient_medicines  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">patient_medicines </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('patient_medicines.index') }}">patient_medicines </a>
            </li>
            <li class="breadcrumb-item active">patient medicines  Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="card-content">
    <div class="card-body">
      <ul class="nav nav-tabs nav-top-border no-hover-bg">
        <li class="nav-item">
          <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11" href="#tab11" aria-expanded="true">General</a>
        </li>


      </ul>
      <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
            <form class="form" method="POST" action="{{ route('patient_medicines.update',$PatientMedicine->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General patient_medicines Info</h4>
                  <input type="hidden"  name="id" value="{{ $PatientMedicine->id }}">
                  <input type="hidden"  name="doctor_id" value="{{ $PatientMedicine->doctor_id }}">
                  <input type="hidden"  name="patient_id" value="{{ $PatientMedicine->patient_id }}">
                  <h2>patient: {{ $PatientMedicine->patient->name }}</h2>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">patient
                            </label>
                                   <select  class="form-control" name="medicine_id" >
                                       @foreach ($Medicines as $Medicine)
                                        <option value="{{ $Medicine->id }}"   {{ ($PatientMedicine->medicine_id == $Medicine->id) ? "selected" : ''}}>{{ $Medicine->name }}</option>
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
                          <input type="number" id="projectinput2" class="form-control" placeholder="hourTime" name="hourTime" value="{{  $PatientMedicine->hourTime }}" >
                        </div>
                          @error("hourTime")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">doseAmount:</label>
                          <input type="number" id="projectinput2" class="form-control" placeholder="doseAmount" name="doseAmount" value="{{  $PatientMedicine->doseAmount }}" >
                        </div>
                          @error("doseAmount")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                      {{-- <div class="col-md-6">
                        <div class="form-group">
                          <h3 for="projectinput2">doseAmount:  {{  $PatientMedicine->doseAmount }}</h3>

                        </div>
                          @error("doseAmount")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div> --}}

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="projectinput2">reason:</label>
                          <textarea name="reason" class="form-control"   rows="15">{{  $PatientMedicine->reason }}</textarea>
                        </div>
                          @error("reason")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="projectinput1"> مفعل
                            </label>
                            <input type="checkbox"
                            id="active"
                            value="{{ $PatientMedicine->active }}"
                            {{ ($PatientMedicine->active == 1) ? "checked" : ''}}
                            name="active">
                            @error('active')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                  </div>


                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>

               </a>
                </div>
              </form>




        </div>
      </div>








        </div>


      </div>
    </div>
  </div>




         @endsection

