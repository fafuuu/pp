<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = [
        'title', 'isbn', 'thumbnail'
    ];

    /*
    public function getRouteKeyName() {
        
        return 'isbn';

    }
    */

    public function refs() {

        return $this->hasMany(Ref::class);
    }

}
