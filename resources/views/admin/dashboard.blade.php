@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4">
  <h1 class="text-3xl font-bold text-green-700 mb-8">Admin Dashboard</h1>

  <!-- Date Range Filter -->
  <form method="GET" class="flex flex-wrap gap-4 mb-8">
    <div>
      <label class="block text-sm mb-1">Start Date:</label>
      <input type="date" name="start_date" value="{{ $startDate }}" class="border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">End Date:</label>
      <input type="date" name="end_date" value="{{ $endDate }}" class="border rounded px-3 py-2">
    </div>
    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Filter</button>
  </form>

  <!-- Metrics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-lg font-semibold mb-1">New Subscriptions</h2>
      <p class="text-2xl font-bold text-green-700">{{ $newSubscriptions }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-lg font-semibold mb-1">MRR</h2>
      <p class="text-2xl font-bold text-green-700">Rp{{ number_format($mrr) }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-lg font-semibold mb-1">Reactivations</h2>
      <p class="text-2xl font-bold text-green-700">{{ $reactivations }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-lg font-semibold mb-1">Subscription Growth</h2>
      <p class="text-2xl font-bold text-green-700">{{ $subscriptionGrowth }}</p>
    </div>
  </div>

  <!-- Chart -->
  <div class="bg-white p-6 rounded-lg shadow mb-12">
    <canvas id="subscriptionsChart"></canvas>
  </div>

  <!-- Users Management -->
  <h2 class="text-2xl font-bold mb-4">Manage Users</h2>
  <div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full text-left">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $user->name }}</td>
          <td class="px-4 py-2">{{ $user->email }}</td>
          <td class="px-4 py-2 flex gap-4">
            <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Delete user?')">
              @csrf @method('DELETE')
              <button class="text-red-600 hover:underline">Delete</button>
            </form>
            <a href="{{ route('admin.users.subscriptions', $user) }}" class="text-blue-600 hover:underline">View Subscriptions</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('subscriptionsChart').getContext('2d');
  const subscriptionsChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode($chartLabels) !!},
      datasets: [{
        label: 'New Subscriptions',
        data: {!! json_encode($chartData) !!},
        fill: true,
        backgroundColor: 'rgba(34,197,94,0.2)',
        borderColor: '#22c55e',
        tension: 0.3
      }]
    }
  });
</script>
@endsection
