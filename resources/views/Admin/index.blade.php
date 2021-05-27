
@extends('layouts.admin')
@section('title','home')

@section('style')
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
@endsection

@section('content')
  <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- eCommerce statistic -->
    <div class="row">
      <div class="col-xl-4 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="info">{{ $Nursecount }}</h3>
                  <h6>Nurses Count</h6>
                </div>
                <div>
                  <i class="icon-user info font-large-2 float-right"></i>
                </div>
              </div>
              {{--  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
                aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
              </div>  --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="success">{{ $Doctorcount }}</h3>
                  <h6>Doctors</h6>
                </div>
                <div>
                  <i class="icon-user-follow success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="danger">{{ $patientCount }}</h3>
                  <h6>Patient Count</h6>
                </div>
                <div>
                  <i class="icon-heart danger font-large-2 float-right"></i>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    


    </div>
    <!--/ eCommerce statistic -->
    <!-- Products sell and New Orders -->






@endsection


@section('js')

@endsection
