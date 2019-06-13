<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['short_link_id', 'reason'];

    public function short_link() {
        return $this->belongsTo('App\ShortLink');
    }
}
