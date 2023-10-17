<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($favourite_name, $song_id)
    {
        $retrievingFavourite = Favourite::where(['song_id' => $song_id, 'login_id' => Auth::user()->id])->take(8)->count();
        if ($retrievingFavourite == 0) {
            $favourite = new Favourite;

            $favourite->login_id = Auth::user()->id;
            $favourite->song_id = $song_id;
            $favourite->user_id = Auth::user()->name;
            $favourite->favourite_list_id = $favourite_name;
            $favourite->save();

            return Redirect::to('/search');
        } else {
            return Redirect::to('/search');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($song_id)
    {
        $retrievingFavourite = Favourite::where(['song_id' => $song_id, 'login_id' => Auth::user()->id])->take(1)->first();
        Favourite::find($retrievingFavourite->id)->delete();
        return Redirect::to('/search');
    }
}
