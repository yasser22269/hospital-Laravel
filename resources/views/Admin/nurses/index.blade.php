@extends('layouts.admin')
@section('title','nurses index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">nurses create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">nurses index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Nurses.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add nurse</button>
        </a>

      </div>
    </div>
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="card">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table class="table">
              <thead class="bg-success white">
                <tr>
                  <th> id</th>
                  <th>Name</th>
                  <th>email</th>
                  <th>shift Start</th>
                  <th>shift End</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($nurses as $index => $nurse)


                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $nurse->name  }}</td>
                  <td>{{ $nurse->email }}</td>
                  <td>{{ $nurse->shift->start_time  }}</td>
                  <td>{{ $nurse->shift->end_time  }}</td>
                  <td>
                  <a href="{{ route('Nurses.edit',$nurse->id) }}">
                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Edit </button>
                   </a>
                  </td>
                  <td>

                     <form class="form" method="POST" action="{{ route('Nurses.destroy',$nurse->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  nurses  --}}
                          <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" ><i class="la la-remove la-sm"></i> DELETE </button>

                      </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

      </div>
      {{ $nurses->links() }}
    </div>
  </div>
@endsection


