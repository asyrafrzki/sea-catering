@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-green-700">Subscriptions of {{ $user->name }}</h1>
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
      ← Back to Dashboard
    </a>
  </div>

  <div class="bg-white shadow rounded-xl overflow-x-auto">
    <table class="min-w-full text-sm text-left">
      <thead class="bg-green-100 text-gray-700">
        <tr>
          <th class="px-4 py-3 font-medium">Plan</th>
          <th class="px-4 py-3 font-medium">Status</th>
          <th class="px-4 py-3 font-medium">Created At</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($subscriptions as $sub)
          <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-3">{{ $sub->plan }}</td>
            <td class="px-4 py-3">
              <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                {{ $sub->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                {{ ucfirst($sub->status) }}
              </span>
            </td>
            <td class="px-4 py-3">{{ $sub->created_at->format('Y-m-d') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="px-4 py-4 text-center text-gray-500">No subscriptions found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
