@extends('layouts.app')

@section('content')

<!-- Slogan Section -->
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

<!-- Testimonials Section -->
<section id="testimonials" class="py-20 bg-white border-t border-gray-200">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-green-700 mb-12">What Our Customers Say</h2>

    <!-- Testimonial Form -->
    <div class="bg-green-50 p-6 rounded-xl shadow-md max-w-xl mx-auto mb-16">
      <h3 class="text-xl font-bold text-green-700 text-center mb-4">Share Your Experience</h3>

      @auth
      <form action="{{ route('testimonial.store') }}" method="POST" x-data="{ rating: 0 }" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Your Name" value="{{ Auth::user()->name }}" required
               class="w-full border px-4 py-2 rounded-lg focus:ring-green-300" />

        <textarea name="message" placeholder="Your Review" required rows="3"
                  class="w-full border px-4 py-2 rounded-lg focus:ring-green-300"></textarea>

        <!-- Star Rating -->
        <div class="flex justify-center gap-1">
          <template x-for="star in 5" :key="star">
            <svg @click="rating = star" :class="rating >= star ? 'text-yellow-400' : 'text-gray-300'"
                 class="w-8 h-8 cursor-pointer transition" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.973a1 1 0 00.95.69h4.177c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.973c.3.921-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.175 0l-3.38 2.455c-.784.57-1.838-.197-1.539-1.118l1.285-3.973a1 1 0 00-.363-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.176a1 1 0 00.951-.69l1.286-3.973z"/>
            </svg>
          </template>
        </div>
        <input type="hidden" name="rating" :value="rating" required>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
          Submit Testimonial
        </button>
      </form>
      @else
      <div class="text-center">
        <p class="mb-4 text-gray-700">You must <a href="{{ route('login') }}" class="text-green-600 underline font-semibold">login</a> to submit a testimonial.</p>
        <a href="{{ route('login') }}" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">Login to Continue</a>
      </div>
      @endauth
    </div>

    <!-- List  Testimony -->
    @php
      $testimonials = \App\Models\Testimonial::latest()->get();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      @foreach($testimonials as $testimonial)
      <div class="bg-white p-6 border rounded-xl shadow-md hover:shadow-lg transition">
        <div class="flex items-center gap-4 mb-3">
          <div class="bg-green-100 text-green-700 font-bold rounded-full w-10 h-10 flex items-center justify-center">
            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
          </div>
          <div>
            <p class="font-semibold text-green-700">{{ $testimonial->name }}</p>
            <div class="text-yellow-400 text-sm">
              {!! str_repeat('★', $testimonial->rating) . str_repeat('☆', 5 - $testimonial->rating) !!}
            </div>
          </div>
        </div>
        <p class="text-gray-800 italic">“{{ $testimonial->message }}”</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
