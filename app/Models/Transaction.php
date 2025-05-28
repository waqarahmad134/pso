<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'shift_data_id',
        'transaction_type',           // debit or credit
        'payment_mode',   // cash or online
        'amount',
        'description',
        'transaction_date',
    ];

    protected $dates = ['transaction_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shiftData()
    {
        return $this->belongsTo(ShiftData::class, 'shift_data_id');
    }
    
}
