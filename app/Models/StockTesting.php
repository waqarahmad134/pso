<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTesting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'fuel_id',
        'machine_id',
        'litres',
        'adjustment',
    ];

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
