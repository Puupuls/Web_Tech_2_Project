<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = [
        'name', 'tracker_id'
    ];
    protected $table = 'expense_categories';
    public function tracker(){
        return $this->belongsTo('tracker');
    }
}
