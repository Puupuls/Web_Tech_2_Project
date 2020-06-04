<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'user_id', 'tracker_id',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function tracker(){
        return $this->belongsTo('App\Tracker');
    }
}
