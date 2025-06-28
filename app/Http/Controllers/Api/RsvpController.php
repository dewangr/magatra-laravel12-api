<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rsvp;
use App\Http\Resources\RsvpResource;
use Illuminate\Support\Facades\Validator;

class RsvpController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all products
        $rsvps = Rsvp::latest()->get();

        //return collection of products as a resource
        return new RsvpResource(true, 'List Data Rsvp', $rsvps);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_tamu' => 'required',
            'ucapan'    => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->error(), 422);
        }

        $rsvp = Rsvp::create([
            'nama_tamu'       => $request->nama_tamu,
            'ucapan'          => $request->ucapan,
        ]);

        return new RsvpResource(true, 'Berhasil menambahkan data rsvp!', $rsvp);
    }


    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $rsvp = Rsvp::find($id);

        return new RsvpResource(true, 'Detail rsvp berhasil ditemukan!', $rsvp);
    }
}
