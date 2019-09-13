<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeGetFreeCars(Builder $builder)
    {
        return $builder->doesntHave('driver')->orderByDesc('id');
    }

    public function changeDriver(Car $car,  $id = null)
    {
        // удаление водителя
        if (filled($car->driver)) {
            $car->driver()->dissociate()->save();
        }
        // присвоение водителя
        if (filled($id)) {
            $driver = User::find($id);
            $car->driver()->associate($driver);
        }
    }

}
