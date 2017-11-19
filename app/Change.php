<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $fillable = ['source_id', 'target_id', 'state'];

    public function source() {
        return $this->belongsTo('App\User', 'source_id');
    }

    public function target() {
        return $this->belongsTo('App\User', 'target_id');
    }
}
