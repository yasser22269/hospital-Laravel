@extends('layouts.admin')
@section('title','medicines Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">medicines</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Medicines.index') }}">medicines</a>
            </li>
            <li class="breadcrumb-item active">medicines Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('Medicines.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">medicines Info</h4>



                  <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name">
                        </div>
                          @error("name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">Unit( pills , gram )
                            </label>
                                   <select  class="form-control" name="Unit" >
                                        <option value="pills">pills</option>
                                        <option value="gram">gram</option>

                                </select>
                            @error("Unit")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Amount:</label>
                          <input type="number" id="projectinput2" class="form-control" placeholder="Amount" name="Amount">
                        </div>
                          @error("Amount")
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

