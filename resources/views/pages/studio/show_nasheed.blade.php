@extends('layouts.studio.app')
@section('title', 'Dashboard')
@section('content')
<style>
  .btn-close {
    background: transparent;
    border: none;
    color: red;
    font-size: 24px;
    cursor: pointer;
}

.btn-close:hover {
    color: darkred;
}

</style>
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
          <h6>Read Nasheed </h6>
          <a  class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-video-slash    "></i> Video Link </a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <hr style="border-top: 1px solid !important;">
                <div style="padding: 1rem;text-align:center">
                    <div style="margin:0 auto">
                        <p>{{$nasheed->title}}</p>
                        <h4 style="font-size: 15px;font-weight: bold;">{{Auth::guard('studio')->user()->name}}</h4>
                        <hr style="border-top: 2px solid !important;">
                    </div>
                    <div>
                    {!! $nasheed->lyrics !!}
                    </div>

                    <div>
                   
                      
                    @foreach ($nasheed->video_link as $video )
                    <div class="video-container">
                      <!-- YouTube Embed -->
                      <iframe src="https://www.youtube.com/embed/{{$video->link}}" 
                              title="YouTube video player" frameborder="0" 
                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                              allowfullscreen></iframe>
                    
                      <!-- Close Button to Delete the Link -->
                      <form action="{{route('studio.delete_video')}}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="id"value="{{$video->id}}">
                        <button type="submit" class="btn-close" style="background: transparent; border: none; color: red; font-size: 24px;">
                          &times; <!-- Close icon -->
                        </button>
                      </form>
                    </div>
                    
                  <br/>
                    @endforeach

                    </div>
                </div>

           
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="youtubeLinkForm" action="{{route('studio.add_vido_link')}}" method="GET">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 12px">Add YouTube Link</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   
          <div class="mb-3">
            <label for="youtubeLink" class="form-label" style="font-size: 12px">YouTube Link</label>
            <input type="text"  class="form-control" onpaste="handlePast(event)" id="youtubeLink" placeholder="Enter embeded youtube link" required>

            <input type="hidden" name="nasheed_id" value="{{$nasheed->id}}">
            <input type="hidden" name="embed_link" id="embed_link" >
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn bg-gradient-primary" id="addLinkButton">Add Link</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script>

  function handlePast(e){
    setTimeout(() => {

const userInput = e.target.value
const videoIdRegex = /(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
const match = userInput.match(videoIdRegex);

if (match && match[1]) {
  const videoId = match[1];
  console.log("Extracted Video ID:", videoId);
   document.getElementById('embed_link').value = videoId;

}
    }, 1);


  }

  document.getElementById('youtubeLinkForm').addEventListener('submit', function (event) {

  event.preventDefault(); // Prevent the form from reloading the page
  const userInput = document.getElementById('youtubeLink').value;
  // Regular expression to extract the video ID
  const videoIdRegex = /(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
  const match = userInput.match(videoIdRegex);

  if (match && match[1]) {
    const videoId = match[1];
    console.log("Extracted Video ID:", videoId);
    document.getElementById('embed_link').value = videoId;
    document.getElementById('youtubeLinkForm').submit();
  } else {
    alert("Invalid YouTube link. Please try again.");
  }
});


  
</script>
  @endsection