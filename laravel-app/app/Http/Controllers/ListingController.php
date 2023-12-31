<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::all();
        return View::make('listings/listings', ['listings' => $listings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('listings/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $listing = Listing::factory()->make();
        $user = Auth::user();
        $listing->name = $request->name;
        $listing->description = $request->description;
        $listing->address = $request->address;
        $listing->lat = $request->latitude;
        $listing->lng = $request->longitude;
        if($request->file('image') !== null) {
            $uploadedFileUrl = cloudinary()->uploadFile($request->file('image')->getRealPath())->getSecurePath();
            $listing->cloudinary_image_url = $uploadedFileUrl;
        }
        $listing->user_id = $user->id;
        $listing->save();
        return redirect('listings');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $listing = Listing::find($request->id);
        return View::make('listings/show', ['listing' => $listing]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
