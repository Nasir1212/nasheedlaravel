@extends('layouts.studio.app') <!-- Assuming Soft UI layout is named 'app' -->
@section('title', 'User Profile Dashboard')

@section('content')
@php
   $lyricist = Auth::guard('studio')->user()
@endphp
<div class="container-fluid py-4">
  <!-- Header Section -->
  <div class="row">
    <div class="col-md-12">
      <div class="card bg-gradient-primary text-white">
        <div class="card-body d-flex align-items-center">
          <div class="d-flex align-items-center">
            <img src="{{ $lyricist->profile_image ?? 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png' }}" 
                 alt="Profile Image" 
                 class="rounded-circle" 
                 style="width: 100px; height: 100px; object-fit: cover;">
            <div class="ms-4">
              <h4 class="mb-1">{{ $lyricist->name }}</h4>
              <p class="mb-0">Joined: {{ $lyricist->created_at->format('F d, Y') }}</p>
              <p class="mb-0 text-sm">Lyricist | {{ $lyricist->email }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics Section -->
  {{-- <div class="row mt-4">
    <div class="col-md-3">
      <div class="card text-center">
        <div class="card-body">
          <h6>Total Songs</h6>
          <h3>{{ $lyricist->songs_count ?? 0 }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center">
        <div class="card-body">
          <h6>Followers</h6>
          <h3>{{ $lyricist->followers_count ?? 0 }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center">
        <div class="card-body">
          <h6>Likes</h6>
          <h3>{{ $lyricist->likes_count ?? 0 }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center">
        <div class="card-body">
          <h6>Comments</h6>
          <h3>{{ $lyricist->comments_count ?? 0 }}</h3>
        </div>
      </div>
    </div>
  </div> --}}

  <!-- About Section -->
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6>About</h6>
        </div>
        <div class="card-body">
          <p>{{ $lyricist->about ?? 'No about information provided.' }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Social Media Section -->
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6>Social Media</h6>
        </div>
        <div class="card-body text-center">
          <a href="{{ $lyricist->facebook ?? '#' }}" class="btn btn-facebook btn-icon-only mx-2">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="{{ $lyricist->twitter ?? '#' }}" class="btn btn-twitter btn-icon-only mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="{{ $lyricist->instagram ?? '#' }}" class="btn btn-instagram btn-icon-only mx-2">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Songs Section -->
  {{-- <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6>Written Songs</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lyricist->songs as $index => $song)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $song->title }}</td>
                  <td>{{ $song->created_at->format('Y-m-d') }}</td>
                  <td>
                    <a href="{{ route('songs.show', $song->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('songs.destroy', $song->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
</div>
@endsection
