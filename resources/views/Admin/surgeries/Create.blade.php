@extends('layouts.admin')
@section('title','Surgeries Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Surgeries</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Surgeries.index') }}">Surgeries</a>
            </li>
            <li class="breadcrumb-item active">Surgeries Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('Surgeries.store') }}" >
                @csrf
                <div class="form-body">
                  <h4 class="form-section">Surgeries Info</h4>

                  <input type="hidden" name="doctor_id" value="{{ auth()->user()->id }}">


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">patient Name</label>
                        <select name="patient_id" class="form-control">
                            <optgroup label="من فضلك أختر الدكتور او اكثر من واحد ">

                                @if($Patients && $Patients -> count() > 0)
                                    @foreach($Patients as $Patient)
                                        <option
                                            value="{{$Patient->id }}">{{$Patient->name}}</option>
                                    @endforeach
                                @endif
                            </optgroup>
                        </select>
                        @error('patient_id')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput1">start Time Date</label>
                          <input type="datetime-local" id="projectinput1" class="form-control" placeholder="startTime" name="startTime">
                          @error('startTime')
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput1">End Time Date</label>
                          <input type="datetime-local" id="projectinput1" class="form-control" placeholder="EndTime" name="endTime">
                          @error('endTime')
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
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


