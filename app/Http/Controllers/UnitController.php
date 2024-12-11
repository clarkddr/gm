<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Inertia\Inertia;
class UnitController extends Controller
{
    public function index(){

        $data = [
          'units' => Unit::paginate(15)
        ];
        return Inertia::render('Unit/Index', $data);
    }
}
