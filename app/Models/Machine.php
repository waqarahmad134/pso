<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'fuel_type_id', 'status'];

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }
}
