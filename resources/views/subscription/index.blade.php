@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h2 class="text-3xl font-bold text-green-700 text-center sm:text-left mb-4 sm:mb-0">My Subscriptions</h2>
        <a href="{{ route('subscription.create') }}" class="bg-green-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition w-full sm:w-auto text-center">
            + Buat Subscription Baru
        </a>
    </div>

@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show"
        class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4 transition-all duration-500"
    >
        {{ session('success') }}
    </div>
@endif

    @if ($subscriptions->isEmpty())
        <div class="text-center text-gray-600">You have no subscriptions yet.</div>
    @else
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full border-collapse bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-green-100 text-green-700">
                    <tr>
                        <th class="p-4 text-left">Name</th>
                        <th class="p-4 text-left">Plan</th>
                        <th class="p-4 text-left">Meals</th>
                        <th class="p-4 text-left">Days</th>
                        <th class="p-4 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr class="border-b hover:bg-green-50">
                            <td class="p-4">{{ $subscription->name }}</td>
                            <td class="p-4 capitalize">{{ $subscription->plan }}</td>
                            <td class="p-4">{{ implode(', ', json_decode($subscription->meal_types, true)) }}</td>
                            <td class="p-4">{{ implode(', ', json_decode($subscription->days, true)) }}</td>
                            <td class="p-4 font-semibold text-green-700">Rp{{ number_format($subscription->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="sm:hidden space-y-4 mt-4">
            @foreach ($subscriptions as $subscription)
                <div class="bg-white rounded-xl shadow-md p-4 border border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-bold text-green-700 text-lg">{{ $subscription->name }}</h3>
                        <span class="text-sm bg-green-100 text-green-700 px-2 py-1 rounded-full capitalize">
                            {{ $subscription->plan }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-700 mb-1">
                        <strong>Meals:</strong> {{ implode(', ', json_decode($subscription->meal_types, true)) }}
                    </div>
                    <div class="text-sm text-gray-700 mb-1">
                        <strong>Days:</strong> {{ implode(', ', json_decode($subscription->days, true)) }}
                    </div>
                    <div class="text-right mt-3 font-semibold text-green-600">
                        Rp{{ number_format($subscription->total_price, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
