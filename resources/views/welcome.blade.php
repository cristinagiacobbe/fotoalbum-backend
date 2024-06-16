@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-5">


            <h1 class="display-5 fw-bold text-dark">
                Let's have a look at my projects! 😉
            </h1>

            <img width="300" height="200" src="https://picsum.photos/200/300" alt="">

            <p class="col-md-8 fs-4 text-dark">Do you like photography? Let's have a look to this collection!
            </p>
            <a href="{{ route('admin.photos.index') }}" class="btn btn-primary btn-lg" type="button">Go</a>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi
                deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis
                accusamus dolores!</p>
        </div>
    </div>
@endsection
