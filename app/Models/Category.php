<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'categoryName',
        'categoryType',
        'user_id',

    ];

    public function user()
    {

        return $this->belongsTo(Expense::class);
    }

    public function expense()
    {

        return $this->belongsTo(Expense::class);
    }

    public function income()
    {

        return $this->belongsTo(Income::class);
    }
}
