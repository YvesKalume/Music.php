<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    //
    protected $fillable = [
        'title', 'path',
    ];

    public function artists()
    {
        return $this->belongsToMany('App\Artist');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }
}
