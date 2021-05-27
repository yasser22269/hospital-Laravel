

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

          @endif




          <li class=" navigation-header">
            <span data-i18n="nav.Medicines.pages">Medicines</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Medicines*') ? 'active' : '' }}"><a href="{{ route('Medicines.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Medicines</span><span class="badge badge badge-info float-right"> {{ App\Models\Medicine::count() }} </span></a>
          </li>
































          {{--
    <li class="nav-item  {{ Request::is('Admin/DoctorSchedule*') ? 'active' : '' }}"><a href="{{ route('DoctorSchedule.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Schedule(مواعيد الاطباء)</span><span class="badge badge badge-info float-right"> {{ App\Models\DoctorSchedule::count() }} </span></a>
          </li>
          <li class="nav-item  {{ Request::is('Admin/reservation*') ? 'active' : '' }}"><a href="{{ route('reservation.index') }}"><i class="la la-check-square"></i><span class="menu-title" >reservation(حجوزات)</span><span class="badge badge badge-info float-right"> {{ App\Models\Appointment::count() }} </span></a>
          </li>

          <li class=" navigation-header">
            <span data-i18n="nav.category.pages">categories</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Category*') ? 'active' : '' }}"><a href="{{ route('Category.index') }}"><i class="la la-check-square"></i><span class="menu-title" >categories</span><span class="badge badge badge-info float-right"> {{ App\Models\category::count() }} </span></a>
          </li>



          <li class=" navigation-header">
            <span data-i18n="nav.category.pages">Tags</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item {{ Request::is('Admin/Tag*') ? 'active' : '' }}"><a href="{{ route('Tag.index') }}"><i class="la la-tags"></i><span class="menu-title" >Tags</span><span class="badge badge badge-info float-right"> {{ App\Models\Tag::count() }} </span></a>
          </li>  --}}

          {{-- <li class=" navigation-header">
            <span data-i18n="nav.category.pages">Products</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Products*') ? 'active' : '' }}"><a href="{{ route('Products.index') }}"><i class="la la-edit"></i><span class="menu-title" >Products</span><span class="badge badge badge-info float-right"> {{ App\Models\Product::count() }} </span></a>
          </li> --}}


          {{-- <li class=" navigation-header">
            <span data-i18n="nav.category.pages">Attributes</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Attributes*') ? 'active' : '' }}"><a href="{{ route('Attributes.index') }}"><i class="la la-edit"></i><span class="menu-title" >Attributes</span><span class="badge badge badge-info float-right"> {{ App\Models\Attribute::count() }} </span></a>
          </li> --}}


          {{-- <li class=" navigation-header">
            <span data-i18n="nav.category.pages">Option</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Options*') ? 'active' : '' }}"><a href="{{ route('Options.index') }}"><i class="la la-edit"></i><span class="menu-title" >Options</span><span class="badge badge badge-info float-right"> {{ App\Models\Option::count() }} </span></a>
          </li> --}}
{{--
          <li class=" navigation-header">
            <span data-i18n="nav.contactus.pages">CONTACT</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Contact*') ? 'active' : '' }}"><a href="{{ route('Contact.index') }}"><i class="la la-edit"></i><span class="menu-title" >Contacts</span><span class="badge badge badge-info float-right"> {{ App\Models\ContactUS::count() }} </span></a>
          </li>  --}}





</li>
        {{-- <li class=" navigation-header">
            <span data-i18n="nav.coupons.pages">coupons</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/coupon*') ? 'active' : '' }}"><a href="{{ route('coupon.index') }}"><i class="la la-edit"></i><span class="menu-title" >coupons</span><span class="badge badge badge-info float-right"> {{ App\Models\coupon::count() }} </span></a>
         </li> --}}

        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
      </ul>
    </div>
  </div>
