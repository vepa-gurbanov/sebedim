<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];


    protected static function booted()
    {
        static::saving(function ($obj) {
            $obj->slug = str($obj->name)->slug('_');
        });
    }


    public function products()
    {
        return $this->hasMany(Product::class)
            ->orderBy('id', 'desc');
    }
}
