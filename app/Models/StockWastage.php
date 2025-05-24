<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockWastage extends Model
{
    use HasFactory;
    protected $fillable = ['fuel_id', 'litres'];

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }
}
