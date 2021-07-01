

  <div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        {{-- <li class=" navigation-header">
            <span data-i18n="nav.Users.pages">Users</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Users*') ? 'active' : '' }}"><a href="{{ route('Users.index') }}"><i class="la la-user"></i><span class="menu-title" >Users</span><span class="badge badge badge-info float-right"> {{ App\Models\User::count() }} </span></a>
          </li> --}}

          @if (auth('admin')->user()->type_id == 'manger')


        <li class=" navigation-header">
            <span data-i18n="nav.Order.pages">Doctors</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Doctors*') ? 'active' : '' }}"><a href="{{ route('Doctors.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Doctors</span><span class="badge badge badge-info float-right"> {{ App\Models\Admin::Doctor()->count() }} </span></a>
          </li>

          <li class=" navigation-header">
            <span data-i18n="nav.Order.pages">Nurses</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Nurses*') ? 'active' : '' }}"><a href="{{ route('Nurses.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Nurses</span><span class="badge badge badge-info float-right"> {{ App\Models\Admin::Nurse()->count() }} </span></a>
          </li>

          <li class=" navigation-header">
            <span data-i18n="nav.Order.pages">Shifts</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Patients*') ? 'active' : '' }}"><a href="{{ route('Patients.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Patients</span><span class="badge badge badge-info float-right"> {{ App\Models\Patient::count() }} </span></a>
          </li>


          <li class=" navigation-header">
            <span data-i18n="nav.Logs.pages">Logs</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/LogsPage*') ? 'active' : '' }}"><a href="{{ route('admin.LogsPage') }}"><i class="la la-check-square"></i><span class="menu-title" >Logs</span></a>
          </li>
{{-- {{ App\Models\Log::count() }} --}}


<li class=" navigation-header">
    <span data-i18n="nav.Medicines.pages">Medicines</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
  </li>
  <li class="nav-item  {{ Request::is('Admin/Medicines*') ? 'active' : '' }}"><a href="{{ route('Medicines.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Medicines</span><span class="badge badge badge-info float-right"> {{ App\Models\Medicine::count() }} </span></a>
  </li>

          @endif





          <li class=" navigation-header">
            <span data-i18n="nav.administrations.pages">Administrations</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/administrations*') ? 'active' : '' }}"><a href="{{ route('administrations.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Administrations</span><span class="badge badge badge-info float-right"> {{ App\Models\PatientMedicine::Active()->DoseAmountNull()->count() }} </span></a>
          </li>



          @if (auth('admin')->user()->type_id == 'doctor')
          <li class=" navigation-header">
            <span data-i18n="nav.PatientMedicine.pages">PatientMedicine</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/patient_medicines*') ? 'active' : '' }}"><a href="{{ route('patient_medicines.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Patient Medicines</span><span class="badge badge badge-info float-right"> {{ App\Models\PatientMedicine::count() }} </span></a>
          </li>


          <li class=" navigation-header">
            <span data-i18n="nav.Surgeries.pages">Surgeries</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Surgeries*') ? 'active' : '' }}"><a href="{{ route('Surgeries.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Surgeries</span><span class="badge badge badge-info float-right"> {{ App\Models\Surgery::count() }} </span></a>
          </li>

          @endif









</li>

        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
      </ul>
    </div>
  </div>
