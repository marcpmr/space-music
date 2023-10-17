<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavouriteList;
use App\Models\Favourite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class FavouritelistController extends Controller
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
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($list_name)
    {
        $retrievingFavouriteList = FavouriteList::where(['list_name' => $list_name, 'login_id' => Auth::user()->id])->take(8)->count();

        if ($retrievingFavouriteList == 0) {
                $favouriteList = new FavouriteList;

                $favouriteList->login_id = Auth::user()->id;
                $favouriteList->user_id = Auth::user()->name;
                $favouriteList->list_name = $list_name;
                $favouriteList->save();

                return Redirect::to('/search');
        } else {
            return Redirect::to('/');
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
    public function destroy($id)
    {
        Favourite::where('favourite_list_id', $id)->delete(); 
        FavouriteList::find($id)->delete();

        return Redirect::to('/search');
    }
}
