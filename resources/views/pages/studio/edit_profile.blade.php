@extends('layouts.studio.app') <!-- Assuming Soft UI layout is named 'app' -->
@section('title', 'Update Profile')

@section('content')
@php
   $lyricist = Auth::guard('studio')->user();
@endphp

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="card shadow-sm rounded-4">
        @if ($errors->any())
                
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
        </div>
    @endif
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
        <div class="card-header bg-transparent border-0" style="padding-bottom: 0rem">
          <h6 class="mb-0">Update Profile</h6>
          <hr style="border: 1px solid ">
        </div>
        <div class="card-body" style="padding-top:0rem">
          <form action="{{route('studio.update_profile')}}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3">
                <label for="cover" class="form-label">Cover photo</label>
                <input type="file" name="cover" id="cover" class="form-control">
              </div>
            
            <!-- Profile Image -->
            <div class="mb-3">
              <label for="profile" class="form-label">Profile photo</label>
              <input type="file" name="profile" id="profile" class="form-control">
            </div>

          
            
            <!-- Name -->
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ $lyricist->name }}" required>
            </div>
            
            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ $lyricist->email }}" required>
            </div>
            
            <!-- Phone -->
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" name="phone" id="phone" class="form-control" value="{{ $lyricist->phone ?? '' }}">
            </div>
            
            <!-- About -->
            <div class="mb-3">
              <label for="about" class="form-label">About</label>
              <textarea name="about" id="about" rows="4" class="form-control">{{ $lyricist->about }}</textarea>
            </div>
            
            <!-- Social Media Links -->
            <div class="mb-3">
              <label for="whatsapp" class="form-label">Whatsapp Number </label>
              <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ $lyricist->whatsapp ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="facebook" class="form-label">Facebook Link </label>
              <input type="url" name="facebook" id="facebook" class="form-control" value="{{ $lyricist->facebook ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="twitter" class="form-label">Twitter Link </label>
              <input type="url" name="twitter" id="twitter" class="form-control" value="{{ $lyricist->twitter ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="instagram" class="form-label">Instagram Link </label>
              <input type="url" name="instagram" id="instagram" class="form-control" value="{{ $lyricist->instagram ?? '' }}">
            </div>
            
            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
