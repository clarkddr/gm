<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Route;
use App\Models\Toll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Unit;
use App\Models\GasPrice;


class BudgetController extends Controller
{
    public function index()
    {
        // Obtenemos los presupuestos paginados con su relación 'user'
        $paginatedBudgets = Budget::with('user')->paginate(10);

        // Transformamos solo los elementos de la colección
        $transformedBudgets = $paginatedBudgets->getCollection()->transform(function ($budget) {
            if($budget->type == 'oneway'){ $budget->type = 'Sencillo'; }
            if($budget->type == 'roundtrip'){ $budget->type = 'Redondo'; }
            return [
                'id' => $budget->id,
                'type' => $budget->type,
                'departure' => Carbon::parse($budget->departure)->format('d/m/Y H:i A'),
                'return' => Carbon::parse($budget->return)->format('d/m/Y H:i A'),
                'passengers' => $budget->passengers,
                'user_id' => $budget->user_id ?? null,
                'user_name' => $budget->user->name ?? 'N/A',
            ];
        });

        // Reemplazamos la colección transformada en el paginador
        $paginatedBudgets->setCollection($transformedBudgets);

        // Pasamos los datos transformados a Inertia
        return Inertia::render('Budget/Index', [
            'budgets' => $paginatedBudgets,
        ]);
    }

    public function preview(){

        $routes = Route::all();
        $units = Unit::all();
        $gasprices = GasPrice::all();

        $data = [
            'routes' => $routes,
            'units' => $units,
            'gasprices' => $gasprices,
        ];
        return Inertia::render('Budget/Preview',$data);
    }

    public function create(Request $request)
    {
        $rules = [
            'type' => 'required|in:oneway,roundtrip',
            'departure_route' => 'required|exists:routes,id',
            'departure' => 'required|date',
            'passengers' => 'required|integer|min:1',
            'unit' => 'required|exists:units,id',
            'gasprice' => 'required|exists:gas_prices,id',
        ];

        if ($request->input('type') === 'roundtrip') {
            $rules['return_route'] = 'required|exists:routes,id';
            $rules['return'] = 'required|date|after:departure';
        }

        $validated = $request->validate($rules);




        // Se reciben los valores y se buscan en BD
        $type = $request->input('type');
        $gas = GasPrice::find($request->input('gasprice'));
        $unit = Unit::find($request->input('unit'));
        $passengers = $request->input('passengers');
        $departure_date = $request->input('departure');
        $minimum_wage = 374.89;

        // Costo de combustible, viaticos y peajes inicia en 0
        $gas_cost = 0;
        $allowance_cost = 0;
        $tolls_cost = 0;

        // Se calcula la cantidad de unidades necesarias
        $unit_capacity = $unit->passenger_capacity;
        $units_needed = ceil($passengers / $unit_capacity);



        // Se revisa si existe un viaje de vuelta
        if($type == 'roundtrip'){
            $type = 'Redondo';
            $return_date = $request->input('return');
            // Se obtiene las carreteras y datos del viaje de vuelta
            $return_date = $request->input('return');
            $return_route = Route::find($request->input('return_route'));
            $return_roads = $return_route->roads;
            $return_tolls = $return_route->tolls;
            // Se agrega el gasto de gasolina y viaticos por el viaje de vuelta
            $gas_cost += $return_route->return_distance /3 * $gas->price * $units_needed;
            $allowance_cost += $units_needed * $minimum_wage;
        } elseif ($type == 'oneway') {
            $type = 'Sencillo';
        }

        // Se obtiene las carreteras y datos del viaje de ida
        $departure_date = $request->input('departure');
        $departure_route = Route::with(['roads.toll.units' => function ($query) use($unit) {
            $query->where('units.id', $unit->id);
        }])->find($request->input('departure_route'));

        // Calcular el total de los precios de casetas de ida
        $totalDepartureTollsPrice = $departure_route->roads->reduce(function ($total, $road) {
            $price = $road->toll && $road->toll->units->first() ? $road->toll->units->first()->pivot->price : 0;
            return $total + $price;
        }, 0);

//    dd($departure_route);


        // Se agrega el gasto de gasolina por el viaje de ida y se obtiene costo de combustible total
        $gas_cost += $departure_route->departure_distance /3 * $gas->price * $units_needed;
        // Se agrega el costo de los viaticos
        $allowance_cost += $units_needed * $minimum_wage * 6;
        // Se agrega a los peajes el total del viaje de ida
        $tolls_cost += $totalDepartureTollsPrice;


        $data = [
            'type' => $type,
            'gas_name' => $gas->name,
            'gas_price' => number_format($gas->price,2),
            'departure_date' => $departure_date,
            'return_date' => $return_date ?? null,
            'passengers' => $passengers,
            'unit_name' => $unit->name,
            'units_needed' => $units_needed,
            'unit_capacity' => $unit_capacity,
            'departure_route' => $departure_route,
            'total_departure_toll_cost' => number_format($totalDepartureTollsPrice,2),
            'return_route' => $return_route ?? null,

            'total_gas_cost' => number_format($gas_cost,2),
            'total_allowance_cost' => number_format($allowance_cost,2),
            'total_tolls_cost' => number_format($tolls_cost,2),
            'total_cost' => number_format($gas_cost+$allowance_cost+$tolls_cost,2)
        ];
//        dd($data);

        return Inertia::render('Budget/Create',['data' => $data]);







    }

}
