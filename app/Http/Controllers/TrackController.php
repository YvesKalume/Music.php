<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tracks = Track::all();
        return view('track/index', ['tracks' => $tracks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::all();
        $artists = Artist::all();
        return view('track/create', ['albums' => $albums, 'artists' => $artists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file->store('tracks');
        $track = Track::create([
            'title' => $request->title,
            'path' => $path,
        ]);
        $artists = Artist::find($request->artists);
        $albums = Album::find($request->albums);
        $track->albums()->saveMany($albums);
        $track->artists()->saveMany($artists);
        return ['status' => 'success'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        return [
            'id' => $track->id,
            'title' => $track->title,
            'artists' => $track->artists
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        $albums = Album::all();
        $artists = Artist::all();
        return view('track/edit', ['albums' => $albums, 'artists' => $artists, 'track' => $track]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        $track->title = $request->title;
        $albums = Album::find($request->albums);
        $track->albums()->detach();
        $track->albums()->saveMany($albums);
        $artists = Artist::find($request->artists);
        $track->artists()->detach();
        $track->artists()->saveMany($artists);
        $track->save();
        return ['status' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        Storage::delete($track->path);
        $track->artists()->detach();
        $track->delete();
        return ['status' => 'success'];
    }

    // Additional functions.

    /**
     * Gets the audio file for the requested track.
     *
     * @param  \App\Track $track
     * @return \Illuminate\Http\Response
     */
    public function audio(Track $track)
    {
        return response()->file(storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$track->path);
    }

    public function queue()
    {
        $tracks = Track::all();
        return ['tracks' => $tracks];
    }
}
