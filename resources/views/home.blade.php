@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero d-flex align-items-center" style="min-height: 90vh; background: linear-gradient(135deg, #d4f5d2, #a8e6a1);">
    <div class="container text-center" data-aos="fade-up">
        <img src="{{ asset('images/icon.png') }}" alt="SEA Catering Logo" style="max-width: 120px; margin-bottom: 20px;">
        <h1 class="display-4 fw-bold text-success">SEA Catering</h1>
        <p class="lead">Healthy Meals, Anytime, Anywhere.</p>
        <p class="hero-description">
            SEA Catering is a <strong>customizable healthy meal service</strong>, delivering <strong>fresh and nutritious food</strong>
            straight to your doorstep across Indonesia. <br>
            <em>Let’s eat better, live healthier, and save time — together!</em>
        </p>
    </div>
</section>

<!-- Features -->
<section class="features py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-5 text-success" data-aos="fade-up">Our Features</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 shadow-sm rounded-4 bg-light h-100 text-center">
                    <h5 class="text-success fw-semibold">Meal Customization</h5>
                    <p>Choose meals tailored to your taste, allergies, and health goals.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="p-4 shadow-sm rounded-4 bg-light h-100 text-center">
                    <h5 class="text-success fw-semibold">Nationwide Delivery</h5>
                    <p>Fast and reliable delivery service to all major cities in Indonesia.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="p-4 shadow-sm rounded-4 bg-light h-100 text-center">
                    <h5 class="text-success fw-semibold">Nutritional Info</h5>
                    <p>Every meal comes with complete nutritional details for smart eating.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #28a745, #218838);" data-aos="fade-up">
    <h4 class="fw-semibold">Contact Manager</h4>
    <p><strong>Brian</strong> | 08123456789</p>
</section>

<!-- Custom Style for Description -->
<style>
    .hero-description {
        font-size: 1.15rem;
        color: #4e6e50;
        max-width: 750px;
        margin: 0 auto;
        padding-top: 10px;
        line-height: 1.8;
        font-weight: 400;
        opacity: 0.95;
    }

    .lead {
        font-size: 1.6rem;
        color: #2e7d32; /* hijau daun tua */
        font-weight: 600;
        text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.08);
    }

    h1.display-4 {
        color: #1b5e20; /* judul lebih gelap */
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.05);
    }

    .features h5 {
        color: #2e7d32;
        font-weight: 600;
    }

    .features p {
        color: #444c44;
    }

    .text-muted {
        color: #4e6e50 !important;
    }
</style>


@endsection
