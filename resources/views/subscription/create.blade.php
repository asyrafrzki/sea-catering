@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12 bg-white p-6 rounded-2xl shadow-lg">

    {{-- Tombol ke My Subscriptions --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-green-700">Subscribe to a Meal Plan</h2>
        <a href="{{ route('subscription.index') }}"
           class="text-sm sm:text-base text-green-700 font-semibold border border-green-600 px-3 py-1.5 rounded-md hover:bg-green-600 hover:text-white transition">
            📋 My Subscriptions
        </a>
    </div>

    <form id="subscription-form" action="{{ route('subscription.store') }}" method="POST">
        @csrf

        <div class="grid sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-semibold block mb-1">Full Name *</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" />
            </div>
            <div>
                <label class="font-semibold block mb-1">Phone Number *</label>
                <input type="text" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" />
            </div>
        </div>

        {{-- Plan Selection --}}
        <div class="mb-6">
            <label class="font-semibold block mb-2">Select a Plan *</label>
            <input type="hidden" name="plan" id="plan" required>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($plans as $plan)
                <div 
                    class="plan-card cursor-pointer border border-gray-200 rounded-xl p-3 shadow-sm hover:shadow-md transition relative"
                    data-plan="{{ $plan->name }}"
                    data-price="{{ $plan->price }}"
                >
                    <img src="{{ asset('images/' . $plan->image) }}" alt="{{ $plan->name }}" class="w-full h-24 object-cover rounded mb-2">
                    <h3 class="text-base font-bold text-green-700">{{ $plan->name }}</h3>
                    <p class="text-sm text-gray-500 truncate">{{ $plan->description }}</p>
                    <p class="text-green-800 text-sm font-semibold mt-1">Rp{{ number_format($plan->price, 0, ',', '.') }}</p>
                    <div class="absolute top-2 right-2 w-4 h-4 rounded-full border-2 border-green-600 bg-white select-indicator hidden"></div>
                </div>
                @endforeach
            </div>
            <p class="text-sm text-gray-500 mt-2">Tap a card to select your plan.</p>
        </div>

        {{-- Meal Types --}}
        <div class="mb-5">
            <label class="font-semibold block mb-2">Meal Types *</label>
            <div class="flex flex-wrap gap-4">
                @foreach (['breakfast', 'lunch', 'dinner'] as $meal)
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="meal_types[]" value="{{ $meal }}" class="meal-type"> 
                        {{ ucfirst($meal) }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Delivery Days --}}
        <div class="mb-5">
            <label class="font-semibold block mb-2">Delivery Days *</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="days[]" value="{{ $day }}" class="delivery-day">
                        {{ $day }}
                    </label>
                @endforeach
            </div>
            <p class="text-sm text-gray-500 mt-1">You can select one or more days.</p>
        </div>

        {{-- Allergies --}}
        <div class="mb-5">
            <label class="font-semibold block mb-1">Allergies</label>
            <input type="text" name="allergies" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" placeholder="(Optional)">
        </div>

        {{-- Total --}}
        <div class="mb-6 bg-green-50 border border-green-300 text-green-700 p-4 rounded-lg">
            <p class="font-semibold">Estimated Total Price:</p>
            <p class="text-xl font-bold mt-1" id="total-price">Rp0</p>
        </div>

        {{-- Submit --}}
        <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition duration-200">
            Submit Subscription
        </button>
    </form>
</div>

{{-- Scripts --}}
<script>
    const planCards = document.querySelectorAll('.plan-card');
    const planInput = document.getElementById('plan');
    const mealTypes = document.querySelectorAll('.meal-type');
    const deliveryDays = document.querySelectorAll('.delivery-day');
    const totalPriceDisplay = document.getElementById('total-price');

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
    }

    function calculateTotal() {
        const selectedCard = document.querySelector('.plan-card.ring-2');
        const planPrice = selectedCard ? parseInt(selectedCard.dataset.price) : 0;
        const mealCount = Array.from(mealTypes).filter(m => m.checked).length;
        const dayCount = Array.from(deliveryDays).filter(d => d.checked).length;
        const total = planPrice * mealCount * dayCount * 4.3;
        totalPriceDisplay.textContent = formatRupiah(total || 0);
    }

    planCards.forEach(card => {
        card.addEventListener('click', () => {
            planCards.forEach(c => {
                c.classList.remove('ring-2', 'ring-green-500');
                c.querySelector('.select-indicator')?.classList.add('hidden');
            });
            card.classList.add('ring-2', 'ring-green-500');
            card.querySelector('.select-indicator')?.classList.remove('hidden');
            planInput.value = card.dataset.plan;
            calculateTotal();
        });
    });

    mealTypes.forEach(cb => cb.addEventListener('change', calculateTotal));
    deliveryDays.forEach(cb => cb.addEventListener('change', calculateTotal));
</script>
@endsection
