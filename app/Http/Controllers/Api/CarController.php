<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\CarStatuses;
use App\Models\CarType;
use App\Models\User;
use Illuminate\Http\Request;
use Laratrust\LaratrustFacade;

class CarController extends Controller
{
    public function index()
    {
        abort_unless(LaratrustFacade::can('read-cars'), 403);
        $cars = Car::with(['driver', 'type', 'status'])->get();

        return CarResource::collection($cars);
    }

    public function create()
    {
        abort_unless(LaratrustFacade::can('create-cars'), 403);
        $types = CarType::all();
        $statuses = CarStatuses::all();
        $drivers = User::freeDriver()->get();

        return compact('types', 'statuses', 'drivers');
    }

    public function store(CarRequest $request)
    {
        abort_unless(LaratrustFacade::can('create-cars'), 403);
        $car = Car::create($request->all());

        return response(['message' => 'Добавлен новый транспорт', 'id' => $car->id]);

    }

    public function edit(Car $car)
    {
        abort_unless(LaratrustFacade::can('update-cars'), 403);
        $car = Car::with(['driver', 'type', 'status'])->find($car->id);
        $types = CarType::all();
        $statuses = CarStatuses::all();
        $drivers = User::freeDriver()->get();

        return compact('car', 'types', 'statuses', 'drivers');
    }

    public function update(Request $request, Car $car)
    {
        abort_unless(LaratrustFacade::can('update-cars'), 403);
        $car->update($request->all());

        return response(['message' => 'Данные успешно обновлены']);
    }

    public function destroy(Car $car)
    {
        abort_unless(LaratrustFacade::can('delete-cars'), 403);
        $car->delete();

        return response(['message' => 'Вы удалили '.$car->name]);
    }
}
