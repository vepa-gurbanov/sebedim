<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'category_id',
    ];

    public $timestamps = false;


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function values()
    {
        return $this->hasMany(AttributeValue::class)
            ->orderBy('order_by');
    }
}
