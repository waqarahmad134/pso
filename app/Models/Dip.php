<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'price',
        'liters',
        'status',
        'fuel_id',
    ];

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function shiftPetrol()
    {
        return $this->hasMany(ShiftData::class, 'dip_petrol_id');
    }

    public function shiftDiesel()
    {
        return $this->hasMany(ShiftData::class, 'dip_diesel_id');
    }

}
