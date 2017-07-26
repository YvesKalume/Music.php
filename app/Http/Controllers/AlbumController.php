<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Track;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
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
        $albums = Album::all();
        $albums->load('artist');
        return $albums;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::all();
        return view('album/create', ['artists' => $artists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('quicksave'))
        {
            $album = Album::create(['name' => $request->name]);
        }
        else
        {
            $path = $request->file->store('albums');
            $album = Album::create([
                'name' => $request->name,
                'path' => $path,
                'artist_id' => $request->artist
            ]);
            return ['status' => 'success'];
        }
        return ['status' => 'success', 'id' => $album->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $album->load('artist');
        $album->load('tracks');
        $album->tracks->load('artists');
        return $album;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $tracks = Track::all();
        $artists = Artist::all();
        return view('album/edit', ['album' => $album, 'artists' => $artists, 'tracks' => $tracks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        if ($request->hasFile('file')) {
            Log::info('File detected. Updating album artwork...');
            if (Storage::disk('local')->exists($album->path)) {
                Log::info('Old file detected. Deleting old artwork...');
                Storage::delete($album->path);
            }
            $path = $request->file->store('albums');
            $album->path = $path;
        }
        Log::info('Updating artist information...');
        $album->name = $request->name;
        $album->artist_id = $request->artist;
        $album->save();

        return ['status' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        Storage::delete($album->path);
        $album->tracks()->detach();
        $album->delete();
        return ['status' => 'OK'];
    }

    // Additional functions.

    /**
     * Gets the image file for the requested album.
     *
     * @param  \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function image(Album $album)
    {
        if (Storage::disk('local')->exists($album->path))
        {
            $size = Storage::size($album->path);
            return response(Storage::get($album->path))->withHeaders([
                'Content-Disposition' => 'filename=image.jpeg',
                'Content-Length' => $size,
                'Content-Type' => 'image/jpeg'
            ]);
        } else
        {
            return redirect('/img/noalbum.svg');
        }
    }

    public function getTracks(Album $album)
    {

    }
}
