<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Ref extends Model
{
   
    use Commentable;
    protected $guarded = [];
    
    public function user() {

        return $this->belongsTo(User::class);
    }

    public function book() {

        return $this->belongsTo(Book::class);
    }
}
