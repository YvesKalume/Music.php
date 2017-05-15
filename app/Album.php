<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name'
    ];

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function tracks()
    {
        return $this->belongsToMany('App\Track');
    }
}
