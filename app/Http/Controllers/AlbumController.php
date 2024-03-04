<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Album;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{
    public $lastFmUrl;
    public $lastFmKey;

    public function __construct()
    {
        $this->lastFmUrl =  config('lastfm.last_fm_url');
        $this->lastFmKey =  config('lastfm.last_fm_api_key');
    }

    public function validation(Request $request, $album = null)
    {

        $request->validate(
            [
                'mbid' => 'required',
            ]
        );

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $user = $request->user();
            $favoriteAlbums = Album::where('user_id', $user->id)->get();
            $results = [];
            foreach($favoriteAlbums as $favoriteAlbum){
                $retrieveLastFmdata = Http::get($this->lastFmUrl.'?method=album.getinfo&api_key='.$this->lastFmKey.'&mbid='.$favoriteAlbum->mbid.'&format=json');
                $decodedData = json_decode($retrieveLastFmdata, true);
                $decodedData['mbid'] = $favoriteAlbum->mbid;
                $results[] = $decodedData;
            }
            return response()->json(['success' => true, 'data' => $results], 200);
        } catch(\Exception $e){
            Log::error("An error occorued while fetching all albums ". $e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
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
    public function store(Request $request)
    {
        $this->validation($request);
        try{
            $user = $request->user();
            $album = new Album();
            $album->user_id = $user->id;
            $album->mbid = $request->input('mbid');
            $favoriteAlbum = Album::where([['user_id', $user->id], ['mbid', $album->mbid]])->first();
            if($favoriteAlbum){
                return response()->json(['message' => 'Album already saved to favorites successfully'], 201);
            }
            $album->save();
            return response()->json(['message' => 'Album saved to favorites successfully'], 201);
        } catch(\Exception $e) {
            Log::error("An error occorued while creating an album ". $e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try{
            $user = $request->user();
            $favoriteAlbum = Album::where([['user_id', $user->id], ['mbid', $id]])->first();
            $results = [];
            if($favoriteAlbum){
                $retrieveLastFmdata = Http::get($this->lastFmUrl.'?method=album.getinfo&api_key='.$this->lastFmKey.'&mbid='.$favoriteAlbum->mbid.'&format=json');
                $results[] = json_decode($retrieveLastFmdata);
                return response()->json(['success' => true, 'data' => $results], 200);
            }
            return response()->json(['message' => 'Album not found'], 404);
        } catch(\Exception $e){
            Log::error("An error occorued while fetching a single album ". $e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
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
        $this->validation($request);
        try{
            $user = $request->user();
            $favoriteAlbum = Album::where([['user_id', $user->id], ['id', $id]])->first();
            if($favoriteAlbum){
                Album::where([['user_id', $user->id], ['id', $id]])->update([
                    'mbid' => $request->input('mbid'),
                    'updated_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Album updated successfully'], 201);
            }
            return response()->json(['message' => 'Album not found'], 404);
        } catch(\Exception $e) {
            Log::error("An error occorued while creating an album ". $e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try{
            $user = $request->user();
            $deleteAlbum = Album::where([['user_id', $user->id], ['mbid', $id]])->delete();
            if($deleteAlbum){
                return response()->json(['message' => 'Album removed from favorites'], 200);
            }
            return response()->json(['message' => 'Album not found'], 404);
        } catch(\Exception $e){
            Log::error("An error occorued while deleting a single album ". $e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
