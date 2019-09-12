<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name', 'status_id', 'type_id', 'driver_id'
    ];

    public function driver()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(CarType::class);
    }

    public function status()
    {
        return $this->belongsTo(CarStatuses::class);
    }

}
