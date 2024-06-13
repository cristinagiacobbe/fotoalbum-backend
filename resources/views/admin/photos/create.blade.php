@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-3">Add a new photo</h1>

        @include('partials.errors')

        <form action="{{ route('admin.photos.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label"><strong>Title</strong></label>
                <input type="text" class="form-control @error('title')is-invalid @enderror" name="title" id="title"
                    aria-describedby="helptitle" placeholder="Type a title for your photo" value="{{ old('title') }}" />
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label"><strong>Category</strong></label>
                <select class="form-select " name="category_id" id="category_id">
                    <option selected></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="image" class="form-label"><strong>Image</strong></label>
                <input type="file" class="form-control @error('image')is-invalid @enderror" name="image" id="image"
                    aria-describedby="helpcover_image" placeholder="Upload your photo" />

            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><strong>Description</strong></label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3 d-flex gap-3">
                <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="{{ old('in_evidence') }}" id="in_evidence"
                        name="in_evidence" {{ old('in_evidence') ? 'checked' : '' }} />
                    <label class="form-check-label" for="in_evidence">Do you want to put photo in evidence?</label>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
            <button class="btn btn-danger">Turn back to photos list</button>

        </form>
    </div>
@endsection
