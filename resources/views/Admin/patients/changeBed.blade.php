@extends('layouts.admin')
@section('title','patient  ChangesBed ')
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
            <li class="breadcrumb-item"><a href="{{ route('Patients.edit',$patient->id) }}">patient Edit </a>
            </li>
            <li class="breadcrumb-item active">patient ChangesBed
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
            <form class="form" method="POST" action="{{ route('ChangesBed.update',$patient->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General patient Info</h4>
                  <input type="hidden"  name="id" value="{{ $patient->id }}">
                  {{-- <input type="hidden"  name="Old_bed" value="{{ $patient->bed_id }}"> --}}
                  <div class="row">
                    
                        <div class="col-md-12">
                         <input type="hidden"  name="name" value="{{ $patient->name }}">
                        <h2>Name : {{  $patient->name }}</h2>
                        <input type="hidden"  name="gender" value="{{ $patient->gender }}">
                        <h2>Name : {{  $patient->gender }}</h2>
                        </div>
                        
                      </div>
    

                      @if($patient->discharged == Null)
                      <h2>bed : ( {{ $patient->bed->name }})</h2>
                    @endif

                    <div class="row" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1"> محجوز
                                </label>
                                <input type="checkbox"
                                id="isIsolted"
                                value="{{ $patient->isIsolted }}"
                                {{ ($patient->isIsolted == 1) ? "checked" : ''}}
                                name="isIsolted">
                                @error('isIsolted')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1"> اختر الجناح
                                </label>
                                <select  class="form-control" id="word">
                                    <option ></option>
                                        @if($Wards && $Wards -> count() > 0)
                                            @foreach($Wards as $Ward)
                                                <option
                                                    value="{{$Ward->id }}">{{$Ward->name}} </option>
                                            @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1"> اختر الروم
                                </label>
                                <select  class="form-control" id="room" name="room">
                                    <option> </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1"> اختر السرير
                                </label>
                                <select  class="form-control" id="bed" name="bed_id">
                                    <option> </option>
                                </select>
                            </div>
                        </div>
                    </div>
    

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                  <a href="{{ route('Patients.edit',$patient->id) }}">
                    <button class="btn btn-info box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Back To Edit profile Patient </button>
               </a>
                </div>
              </form>

          

              <hr>
              <h4 class="form-section">Changes Bed Info</h4>

              @foreach ($patient->ChangesBed as $index => $ChangesBed)
        
              <h2>{{ ($index++)+1 }} => {{  $ChangesBed->bedfrom->name}} To  {{  $ChangesBed->bedTo->name }}</h2>
              <hr>

                @endforeach
        
        
        </div>
      </div>



     

        </div>


      </div>
    </div>
  </div>





         @endsection


         @section('js')
         <script>
             $(function(){

                 //عند الضغط على محجوز او لا
                 $('#isIsolted').change(function(){
                         $("#room option").remove();
                          $("#bed option").remove();
                          if($(this).val() == 0){
                             $(this).val("1");
                        }else{
                             $(this).val("0");
                        }
                 });
                 //عند تغير الجناح او اختياره
                 $('#word').change(function(){
                     
                    $("#room option").remove();
                    $("#bed option").remove();
                    var id = $('#word').val();
                    var isIsolted = $('#isIsolted').val();
                    {{-- var gender = {{ $patient->gender }} ; --}}
                    $.ajax({
                       url : '{{ route( 'getrooms' ) }}',
                       data: {
                         "_token": "{{ csrf_token() }}",
                         "id": id,
                         "gender": "{{  $patient->gender }}",
                         "isIsolted": isIsolted,
                         },
                       type: 'post',
                       dataType: 'json',
                       success: function( data )
                       {
                             $('#room').html(data.html);
                       },
                       {{-- error: function()
                      {
                          //handle errors
                          alert('error...');
                      } --}}
                    });
                 });
         
                 $('#room').change(function(){
                     $("#bed option").remove();
                     var id = $('#room').val();
                     $.ajax({
                        url : '{{ route( 'getbeds' ) }}',
                        data: {
                          "_token": "{{ csrf_token() }}",
                          "id": id,
                          },
                        type: 'post',
                        dataType: 'json',
                        success: function( data )
                        {
                              $('#bed').html(data.html);
                        },
                        {{-- error: function()
                       {
                           //handle errors
                           alert('error...');
                       } --}}
                     });
                  });
               
             });
         </script>
 @endsection