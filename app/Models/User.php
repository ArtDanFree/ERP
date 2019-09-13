<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeGetFreeDriver(Builder $builder)
    {
        return $builder->doesntHave('car')->orderByDesc('id')->whereRoleIs('driver')->get();
    }

    public function scopeGetDrivers(Builder $builder)
    {
        return $builder->with(['car.type', 'car.status'])->orderByDesc('id')->whereRoleIs('driver')->get();
    }

    public function car()
    {
        return $this->hasOne(Car::class, 'driver_id');
    }

    public function changeCar(User $driver,  $id = null)
    {
        // удаление машины
        if (filled($driver->car)) {
            $driver->car->driver()->dissociate()->save();
        }
        // присвоение машины
        if (filled($id)) {
            $car = Car::find($id);
            $driver->car()->save($car);
        }
    }
}
