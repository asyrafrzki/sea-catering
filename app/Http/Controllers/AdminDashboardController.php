<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : now()->endOfMonth();

        $newSubscriptions = Subscription::whereBetween('created_at', [$startDate, $endDate])->count();
        $mrr = Subscription::where('status', 'active')->whereBetween('created_at', [$startDate, $endDate])->sum('total_price');
        $reactivations = SubscriptionLog::where('action', 'resume')->whereBetween('created_at', [$startDate, $endDate])->count();
        $subscriptionGrowth = Subscription::where('status', 'active')->count();

        // For chart: example last 6 months new subs
        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M Y');
            $count = Subscription::whereMonth('created_at', now()->subMonths($i)->month)
                ->whereYear('created_at', now()->subMonths($i)->year)
                ->count();
            $chartLabels[] = $month;
            $chartData[] = $count;
        }

        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.dashboard', [
            'startDate' => $startDate->toDateString(),
            'endDate' => $endDate->toDateString(),
            'newSubscriptions' => $newSubscriptions,
            'mrr' => $mrr,
            'reactivations' => $reactivations,
            'subscriptionGrowth' => $subscriptionGrowth,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'users' => $users
        ]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function viewUserSubscriptions(User $user)
    {
        $subscriptions = Subscription::where('user_id', $user->id)->get();
        return view('admin.user_subscriptions', compact('user', 'subscriptions'));
    }
}
