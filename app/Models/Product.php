<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'store_id',
        'brand_id',
        'category_id',
    ];

    protected $casts = [
        'discount_start' => 'datetime',
        'discount_end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


//    protected static function booted()
//    {
//        static::saving(function ($obj) {
//            $obj->slug = str($obj->full_name)->slug('_');
////            $obj->upc_code =  strval(date_format($obj->created_at, 'ymd') . $obj->id);
//        });
//    }


    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values')
            ->orderByPivot('order_by');
    }


    public function isNew()
    {
        if ($this->created_at >= now()->subMonth()) {
            return true;
        } else {
            return false;
        }
    }


    public function isDiscount()
    {
        if ($this->discount_percent > 0 and $this->discount_start <= now() and $this->discount_end >= now()) {
            return true;
        } else {
            return false;
        }
    }


    public function image()
    {
        return $this->image
            ? Storage::url('products/' . $this->image)
            : asset('img/product.jpg');
    }


    public function locations()
    {
        return $this->belongsToMany(Location::class, 'product_locations')
            ->orderByPivot('location_id', 'desc')
            ->orderByPivot('product_id', 'desc');
    }
}
