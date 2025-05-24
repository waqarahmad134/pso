<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_type',
        'stock_item_id',
        'supplier_id',
        'quantity',
        'sale_price',
        'total_amount',
        'paid_amount',
        'remaining_amount',
    ];
    
    
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
    public function stockItem()
    {
        return $this->morphTo(null, 'stock_type', 'stock_item_id');
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class, 'stock_item_id');
    }

    public function mobilOil()
    {
        return $this->belongsTo(MobilOil::class, 'stock_item_id');
    }
}
