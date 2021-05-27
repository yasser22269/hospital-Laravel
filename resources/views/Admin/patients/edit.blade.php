@extends('layouts.admin')
@section('title','patient  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">patient </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Patients.index') }}">patient </a>
            </li>
            <li class="breadcrumb-item active">patient  Edit
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
            <form class="form" method="POST" action="{{ route('Patients.update',$patient->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General patient Info</h4>
                  <input type="hidden"  name="id" value="{{ $patient->id }}">
                  <input type="hidden"  name="bed_id" value="{{ $patient->bed_id }}">

                  <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name" value="{{  $patient->name }}">
                        </div>
                          @error("name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">Gender( male , female )
                            </label>
                                   <select  class="form-control" name="gender" id="genderID">
                                        <option value="male"   {{ ($patient->gender == 'male') ? "selected" : ''}}>male</option>
                                        <option value="female"{{ ($patient->gender == 'female') ? "selected" : ''}}>female</option>

                                </select>
                            @error("gender")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                  </div>

                  @if($patient->discharged == Null)
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1"> Will he come out today?
                                </label>

                                <input type="checkbox"
                                value="1"
                                name="discharged">
                                @error('discharged')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                      <h2>Bed :   ({{ $patient->bed->name }})  </h2>
                    @else
                    <h2>discharged : ({{ $patient->discharged }})</h2>
                  @endif


                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                  <a href="{{ route('ChangesBed.edit',$patient->id) }}">
                    <button class="btn btn-info box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> change bed Or Detials </button>
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

