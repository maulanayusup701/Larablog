@extends('dashboard.layouts.main')
@section('container')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <h3 class="mt-4 mb-5">
        Larablog | Edit Post
    </h3>
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="/dashboard/posts/{{ $post->slug }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Title</label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" id="title"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        placeholder="Title" value="{{ old('title', $post->title) }}">
                                    <div class="invalid-feedback">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Slug</label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror" name="slug"
                                        placeholder="slug" value="{{ old('slug', $post->slug) }}">
                                    <div class="invalid-feedback">
                                        @error('slug')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Post Image</label>
                                    <input type="hidden" name="oldImage" value="{{ $post->image }}">
                                    @if ($post->image)
                                        <div>
                                            <img src="{{ asset('storage/' . $post->image) }}"
                                                class="img-preview img-fluid mb-3" id="frame" name="name"
                                                style="max-height: 500px; overflow:hidden" />
                                        </div>
                                    @else
                                        <div>
                                            <img src="" class="img-preview img-fluid mb-3" id="frame"
                                                name="name" style="max-height: 500px; overflow:hidden">
                                        </div>
                                    @endif
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        id="image" name="image" onchange="preview()">
                                </div>
                                <div class="col-md-12">
                                    <label>Category</label>
                                </div>
                                <div class="col-md-2 form-group">
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id" value="{{ old('category_id') }}">
                                        @foreach ($categories as $category)
                                            @if (old('category_id', $post->category_id) == $post->category_id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('category_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Body</label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input id="content" type="hidden" name="content"
                                        value="{{ old('content', $post->content) }}">
                                    <trix-editor input="content" value="{{ old('content', $post->content) }}">
                                    </trix-editor>
                                    <div class="invalid-feedback">
                                        @error('content')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Update Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");

        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
