@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4">
  <h1 class="text-3xl font-bold text-green-700 mb-8">Admin Dashboard</h1>

  <!-- Date Filter -->
  <form method="GET" class="flex flex-col sm:flex-row flex-wrap gap-4 mb-8">
    <div>
      <label class="block text-sm mb-1 text-gray-700">Start Date:</label>
      <input type="date" name="start_date" value="{{ $startDate }}" class="border rounded px-3 py-2 w-full">
    </div>
    <div>
      <label class="block text-sm mb-1 text-gray-700">End Date:</label>
      <input type="date" name="end_date" value="{{ $endDate }}" class="border rounded px-3 py-2 w-full">
    </div>
    <div class="self-end">
      <button class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">Filter</button>
    </div>
  </form>

  <!-- Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    @foreach ([ 
      ['title' => 'New Subscriptions', 'value' => $newSubscriptions],
      ['title' => 'MRR', 'value' => 'Rp' . number_format($mrr)],
      ['title' => 'Reactivations', 'value' => $reactivations],
      ['title' => 'Subscription Growth', 'value' => $subscriptionGrowth],
    ] as $metric)
      <div class="bg-white p-6 rounded-xl shadow flex flex-col items-center">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $metric['title'] }}</h2>
        <p class="text-3xl font-bold text-green-700">{{ $metric['value'] }}</p>
      </div>
    @endforeach
  </div>

  <!-- Chart -->
  <div class="bg-white p-6 rounded-xl shadow mb-12">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Subscriptions Over Time</h2>
    <div class="w-full overflow-x-auto">
      <canvas id="subscriptionsChart" class="max-h-[300px]"></canvas>
    </div>
  </div>

  <!-- Users Management -->
  <h2 class="text-2xl font-bold mb-4 text-gray-800">Manage Users</h2>
  <div class="overflow-x-auto bg-white rounded-xl shadow">
    <table class="min-w-full text-left text-sm">
      <thead class="bg-green-100">
        <tr>
          <th class="px-4 py-3 font-medium">Name</th>
          <th class="px-4 py-3 font-medium">Email</th>
          <th class="px-4 py-3 font-medium">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-3">{{ $user->name }}</td>
            <td class="px-4 py-3 break-all">{{ $user->email }}</td>
            <td class="px-4 py-3 flex flex-wrap gap-3">
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('subscriptionsChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode($chartLabels) !!},
      datasets: [{
        label: 'New Subscriptions',
        data: {!! json_encode($chartData) !!},
        fill: true,
        backgroundColor: 'rgba(34,197,94,0.1)',
        borderColor: '#22c55e',
        borderWidth: 2,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: { grid: { display: false }},
        y: { grid: { display: true }}
      },
      plugins: {
        legend: { display: false }
      }
    }
  });
</script>
@endsection
