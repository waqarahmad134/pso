<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExpenseHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'expense_name',
        'amount',
        'details',
        'user_id',
        'shift_data_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shiftData()
    {
        return $this->belongsTo(ShiftData::class, 'shift_data_id');
    }
}
