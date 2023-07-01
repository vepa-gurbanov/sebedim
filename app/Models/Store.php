<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id',
        'warehouse_id',
    ];


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
