<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallery;
use App\Http\Resources\GalleryResource;

class GalleryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all products
        $galleries = Gallery::latest()->get();

        //return collection of products as a resource
        return new GalleryResource(true, 'List Data Image in Gallery', $galleries);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'caption' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->error(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('galleries', $image->hashName());

        $gallery = Gallery::create([
            'image'       => $image->hashName(),
            'caption'   => $request->caption,
        ]);

        return new GalleryResource(true, 'Data foto berhasil ditambahkan ke Gallery!', $gallery);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);

        return new GalleryResource(true, 'Detail Gallery berhasil ditemukan!', $gallery);
    }
}
