<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id', 'parent_id'];


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


    public function attributes()
    {
        return $this->hasMany(Attribute::class)
            ->orderBy('id', 'desc');
    }


    public function image()
    {
        return $this->image
            ? Storage::url('categories/' . $this->image)
            : asset('img/category.jpg');
    }

    //

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

    public function top() {
        return $this->child()->orderByDesc('id')->take(10);
    }
}
