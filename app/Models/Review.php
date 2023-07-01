<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $dates = [
        'created_at',
    ];

    protected $guarded = [
        'id',
        'customer_id',
        'product_id',
    ];


//    protected static function booted()
//    {
//        static::saving(function ($obj) {
//            $obj->customer_id = auth('customer_web')->check()
//                ? auth('customer_web')->id
//                : null;
//        });
//    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
