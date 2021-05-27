
@extends('layouts.admin')
@section('title','medicines index')
@section('style')
<style>
    .table th, .table td {
        padding: 0.75rem 1rem;
    }
</style>
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">medicines create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">medicines index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Medicines.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add medicine</button>
        </a>

      </div>
    </div>
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table class="table display nowrap table-striped table-bordered scroll-horizontal">
              <thead class="bg-success white">
                <tr>
                  <th> id</th>
                  <th>Name</th>
                  <th>Unit</th>
                  <th>Amount</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($medicines as $index => $medicine)


                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $medicine->name  }}</td>
                  <td >{{ $medicine->Unit  }}</td>
                   <td>{{ $medicine->Amount   }}</td>
                  <td>
                  <a href="{{ route('Medicines.edit',$medicine->id) }}">
                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Edit </button>
                   </a>
                  </td>
                  <td>

                     <form class="form" method="POST" action="{{ route('Medicines.destroy',$medicine->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  medicines  --}}
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
      {{ $medicines->links() }}
    </div>
  </div>
@endsection


