<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Setting;
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
        $tracks = Track::all();
        $tracks->load('artists');
        $tracks->load('albums');
        return $tracks;
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
        $track->load('albums');
        $track->load('artists');
        return $track;
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
        return ['status' => 'OK'];
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
        $ffmpeg = config('app.ffmpeg');
        abort_unless(is_executable($ffmpeg), 500, 'Please make sure that ffmpeg is configured correctly.');

        $format = Setting::firstOrCreate(['id' => 'format'], ['value' => 'ogg'])->value;
        $bitrate = Setting::firstOrCreate(['id' => 'bitrate'], ['value' => 128])->value;


        $args = [
            '-i '.escapeshellarg(storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$track->path),
            '-map 0:0',
            '-v 0',
            "-ab {$bitrate}k",
            "-f {$format}",
            '-'
        ];

        header('Content-Type: audio/'.$format);
        header('Content-Disposition: attachment; filename="'.basename($track->path).'"');

        passthru("$ffmpeg ".implode($args, ' '));

        // return response()->file(storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$track->path);
    }

    public function queue()
    {
        $tracks = Track::all();
        return ['tracks' => $tracks];
    }
}
