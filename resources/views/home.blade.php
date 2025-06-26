@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="min-h-[90vh] flex items-center justify-center bg-gradient-to-br from-green-100 to-green-200 text-center px-4" data-aos="fade-up">
    <div>
        <img src="{{ asset('images/icon.png') }}" alt="SEA Catering Logo" class="mx-auto w-28 mb-6" />
        <h1 class="text-4xl md:text-5xl font-bold text-green-800 mb-2">SEA Catering</h1>
        <p class="text-xl font-semibold text-green-700">Healthy Meals, Anytime, Anywhere.</p>
        <p class="mt-4 text-green-900 text-base md:text-lg max-w-2xl mx-auto leading-relaxed opacity-95">
            SEA Catering is a <strong>customizable healthy meal service</strong>, delivering 
            <strong>fresh and nutritious food</strong> straight to your doorstep across Indonesia. <br>
            <em>Let’s eat better, live healthier, and save time — together!</em>
        </p>
    </div>
</section>

<!-- Features -->
<section class="py-16 bg-white" id="features">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-12" data-aos="fade-up">Our Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-green-50 p-6 rounded-xl shadow text-center" data-aos="fade-up" data-aos-delay="100">
                <h5 class="text-lg font-semibold text-green-700 mb-2">Meal Customization</h5>
                <p class="text-gray-700">Choose meals tailored to your taste, allergies, and health goals.</p>
            </div>
            <div class="bg-green-50 p-6 rounded-xl shadow text-center" data-aos="fade-up" data-aos-delay="200">
                <h5 class="text-lg font-semibold text-green-700 mb-2">Nationwide Delivery</h5>
                <p class="text-gray-700">Fast and reliable delivery service to all major cities in Indonesia.</p>
            </div>
            <div class="bg-green-50 p-6 rounded-xl shadow text-center" data-aos="fade-up" data-aos-delay="300">
                <h5 class="text-lg font-semibold text-green-700 mb-2">Nutritional Info</h5>
                <p class="text-gray-700">Every meal comes with complete nutritional details for smart eating.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-10 text-center text-white bg-gradient-to-br from-green-600 to-green-700" data-aos="fade-up">
    <h4 class="text-xl font-semibold">Contact Manager</h4>
    <p class="mt-2"><strong>Brian</strong> | 08123456789</p>
</section>

@endsection
