<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable = [
        'name', 'owner_id'
    ];
    protected $table = 'trackers';

    public function owner(){
        return $this->belongsTo('App\User', 'owner_id');
    }
    public function expense_categories(){
        return $this->hasMany('App\ExpenseCategory');
    }
    public function income_sources(){
        return $this->hasMany('App\IncomeSources');
    }
    public function participants(){
        return $this->hasMany('App\Participant');
    }
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
