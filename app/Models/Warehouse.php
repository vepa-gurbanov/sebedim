<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id',
        'location_id',
    ];


    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    public function stores()
    {
        return $this->hasMany(Store::class)
            ->orderBy('name');
    }
}
