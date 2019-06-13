<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    protected $fillable = ['link', 'slug', 'deletepasswd'];

    protected $hidden = ['deletepasswd'];

    public function reports() {
        return $this->hasMany('App\Report');
    }
}
