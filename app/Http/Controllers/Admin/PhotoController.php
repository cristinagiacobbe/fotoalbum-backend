<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Category;
use App\Models\Evidence;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::orderByDesc('id')->where('user_id', auth()->id())->paginate(10);
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        $val_data = $request->validated();

        /*    if ($request->has('image')) { */  //is not a possibility 'cause image is required
        $val_data['image'] = Storage::put('uploads', $request->image);
        /* }; */
        if ($request->has('in_evidence')) {
            $val_data['in_evidence'] = 1;
        }
        $val_data['user_id'] = auth()->id();

        $photos = Photo::create($val_data);
        /*  dd($val_data); */
        return to_route('admin.photos.index')->with('message', 'Your photo has successfully uploaded😄');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        if ($photo->user_id == auth()->id()) {
            $categories = Category::all();
            return view('admin.photos.edit', compact('photo', 'categories'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        if ($photo->user_id == auth()->id()) {
            $val_data = $request->validated();

            if ($request->has('image')) {
                $val_data['image'] = Storage::put('uploads', $request->image);
            } else {
                $val_data['image'] = Storage::put('uploads', $photo->image);
            }

            $photo->update($val_data);
            return to_route('admin.photos.index')->with('message', 'Your photo has successfully updated😄');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        if ($photo->user_id == auth()->id()) {
            Storage::delete($photo->image);

            $photo->delete();
            return to_route('admin.photos.index')->with('message', 'Your photo has been definitively removed');
        } else {
            abort(403);
        }
    }
}
