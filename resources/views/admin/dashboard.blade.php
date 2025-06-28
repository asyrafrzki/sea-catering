@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
  <h1 class="text-3xl font-bold text-green-700 mb-8">Admin Dashboard</h1>

  <!-- Date Range Filter -->
  <form method="GET" class="flex flex-wrap items-end gap-4 mb-8">
    <div>
      <label class="block text-sm text-gray-700 mb-1">Start Date:</label>
      <input type="date" name="start_date" value="{{ $startDate }}" class="border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm text-gray-700 mb-1">End Date:</label>
      <input type="date" name="end_date" value="{{ $endDate }}" class="border rounded px-3 py-2">
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Filter</button>
  </form>

  <!-- Metrics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">New Subscriptions</h2>
      <p class="text-3xl font-bold text-green-700">{{ $newSubscriptions }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">MRR</h2>
      <p class="text-3xl font-bold text-green-700">Rp{{ number_format($mrr) }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">Reactivations</h2>
      <p class="text-3xl font-bold text-green-700">{{ $reactivations }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">Subscription Growth</h2>
      <p class="text-3xl font-bold text-green-700">{{ $subscriptionGrowth }}</p>
    </div>
  </div>
</div>
@endsection
