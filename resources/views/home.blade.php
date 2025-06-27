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

<!-- Testimonial Section -->
<section id="testimonials" class="py-16 bg-white border-t border-gray-200">
  <div class="max-w-5xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-green-700 mb-10">What Our Customers Say</h2>

    <!-- Carousel/Slider -->
    <div x-data="{ active: 0, testimonials: @json(\App\Models\Testimonial::latest()->take(5)->get()) }" class="relative">
      <template x-if="testimonials.length">
        <div class="text-center px-6">
          <div x-text="testimonials[active].message" class="text-lg italic text-gray-700 mb-4"></div>
          <div class="font-semibold text-green-600" x-text="testimonials[active].name"></div>
          <div class="text-yellow-500 mt-1" x-html="'★'.repeat(testimonials[active].rating) + '☆'.repeat(5 - testimonials[active].rating)"></div>
        </div>
      </template>

      <div class="flex justify-center mt-6 space-x-2">
        <template x-for="(t, i) in testimonials">
          <button @click="active = i"
                  :class="i === active ? 'bg-green-600' : 'bg-gray-300'"
                  class="w-3 h-3 rounded-full transition duration-300"></button>
        </template>
      </div>
    </div>

    <!-- Testimonial Form -->
    <div class="mt-12 max-w-xl mx-auto">
      <h3 class="text-xl font-bold text-green-700 text-center mb-4">Share Your Experience</h3>
      <form action="{{ route('testimonial.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required class="w-full border px-4 py-2 rounded-lg focus:ring-green-300" />
        <textarea name="message" placeholder="Your Review" required rows="3" class="w-full border px-4 py-2 rounded-lg focus:ring-green-300"></textarea>
        <select name="rating" required class="w-full border px-4 py-2 rounded-lg focus:ring-green-300">
          <option value="">Rate Us</option>
          @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
          @endfor
        </select>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
          Submit Testimonial
        </button>
      </form>
    </div>
  </div>
</section>

@endsection
