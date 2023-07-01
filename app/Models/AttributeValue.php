<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'attribute_id',
    ];

    public $timestamps = false;


    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_values')
            ->orderBy('id', 'desc');
    }


    public function values()
    {
        return $this->hasMany(AttributeValue::class)
            ->orderBy('order_by');
    }
}
