@extends('layouts.studio.app') <!-- Assuming Soft UI layout is named 'app' -->
@section('title', ' Profile')

@section('content')
@php
   $lyricist = Auth::guard('studio')->user()
@endphp

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-4 mb-4">
      @if (session('error'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
      </div>
      @endif
      <!-- Profile Card -->
      <div class="card card-profile">
        <img style="height: 10rem;" src="{{$ImgUrl}}/uploads/{{$lyricist->cover}}" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-4 col-lg-4 order-lg-2">
            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
              <a href="#">
                <img src="{{$ImgUrl}}/uploads/{{ $lyricist->profile}}" 
                     class="rounded-circle img-fluid border border-2 border-white">
              </a>
            </div>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="text-center mt-4">
            <h5>{{ $lyricist->name }}</h5>
            <p class="text-muted">{{ $lyricist->email }}</p>
            <p class="text-muted">Joined Since: {{ $lyricist->created_at->format('F d, Y') }}</p>
          </div>
          <div class="text-center">
            <a  href="{{route('studio.edit_profile')}}" class="btn btn-primary btn-sm">Update Profile</a >
          </div>
        </div>
       
      </div>
    </div>

      <!-- Contact Information -->
      <div class="col-lg-8 ">
      <div class="card ">
        <div class="card-header">
          <h6 class="mb-0">Contact Information</h6>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item border-0 ps-0">
              <strong>Email:</strong> {{ $lyricist->email }}
            </li>
            <li class="list-group-item border-0 ps-0">
              <strong>Phone:</strong> {{ $lyricist->phone ?? 'N/A' }}
            </li>
          </ul>
        </div>
      </div>
      <div class="card mt-4">
        <div class="card-header">
          <h6 class="mb-0">Connect with me</h6>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
              <a href="{{ $lyricist->facebook ?? '#' }}" class="btn btn-facebook btn-icon-only mx-2">
                  <i class="fab fa-facebook"></i>
              </a>
              <a href="{{ $lyricist->twitter ?? '#' }}" class="btn btn-twitter btn-icon-only mx-2">
                  <i class="fab fa-twitter"></i>
              </a>
              <a href="{{ $lyricist->instagram ?? '#' }}" class="btn btn-instagram btn-icon-only mx-2">
                  <i class="fab fa-instagram"></i>
              </a>
              <a href="{{ $lyricist->whatsapp ? 'https://wa.me/+88' . $lyricist->whatsapp : '#' }}" 
                 class="btn btn-whatsapp btn-icon-only mx-2">
                  <i class="fab fa-whatsapp"></i>
              </a>
          </div>
      </div>
      
      </div>
      </div>
    </div>


  <div class="row">
    <div class="col-lg-12">
      <!-- About Section -->
      <div class="card mt-2">
        <div class="card-header">
          <h6 class="mb-0">About</h6>
        </div>
        <div class="card-body">
          <p>{{ $lyricist->about ?? "No about information provided." }}</p>
        </div>
      </div>
  </div>

</div>

</div>

@endsection
