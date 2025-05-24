<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'fuel_type_id', 'status', 'price', 'description', 'liters'];

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
    public function stocks()
    {
        return $this->morphMany(Stock::class, 'stockItem');
    }
    public function dips()
    {
        return $this->hasMany(Dip::class);
    }

    public function wastages()
    {
        return $this->hasMany(StockWastage::class);
    }
    
}
