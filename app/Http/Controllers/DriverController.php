<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Laratrust\LaratrustFacade;

class DriverController extends Controller
{
    public function index()
    {
        abort_unless(LaratrustFacade::can('read-drivers'), 403);
        $drivers = User::getDrivers();

        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        abort_unless(LaratrustFacade::can('create-drivers'), 403);

        return view('drivers.create');
    }

    public function store(RegisterRequest $request)
    {
        abort_unless(LaratrustFacade::can('create-drivers'), 403);
        $driver = User::create($request->all());
        $driver->roles()->sync(2);

        return redirect()->route('driver.edit', $driver);
    }

    public function edit(User $driver)
    {
        abort_unless(LaratrustFacade::can('update-drivers'), 403);
        $driver = User::with(['car.type', 'car.status'])->find($driver->id);
        $cars = Car::getFreeCars()->get();

        return view('drivers.edit', compact('driver', 'cars'));
    }

    public function update(Request $request, User $driver)
    {
        abort_unless(LaratrustFacade::can('update-drivers'), 403);
        $driver->changeCar($driver, $request->car_id);

        return back();
    }

    public function destroy(User $driver)
    {
        abort_unless(LaratrustFacade::can('delete-drivers'), 403);
        $driver->dissociateCar($driver);
        $driver->delete();

        return back();

    }
}
