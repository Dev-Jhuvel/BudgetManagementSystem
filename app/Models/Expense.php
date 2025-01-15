<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'expenseTitle',
        'expenseDescription',
        'expenseAmount',
        'expenseOldSum',
        'expenseNewSum',
        'balance',
        'expenseCategory',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
