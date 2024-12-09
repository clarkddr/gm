<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

    public function create(){
        return Inertia::render('Budget/Create');
    }

}
