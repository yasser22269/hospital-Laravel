@extends('layouts.admin')
@section('title','doctor  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">doctor </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Doctors.index') }}">doctor </a>
            </li>
            <li class="breadcrumb-item active">doctor  Edit
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
            <form class="form" method="POST" action="{{ route('Doctors.update',$doctor->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General doctor Info</h4>
                  <input type="hidden"  name="id" value="{{ $doctor->id }}">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Email</label>
                        <input type="email" id="projectinput1" class="form-control" placeholder="email" name="email" value="{{ $doctor->email }}">
                        @error('email')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name" value="{{  $doctor->name }}">
                        </div>
                          @error("name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                  </div>



                  <div class="row">



                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="projectinput2">password:</label>
                            <input type="password" id="projectinput2" class="form-control" placeholder="password" name="password" >
                          </div>
                            @error("pasword")
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                      </div>



                  </div>


                <div class="row" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="projectinput1"> اختر القسم
                            </label>
                            <select name="shift_id" class="form-control">
                                <optgroup label="من فضلك أختر القسم ">

                                    @if($Shifts && $Shifts -> count() > 0)
                                        @foreach($Shifts as $Shift)
                                            <option
                                            {{ ($doctor->shift_id == $Shift->id) ? "selected" : ''}}
                                                value="{{$Shift->id }}">{{$Shift->start_time}} To {{$Shift->end_time}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('shift_id')
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

