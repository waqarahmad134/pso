<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'fuel_type_id', 'status'];

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
