<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function albums()
    {
        return $this->belongsToMany('App\Album');
    }

    public function tracks()
    {
        return $this->belongsToMany('App\Track');
    }
}
