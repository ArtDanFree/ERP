<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $car = $this->resource;

        return [
            'id' => $car->id,
            'name' => $car->name,
            'driver_name' => $car->driver ? $car->driver->name : 'Нет водителя',
            'type' => $car->type->name,
            'status' => $car->status->name,
        ];
    }
}
