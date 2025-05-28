<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ShiftReading extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'shift_data_id',
        'machine_id',
        'mobil_id',
        'last_reading',
        'today_reading',
        'litres',
        'amount',
    ];

    public function shiftData()
    {
        return $this->belongsTo(ShiftData::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function mobil()
    {
        return $this->belongsTo(MobilOil::class, 'mobil_id');
    }
}
