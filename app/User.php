<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function trackers(){
        return $this->hasMany('App\Tracker', 'owner_id');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

    public function participates(){
        return $this->hasMany('App\Participant');
    }

    public function last_tracker(){
        return $this->belongsTo('App\Tracker', 'last_tracker_id');
    }

    public function can_edit_tracker($tracker){
        return count(Participant::where('tracker_id', $tracker->id)->where('user_id', auth()->user()->id)->where('permissions', '>', 0)->get()) || $tracker->owner_id == auth()->user()->id;
    }
}
