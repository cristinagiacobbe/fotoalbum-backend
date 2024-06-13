@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.success')

        <div class="table-responsive">
            <table class="table table-secondary px-2">
                <a class="btn btn-info m-2" href="{{ route('admin.photos.create') }}">Add a new photo</a>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">In evidence</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($photos as $photo)
                        <tr class="">
                            <td scope="row">{{ $photo->id }}</td>
                            <td>{{ $photo->title }}</td>

                            {{-- Check for image --}}
                            <td>
                                @include('partials.image_snippet')
                            </td>

                            <td>{{ $photo->description }}</td>

                            <td>
                                <span
                                    class="badge bg-primary">{{ $photo->category ? $photo->category->name : 'no category selected' }}</span>
                            </td>

                            <td>
                                <span class="badge bg-secondary">{{ $photo->in_evidence ? 'in evidence' : '' }}</span>
                            </td>

                            <td>
                                <a href="{{ route('admin.photos.show', $photo) }}" class="btn btn-primary ">
                                    <i class="fa-solid fa-binoculars"></i>
                                </a>
                                <a href="{{ route('admin.photos.edit', $photo) }}" class="btn btn-dark m-1 ">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $photo->id }}"><i class="fa-solid fa-ban"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $photo->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $photo->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{ $photo->id }}">
                                                    Delete photo n.{{ $photo->id }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">Are tou really sure yuo want to remove this photo? 🧐
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>

                                                <form action="{{ route('admin.photos.destroy', $photo) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger ">Delete</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="5">No photos uploaded 🙅‍♀️</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>

    </div>

    {{ $photos->links('pagination::bootstrap-5') }}
@endsection
