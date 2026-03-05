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
        $carousels = Carousel::latest()->get();

        //return collection of products as a resource
        return new CarouselResource(true, 'List Data Kehadiran Tamu', $carousels);
    }

    public function indexByOwner($ownerName)
    {
        //get all products
        $carousels = Carousel::where('ownerName', $ownerName)->latest()->get();

        //return collection of products as a resource
        return new CarouselResource(true, 'List Data Kehadiran Tamu dari ' . $ownerName, $carousels);
    }

    public function indexByCeremonyType($ceremonyType)
    {
        //get all products
        $carousels = Carousel::where('ceremonyType', $ceremonyType)->latest()->get();

        //return collection of products as a resource
        return new CarouselResource(true, 'List Data Kehadiran Tamu untuk Jenis Acara ' . $ceremonyType, $carousels);
    }

    public function indexByOwnerAndCeremonyType($ownerName, $ceremonyType)
    {
        //get all products
        $carousels = Carousel::where('ceremonyType', $ceremonyType)->where('ownerName', $ownerName)->latest()->get();

        //return collection of products as a resource
        return new CarouselResource(true, 'List Data Kehadiran Tamu untuk ' . $ownerName . ' dan Jenis Acara ' . $ceremonyType, $carousels);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'ownerName' => 'required',
            'ceremonyType' => 'required|in:0,1,2', // 0: Pawiwahan, 1: Mepandes, 2: Tigabulanan
            'guestName' => 'required',
            'guestMessage' => 'required',
            'guestAttendance' => 'nullable|in:0,1,2',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $carousel = Carousel::create([
            'ownerName'       => $request->ownerName,
            'ceremonyType'    => $request->ceremonyType,
            'guestName'       => $request->guestName,
            'guestMessage'    => $request->guestMessage,
            'guestAttendance' => $request->guestAttendance,
        ]);

        return new CarouselResource(true, 'Berhasil menambahkan data attendance!', $carousel);
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

        return new CarouselResource(true, 'Detail carousel berhasil ditemukan!', $carousel);
    }
}
