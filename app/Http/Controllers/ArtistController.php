<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ArtistController extends Controller
{
    public $lastFmUrl;
    public $lastFmKey;

    public function __construct()
    {
        $this->lastFmUrl =  config('lastfm.last_fm_url');
        $this->lastFmKey =  config('lastfm.last_fm_api_key');
    }

    public function validation(Request $request, $artist = null)
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
            $favoriteArtists = Artist::where('user_id', $user->id)->get();
            $results = [];
            foreach($favoriteArtists as $favoriteArtist){
                $retrieveLastFmdata = Http::get($this->lastFmUrl.'?method=artist.getinfo&api_key='.$this->lastFmKey.'&mbid='.$favoriteArtist->mbid.'&format=json');
                $results[] = json_decode($retrieveLastFmdata);
            }
            return response()->json(['success' => true, 'data' => $results], 200);
        } catch(\Exception $e){
            Log::error("An error occorued while fetching all artists ". $e);
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
            $artist = new Artist();
            $artist->user_id = $user->id;
            $artist->mbid = $request->input('mbid');
            $favoriteArtist = Artist::where([['user_id', $user->id], ['mbid', $artist->mbid]])->first();
            if($favoriteArtist){
                return response()->json(['message' => 'Artist already saved to favorites successfully'], 201);
            }
            $artist->save();
            return response()->json(['message' => 'Artist saved to favorites successfully'], 201);
        } catch(\Exception $e) {
            Log::error("An error occorued while creating an artist ". $e);
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
            $favoriteArtist = Artist::where([['user_id', $user->id], ['mbid', $id]])->first();
            $results = [];
            if($favoriteArtist){
                $retrieveLastFmdata = Http::get($this->lastFmUrl.'?method=artist.getinfo&api_key='.$this->lastFmKey.'&mbid='.$favoriteArtist->mbid.'&format=json');
                $results[] = json_decode($retrieveLastFmdata);
                return response()->json(['success' => true, 'data' => $results], 200);
            }
            return response()->json(['message' => 'Artist not found'], 404);
        } catch(\Exception $e){
            Log::error("An error occorued while fetching a single artist ". $e);
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
            $favoriteArtist = Artist::where([['user_id', $user->id], ['id', $id]])->first();
            if($favoriteArtist){
                Artist::where([['user_id', $user->id], ['id', $id]])->update([
                    'mbid' => $request->input('mbid'),
                    'updated_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Artist updated successfully'], 201);
            }
            return response()->json(['message' => 'Artist not found'], 404);
        } catch(\Exception $e) {
            Log::error("An error occorued while creating an artist ". $e);
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
            $deleteArtist = Artist::where([['user_id', $user->id], ['mbid', $id]])->delete();
            if($deleteArtist){
                return response()->json(['message' => 'Artist removed from favorites'], 200);
            }
            return response()->json(['message' => 'Artist not found'], 404);
        } catch(\Exception $e){
            Log::error("An error occorued while deleting a single artist ". $e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
