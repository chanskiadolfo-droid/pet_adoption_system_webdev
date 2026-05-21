<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\AdoptionRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pets' => Pet::count(),
            'available' => Pet::where('status', 'available')->count(),
            'adopted' => Pet::where('status', 'adopted')->count(),
            'requests' => AdoptionRequest::count(),
            'users' => User::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
