@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg">
    <!-- Tombol ke My Subscriptions -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('subscription.index') }}"
           class="text-sm sm:text-base text-green-700 font-semibold border border-green-600 px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white transition">
            📋 My Subscriptions
        </a>
    </div>

    <h2 class="text-3xl font-bold mb-6 text-green-700 text-center">Subscribe to a Meal Plan</h2>

    <form id="subscription-form" action="{{ route('subscription.store') }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="font-semibold block mb-1">Full Name *</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" />
        </div>

        <div class="mb-5">
            <label class="font-semibold block mb-1">Phone Number *</label>
            <input type="text" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" />
        </div>

        <div class="mb-5">
            <label class="font-semibold block mb-1">Select Plan *</label>
            <select name="plan" id="plan" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300">
                <option value="" disabled selected>-- Select Plan --</option>
                <option value="diet" data-price="30000">Diet Plan – Rp30.000</option>
                <option value="protein" data-price="40000">Protein Plan – Rp40.000</option>
                <option value="royal" data-price="60000">Royal Plan – Rp60.000</option>
            </select>
        </div>

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

        <div class="mb-5">
            <label class="font-semibold block mb-1">Allergies</label>
            <input type="text" name="allergies" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" placeholder="(Optional)">
        </div>

        <div class="mb-6 bg-green-50 border border-green-300 text-green-700 p-4 rounded-lg">
            <p class="font-semibold">Estimated Total Price:</p>
            <p class="text-xl font-bold mt-1" id="total-price">Rp0</p>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition duration-200">
            Submit Subscription
        </button>
    </form>
</div>

<script>
    const planSelect = document.getElementById('plan');
    const mealTypes = document.querySelectorAll('.meal-type');
    const deliveryDays = document.querySelectorAll('.delivery-day');
    const totalPriceDisplay = document.getElementById('total-price');

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
    }

    function calculateTotal() {
        const selectedPlan = planSelect.options[planSelect.selectedIndex];
        const planPrice = parseInt(selectedPlan.dataset.price || 0);

        const mealCount = Array.from(mealTypes).filter(m => m.checked).length;
        const dayCount = Array.from(deliveryDays).filter(d => d.checked).length;

        const total = planPrice * mealCount * dayCount * 4.3;
        totalPriceDisplay.textContent = formatRupiah(total || 0);
    }

    planSelect.addEventListener('change', calculateTotal);
    mealTypes.forEach(cb => cb.addEventListener('change', calculateTotal));
    deliveryDays.forEach(cb => cb.addEventListener('change', calculateTotal));
</script>
@endsection
