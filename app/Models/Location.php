<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id',
        'parent_id',
    ];


    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('name');
    }

    public function children()
    {
        return $this->child()->with('children')
            ->orderBy('name');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_locations')
            ->orderBy('location_id', 'desc')
            ->orderBy('warehouse_id', 'desc')
            ->orderBy('store_id', 'desc')
            ->orderBy('product_id', 'desc');
    }
}
