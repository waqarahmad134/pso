<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ShiftData extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'shift_date',
        'shift_type',
        'cashier_id',
        'dip_petrol_id',
        'dip_diesel_id',
        'petrol_price',
        'diesel_price',
        'cash_in_hand',
        'bank_online',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function dipPetrol()
    {
        return $this->belongsTo(Dip::class, 'dip_petrol_id');
    }

    public function dipDiesel()
    {
        return $this->belongsTo(Dip::class, 'dip_diesel_id');
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'shift_data_id');
    }

    public function expenseHistories()
    {
        return $this->hasMany(ExpenseHistory::class, 'shift_data_id');
    }
}
