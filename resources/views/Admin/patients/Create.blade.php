@extends('layouts.admin')
@section('title','patients Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">patients</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Patients.index') }}">patients</a>
            </li>
            <li class="breadcrumb-item active">patients Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('Patients.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">patients Info</h4>



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
                            <label for="projectinput1">Gender( male , female )
                            </label>
                                   <select  class="form-control" name="gender" id="genderID">
                                        <option value="male">male</option>
                                        <option value="female">female</option>
                                       
                                </select>
                            @error("gender")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="projectinput1"> محجوز
                            </label>
                            <input type="checkbox"
                            id="isIsolted"
                            value="0"
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
                </div>
              </form>

              </div>
         </div>


         @endsection

{{-- @section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script>
    $(document).ready(function() {
        $(".select2").select2();
        });
</script>
@endsection --}}

@section('js')
<script>
    $(function(){
        //عند الضغط على  الجنس
        $('#genderID').change(function(){
            $("#room option").remove();
             $("#bed option").remove();
        });
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
           var gender = $('#genderID').val();
           $.ajax({
              url : '{{ route( 'getrooms' ) }}',
              data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "gender": gender,
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