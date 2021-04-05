@extends('admin._base')

@section('title') Articles @endsection

@section('content')
    <form action="{{ route('action-admin-article-update', $article->ID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex">
            <div class="flex-fill">
                <h3 class="font-weight-normal mb-3">{{ $article->title }}</h3>
            </div>
            <div class="flex-fill text-right">
                <button type="submit" class="btn btn-info mr-1">Save</button>
            </div>
        </div>

        <div class="dropdown-divider mt-2 mb-3"></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Title</span>
            </div>
            <input type="text" name="title" class="form-control" value="{{ $article->title }}" placeholder="Title" maxlength="150">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Category</span>
            </div>
            <select class="custom-select" name="category">
                @foreach($categories as $category)
                    <option {{ $article->category_ID == $category->ID ? 'selected' : '' }} value="{{ $category->ID }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <textarea class="form-control" rows="3" maxlength="250" placeholder="Description" name="description">{{ $article->description }}</textarea>
        </div>

        <div class="custom-file">
            <label class="custom-file-label" for="preview">Choose preview image</label>
            <input type="file" name="preview" class="custom-file-input" id="preview">
        </div>

        <div class="my-3 preview_image mx-auto">
            <img id="preview_image" src="{{ $article->preview }}" alt="preview image">
        </div>

        <div class="form-group mt-2">
            <label for="wysiwyg"> Article body </label>
            <textarea name="body" id="wysiwyg" rows="10">{{ $article->content }}</textarea>
        </div>
    </form>

@endsection

@section('javascripts')
    <script>
        $(document).ready(function() {
            $('textarea#wysiwyg').summernote({
                height: '500px'
            });
        });
    </script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#preview").change(function () {
            readURL(this);
        });
    </script>
@endsection