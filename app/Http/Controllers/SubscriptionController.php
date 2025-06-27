<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
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
        return view('subscription.create');
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

        // Harga per meal
        $prices = [
            'diet' => 30000,
            'protein' => 40000,
            'royal' => 60000,
        ];

        $plan = $request->plan;
        $mealCount = count($request->meal_types);
        $dayCount = count($request->days);
        $unitPrice = $prices[$plan] ?? 0;

        $total = $unitPrice * $mealCount * $dayCount * 4.3;

        Subscription::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'plan' => $plan,
            'meal_types' => json_encode($request->meal_types),
            'days' => json_encode($request->days),
            'allergies' => $request->allergies,
            'total_price' => $total,
        ]);

        return redirect()->route('subscription.index')->with('success', 'Subscription berhasil dibuat!');
    }
}
