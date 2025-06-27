<div class="text-center">
  <h2 class="text-2xl font-bold text-green-800 mb-4">{{ $plan->name }}</h2>
  @if($plan->image)
    <img src="{{ $plan->image }}" alt="{{ $plan->name }}" class="mx-auto h-48 w-full object-cover rounded">
  @endif
  <p class="mt-4 text-gray-700">{{ $plan->details ?? $plan->description }}</p>
  <p class="mt-4 font-semibold text-green-600 text-lg">Rp {{ number_format($plan->price,0,',','.') }}</p>
</div>
