<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $dates = [
        'created_at' => 'datetime',
        'date' => 'date',
    ];

    protected $guarded = [
        'id',
        'warehouse_id',
        'store_id',
        'product_id',
    ];


    protected static function booted()
    {
        static::saving(function ($obj) {
            $obj->date = today();
            $obj->quantity = $obj->product->quantity;
        });
    }


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }


    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
