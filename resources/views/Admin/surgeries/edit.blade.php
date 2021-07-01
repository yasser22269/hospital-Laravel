@extends('layouts.admin')
@section('title','Surgery  Edit')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Surgery </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Surgeries.index') }}">Surgery </a>
            </li>
            <li class="breadcrumb-item active">Surgery  Edit
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
            <form class="form" method="POST" action="{{ route('Surgeries.update',$Surgery->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General Surgery Info</h4>
                  <input type="hidden"  name="id" value="{{ $Surgery->id }}">
                  <input type="hidden" name="doctor_id" value="{{ auth()->user()->id }}">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">schedule Date</label>
                        <input type="date" id="projectinput1" class="form-control" placeholder="scheduleDate" name="scheduleDate" value="{{ $Surgery->scheduleDate }}">
                        @error('scheduleDate')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Patient Name</label>
                          <select name="patient_id" class="form-control" >
                              <optgroup label="من فضلك أختر الدكتور او اكثر من واحد ">

                                  @if($Patients && $Patients -> count() > 0)
                                      @foreach($Patients as $Patient)
                                          <option
                                          {{ $Patient->id == $Surgery->patient_id ? 'selected':'' }}
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
                          <input type="time" id="projectinput1" class="form-control" placeholder="startTime" name="startTime" value="{{ $Surgery->startTime }}">
                          @error('startTime')
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput1">End Time Date</label>
                          <input type="time" id="projectinput1" class="form-control" placeholder="EndTime" name="endTime" value="{{ $Surgery->endTime }}">
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








        </div>


      </div>
    </div>
  </div>




         @endsection

