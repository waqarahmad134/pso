<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilOil extends Model
{
    use HasFactory;
    protected $table = 'mobil_oils';
    protected $fillable = [
        'name',
        'saleprice',
        'inventory',
    ];

    public function stocks()
    {
        return $this->morphMany(Stock::class, 'stockItem');
    }
}
