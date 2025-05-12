<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'last_reading',
        'fuel_id',
        'fuel_type_id',
        'status',
    ];

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }
}
