<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function index()
    {
        $plans = MealPlan::all();
        return view('plans.index', compact('plans'));
    }

public function show($id)
{
    abort_unless(request()->ajax(), 404); // Cegah akses langsung
    $plan = MealPlan::findOrFail($id);
return view('plans.partials.modal', compact('plan'));

}


}
