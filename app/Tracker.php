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
        return $this->hasMany('App\IncomeSource');
    }
    public function participants(){
        return $this->hasMany('App\Participant');
    }
    public function is_participant(User $user){
        if($user) {
            foreach ($this->participants as $part) {
                if ($part->user_id == $user->id) return true;
            }
        }
        return false;
    }
    public function transactions(){
        return $this->hasMany('App\Transaction')->orderBy('created_at', 'desc');
    }
}
