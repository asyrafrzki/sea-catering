@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
  <h1 class="text-2xl font-bold mb-6">Subscriptions of {{ $user->name }}</h1>
  <div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full text-left">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Plan</th>
          <th class="px-4 py-2">Status</th>
          <th class="px-4 py-2">Created At</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($subscriptions as $sub)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $sub->plan }}</td>
          <td class="px-4 py-2">{{ $sub->status }}</td>
          <td class="px-4 py-2">{{ $sub->created_at->format('Y-m-d') }}</td>
        </tr>
        @empty
        <tr><td class="px-4 py-2" colspan="3">No subscriptions found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
