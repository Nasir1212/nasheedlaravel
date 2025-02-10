@extends('layouts.studio.app')
@section('title', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
        </div>
        @endif
        <div class="card-header pb-0 d-flex justify-content-between">
          <h6>All Nasheed </h6>
          <a href="{{route('studio.add_nasheed')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> Add</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Love React</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">View</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                 
                </tr>
              </thead>
              <tbody>
                @foreach ($nasheeds as $nasheed )
                  
               
                <tr>
                  <td>
                    <h6 class="mb-0 text-xs">{{$nasheed->title}}</h6>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{rand(20,60)}}</span>

                  </td>
                  <td class="align-middle text-center">          
                    <span class="text-secondary text-xs font-weight-bold">{{rand(50,200)}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <a href="{{route('studio.edit_nasheed',['id'=>encrypt($nasheed->id)])}}" class="btn btn-warning " > <i class=" fa fa-edit" ></i> </a>
                    <a href="{{route('studio.delete_nasheed',['id'=>encrypt($nasheed->id)])}}" class="btn btn-danger " > <i class=" fa fa-trash" ></i> </a>
                    <a href="{{route('studio.show_nasheed',['id'=>encrypt($nasheed->id)])}}" class="btn btn-success " > <i class=" fa fa-eye" ></i> </a>
                  </td>
                </tr>

                @endforeach
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>



  @endsection