@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-16 px-4">
  <h1 class="text-3xl font-bold text-green-700 mb-8">Your Dashboard</h1>

  @if($subscriptions->count())
    <div class="space-y-6">
      @foreach($subscriptions as $sub)
        <div class="bg-white p-6 border border-green-200 rounded-lg shadow-sm">
          <h2 class="text-xl font-semibold text-green-800 mb-2">{{ $sub->plan }}</h2>
          <div class="space-y-1 text-gray-700">
            <p><span class="font-medium">Meals:</span> {{ implode(', ', json_decode($sub->meal_types, true)) }}</p>
            <p><span class="font-medium">Delivery Days:</span> {{ implode(', ', json_decode($sub->days, true)) }}</p>
            <p><span class="font-medium">Total Price:</span> Rp{{ number_format($sub->total_price) }}</p>
            <p><span class="font-medium">Status:</span> 
              <span class="inline-block px-2 py-1 text-xs rounded-full 
                {{ $sub->status == 'active' ? 'bg-green-100 text-green-700' : 
                   ($sub->status == 'paused' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                {{ ucfirst($sub->status) }}
              </span>
            </p>
          </div>

          <div class="mt-4 flex flex-wrap gap-2">
            @if($sub->status == 'active')
              <form method="POST" action="{{ route('dashboard.pause', $sub->id) }}">
                @csrf
                <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Pause</button>
              </form>
              <form method="POST" action="{{ route('dashboard.cancel', $sub->id) }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel</button>
              </form>
            @elseif($sub->status == 'paused')
              <form method="POST" action="{{ route('dashboard.resume', $sub->id) }}">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Resume</button>
              </form>
              <form method="POST" action="{{ route('dashboard.cancel', $sub->id) }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel</button>
              </form>
            @else
              <p class="text-gray-500 italic">No actions available.</p>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  @else
    <p class="text-gray-700">You have no active subscriptions.</p>
  @endif
</div>
@endsection
