@extends('layouts.studio.app')
@section('title', 'Add Nasheed')
@section('url_title', 'Add Nasheed')
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
                <h6>Add New Nasheed</h6>
                <a href="{{ route('studio.my_nasheed') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-backward" aria-hidden="true"></i> Back
                </a>
            </div>
            
            <div class="card-body px-4 pt-4 pb-2">
                <!-- Add Nasheed Form -->
                <form action="{{ route('studio.store_nasheed') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Nasheed title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Shayer's name</label>
                        <input type="text" readonly  class="form-control"  value="{{Auth::guard('studio')->user()->name}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="lyrics" class="form-label">Nasheed</label>
                        <!-- Quill Editor -->
                        <div id="quill-editor" style="height: 400px;"></div>
                        <!-- Hidden Textarea -->
                        <textarea name="lyrics" id="lyrics" class="form-control d-none">{{ old('lyrics') }}</textarea>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="file" class="form-label">Nasheed File (MP3 or WAV)</label>
                        <input type="file" name="file" class="form-control" id="file" accept=".mp3,.wav" required>
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Add Nasheed</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Quill Script -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<!-- Initialize Quill -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const quill = new Quill("#quill-editor", {
            theme: "snow", // Snow theme
            placeholder: "Write Nasheed here...",
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3,4,5,6, false] }], // Headers
                    ["bold", "italic", "underline", "strike"], // Inline styles
                    [{ color: [] }, { background: [] }], // Text color and background
                    [{ script: "sub" }, { script: "super" }], // Subscript/Superscript
                    [{ list: "ordered" }, { list: "bullet" }], // Lists
                    [{ indent: "-1" }, { indent: "+1" }], // Indent
                    // ["link", "image", "video"], // Media embedding
                    ["blockquote", "code-block"], // Blockquote and code
                    [{ align: [] }], // Text alignment
                    ["clean"], // Clear formatting
                ],
                clipboard: {
                    matchVisual: true, // Retain original formatting
                },
            },
        });

        const form = document.querySelector("form");
        const hiddenTextarea = document.querySelector("#lyrics");

        form.addEventListener("submit", function () {
            // Copy Quill content (HTML) to the hidden textarea
            hiddenTextarea.value = quill.root.innerHTML;
        });
    });
</script>

@endsection
