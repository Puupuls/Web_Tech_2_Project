<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount', 'image_uuid', 'expense_category_id', 'tracker_id', 'added_by_user_id', 'income_source_id', 'is_income', 'description'
    ];
    public function added_by(){
        return $this->belongsTo('App\User', 'added_by_user_id');
    }
    public function income_source(){
        return $this->belongsTo('App\IncomeSource');
    }
    public function expense_category(){
        return $this->belongsTo('App\ExpenseCategory');
    }
    public function tracker(){
        return $this->belongsTo('App\Tracker');
    }
}
