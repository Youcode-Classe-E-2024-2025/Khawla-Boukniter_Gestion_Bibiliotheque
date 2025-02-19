<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function checkAdmin()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403, 'Vous n\'avez pas les autorisations nécessaires.');
        }
    }
}
