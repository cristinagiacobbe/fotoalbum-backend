<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            return response()->json(
                [
                    'success' => true,
                    /* 'results' => Photo::with(['category', 'user'])->where('category_id', $request->search->category_id)->where('in_evidence', $request->search->in_evidence)->orderByDesc('id')->paginate(), */
                    'results' => Photo::with(['category', 'user'])->where('category_id', $request->search)->orderByDesc('id')->paginate()

                ]
            );
        }
        return response()->json(
            [
                'success' => true,
                'results' => Photo::with(['category', 'user'])->orderByDesc('id')->paginate(),
            ]
        );
    }


    public function show($id)
    {
        $photo = Photo::with(['category', 'user'])->where('id', $id)->first();

        if ($photo) {
            return response()->json(
                [
                    'success' => 'true',
                    'results' => $photo
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => 'false',
                    'results' => 'No photo found'
                ]
            );
        }
    }
}
