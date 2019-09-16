<?php

namespace App\Http\Controllers;

use App\Models\Car;

class IndexController extends Controller
{
    public function __invoke()
    {
        $cars = Car::all();

        return view('index', compact('cars'));
    }
}
