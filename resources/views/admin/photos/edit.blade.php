@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-3">Update photo n.{{ $photo->id }}</h1>

        @include('partials.errors')

        <form action="{{ route('admin.photos.update', $photo) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label"><strong>Title</strong></label>
                <input type="text" class="form-control @error('title')is-invalid @enderror" name="title" id="title"
                    aria-describedby="helptitle" placeholder="Type here to change post title"
                    value="{{ old('title') ?: $photo->title }}" />
                {{-- <small id="helptitle" class="form-text text-muted">Update project title</small> --}}

                {{-- @error('title')
                    <div class="alert alert-danger ">{{ $message }}</div>
                @enderror --}}
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label"><strong>Category</strong></label>
                <select class="form-select " name="category_id" id="category_id">

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $photo->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="image" class="form-label"><strong>Image</strong></label>
                <div>
                    {{--   @include('partials.image_snippet') --}}
                </div>


                <div class="d-flex gap-3">
                    <img width="140" src="{{ asset('storage/' . $photo->image) }}" alt="">
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload another cover image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="image"
                            aria-describedby="ImageHelper" />
                    </div>
                </div>

                {{-- <input type="file" class="form-control @error('image')is-invalid @enderror" name="image" id="image"
                    aria-describedby="helpimage" value="old('image') ?: $photo->image }}" /> --}}
                {{--  <small id="helpcover_image" class="form-text text-muted">Upload cover_image</small> --}}

                {{-- @error('image')
                    <div class="alert alert-danger ">{{ $message }}</div>
                @enderror --}}
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><strong>Description</strong></label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') ?: $photo->description }}</textarea>
            </div>

            <div class="mb-3 d-flex gap-3">
                <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="in_evidence" id="in_evidence" name="in_evidence"
                        {{ old('in_evidence', $photo->in_evidence) ? 'checked' : '' }} />
                    <label class="form-check-label" for="in_evidence">Do you want to put photo in evidence?</label>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>
@endsection
