<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model
{
    protected $fillable = [
        'name', 'tracker_id'
    ];
    protected $table = 'income_sources';
    public function tracker(){
        return $this->belongsTo('App\Tracker');
    }
}
