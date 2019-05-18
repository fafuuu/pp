<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist_entry extends Model
{

    protected $guarded = [];

    public function watchlist() {
        return $this->belongsTo(Watchlist::class);
    }

    public function book() {
        return $this->hasOne(Book::class);
    }
}

