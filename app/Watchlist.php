<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $guarded = [];

    protected $casts = [
        'book_ids' => 'array'
    ];
    
    public function user() {

        return $this->belongsTo(User::class);
    }

    public function book() {

        return $this->hasMany(Book::class);
    }
}
