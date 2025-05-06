<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilOil extends Model
{
    use HasFactory;

    // Optional: Define the table explicitly if needed
    protected $table = 'mobil_oils';

    // Optional: Mass assignable fields
    protected $fillable = [
        'name',
        'saleprice',
        'inventory',
    ];
}
