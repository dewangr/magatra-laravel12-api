<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\CarouselController;
use App\Http\Controllers\Api\RsvpController;

Route::apiResource('/galleries', GalleryController::class);
Route::apiResource('/carousels', CarouselController::class);
Route::apiResource('/rsvps', RsvpController::class);