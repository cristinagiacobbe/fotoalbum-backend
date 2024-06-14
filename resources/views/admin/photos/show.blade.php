@extends('layouts.app')

@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                {{ $photo->title }}
            </h1>
            <a class="btn btn-primary" href="{{ route('admin.photos.index') }}">
                <i class="fas fa-chevron-left fa-sm fa-fw"></i> Turn back to photos list</a>
        </div>
    </header>


    <div class="container mt-5">

        <div class="row">
            <div class="col">
                @if (Str::startsWith($photo->image, 'https://'))
                    <img loading="lazy" class="card-img-top" src="{{ $photo->image }}" alt="something wrong">
                @else
                    <img loading="lazy" class="card-img-top" src="{{ asset('storage/' . $photo->image) }}">
                @endif
            </div>
            <div class="col">
                <div>
                    {{ $photo->user_id }}
                </div>
                <div>
                    <strong>Category</strong> {{ $photo->category ? $photo->category->name : 'Uncategorized' }}
                </div>
                <div>
                    <strong>{{ $photo->in_evidence ? 'In evidence' : '' }}</strong>
                </div>
                <div>{{ $photo->description }}</div>
            </div>

        </div>
    @endsection
