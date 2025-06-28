<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Http\Resources\CarouselResource;
use Illuminate\Support\Facades\Validator;

class CarouselController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all products
        $carousels = Carousel::latest();

        //return collection of products as a resource
        return new CarouselResource(true, 'List Data Image in Carousel', $carousels);
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
        ]);

        if($validator->fails()){
            return response()->json($validator->error(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('carousels', $image->hashName());

        $carousel = Carousel::create([
            'image'       => $image->hashName(),
        ]);

        return new CarouselResource(true, 'Gambar berhasil ditambahkan ke table carousels!', $carousel);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $carousel = Carousel::find($id);

        return new CarouselResource(true, 'Detail Carousel berhasil ditemukan!', $carousel);
    }
}
