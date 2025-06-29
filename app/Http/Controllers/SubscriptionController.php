<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\MealPlan;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('user_id', Auth::id())->get();
        return view('subscription.index', compact('subscriptions'));
    }
    public function create()
    {
        $plans = MealPlan::all(); // Ambil semua meal plan dari DB
        return view('subscription.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'plan' => 'required|string',
            'meal_types' => 'required|array|min:1',
            'days' => 'required|array|min:1',
            'allergies' => 'nullable|string',
        ]);

        // Cari MealPlan berdasarkan name 
        $mealPlan = MealPlan::where('name', $request->plan)->first();

        // Jika meal plan tidak ditemukan
        if (!$mealPlan) {
            return back()->withErrors(['plan' => 'Plan tidak valid.'])->withInput();
        }

        // Hitung total
        $mealCount = count($request->meal_types);
        $dayCount = count($request->days);
        $unitPrice = $mealPlan->price;

        $total = $unitPrice * $mealCount * $dayCount * 4.3;

        // Simpan ke database
        Subscription::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'plan' => $mealPlan->name,
            'meal_types' => json_encode($request->meal_types),
            'days' => json_encode($request->days),
            'allergies' => $request->allergies,
            'total_price' => $total,
        ]);

        return redirect()->route('subscription.index')->with('success', 'Subscription berhasil dibuat!');
    }
}
