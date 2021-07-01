
@extends('layouts.admin')
@section('title','home')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />

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




    <?php $currentTime = getdate();   ?>
    <h1 class="clock"></h1>
    <div class="response"></div>
    <div id='calendar' class="fc fc-unthemed fc-ltr"></div>



@endsection


@section('js')
<script>
    var date = new Date(Date.UTC(<?php echo $currentTime['year'] .",".
                                        $currentTime['mon'] .",".
                                        $currentTime['mday'] .",".
                                        $currentTime['hours'] .",".
                                        $currentTime['minutes'] .",".
                                        $currentTime['seconds']; ?>));
    setInterval(function() {
        date.setSeconds(date.getSeconds() + 1);
        $('.clock').html((date.getHours() +':' + date.getMinutes() + ':' + date.getSeconds() ));
        {{-- console.log((date.getHours() +':' + date.getMinutes() + ':' + date.getSeconds() )); --}}
    }, 1000);
</script>



<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

{{--  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>  --}}

<script type="text/javascript">
    $(document).ready(function() {
        events={!! json_encode($events) !!};
         $('#calendar').fullCalendar({
             header: {
                 left: 'prev,next today',
                 center: 'title',
                 right: 'month,basicWeek,basicDay'
             },

             defaultDate: "{{ today()}}",
             navLinks: true, // can click day/week names to navigate views
             editable: true,
             eventLimit: true, // allow "more" link when too many events
             events: events,
         dayClick: function(date, allDay, jsEvent, view) {
             var eventsCount = 0;
             var date = date.format('YYYY-MM-DD');
             $('#calendar').fullCalendar('clientEvents', function(event) {
                 var start = moment(event.start).format("YYYY-MM-DD");
                 var end = moment(event.end).format("YYYY-MM-DD");
                 if(date == start)
                 {
                     eventsCount++;
                 }
             });
             alert(eventsCount);
         }
     });
 });
 </script>
@endsection
