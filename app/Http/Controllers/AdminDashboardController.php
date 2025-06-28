<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionLog;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))
            : now()->startOfMonth();

        $endDate = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))
            : now()->endOfMonth();

        $newSubscriptions = Subscription::whereBetween('created_at', [$startDate, $endDate])->count();

        $mrr = Subscription::where('status', 'active')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_price');

        // ✅ Ambil dari logs
        $reactivations = SubscriptionLog::where('action', 'resume')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $subscriptionGrowth = Subscription::where('status', 'active')->count();

        return view('admin.dashboard', [
            'startDate' => $startDate->toDateString(),
            'endDate' => $endDate->toDateString(),
            'newSubscriptions' => $newSubscriptions,
            'mrr' => $mrr,
            'reactivations' => $reactivations,
            'subscriptionGrowth' => $subscriptionGrowth,
        ]);
    }
}
