<?php

namespace App\Http\Controllers;

use App\Models\Toll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TollController extends Controller
{
    public function index(){

        $data = [
            'tolls' => Toll::paginate(10)
        ];
        return Inertia::render('Toll/Index',$data);
    }
}
