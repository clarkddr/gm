<?php

namespace App\Http\Controllers;

use App\Models\GasPrice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GasPriceController extends Controller
{
    public function index(){

        $data = [
            'gasprices' => GasPrice::paginate(10)
        ];
        return Inertia::render('GasPrice/Index',$data);
    }
}
