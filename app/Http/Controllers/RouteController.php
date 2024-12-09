<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RouteController extends Controller
{
    public function index(){

        $data = [
            'routes' => Route::with(['roads.toll'])->paginate(10)
        ];
        return Inertia::render('Route/Index',$data);
    }
}
