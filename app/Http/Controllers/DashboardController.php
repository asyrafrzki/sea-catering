<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class DashboardController extends Controller
{
 public function index()
{
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    // User biasa
    $subscriptions = Subscription::where('user_id', auth()->id())->get();
    return view('dashboard.index', compact('subscriptions'));
}


    public function pause(Subscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        $subscription->status = 'paused';
        $subscription->save();

        $subscription->logs()->create([
            'action' => 'pause',
        ]);

        return back()->with('success', 'Subscription paused successfully.');
    }

    public function resume(Subscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        $subscription->status = 'active';
        $subscription->save();

        // Catat log reaktivasi
        $subscription->logs()->create([
            'action' => 'resume',
        ]);

        return back()->with('success', 'Subscription resumed successfully.');
    }

    public function cancel(Subscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        $subscription->status = 'cancelled';
        $subscription->save();

        $subscription->logs()->create([
            'action' => 'cancel',
        ]);

        return back()->with('success', 'Subscription cancelled successfully.');
    }
}
