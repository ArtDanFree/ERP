<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __invoke()
    {
        $user = User::with(['car.type', 'car.status', 'roles'])->find(auth()->user()->id);

        return $user;
    }
}
