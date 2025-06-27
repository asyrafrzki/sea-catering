<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SEA Catering</title>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .nav-hover::before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.4);
      border-radius: 9999px;
      transform: translate(-50%, -50%);
      transition: width 0.3s ease;
      z-index: -1;
    }

    .nav-hover:hover::before,
    .nav-hover.active::before {
      width: 100%;
    }
  </style>
</head>
<body class="bg-green-50 scroll-smooth">

<!-- Navbar -->
<nav class="sticky top-0 z-50 bg-green-600 shadow-md" data-aos="fade-down">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      <a href="/" class="flex items-center space-x-2 text-white text-xl font-bold">
        <img src="{{ asset('images/icon.png') }}" alt="Logo" class="w-16 h-16">
        <span>SEA Catering</span>
      </a>
      <div class="hidden md:flex items-center space-x-6">
        <a href="/" class="relative nav-hover text-white font-medium px-4 py-2 rounded-full transition-all {{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ route('plans.index') }}" class="relative nav-hover text-white font-medium px-4 py-2 rounded-full transition-all {{ request()->is('plans') ? 'active' : '' }}">Menu</a>
       @php
    $subscriptionActive = request()->is('subscription/create') || request()->is('my-subscriptions') || Route::is('subscription.*');
@endphp
<a href="{{ route('subscription.create') }}" 
   class="relative nav-hover text-white font-medium px-4 py-2 rounded-full transition-all {{ $subscriptionActive ? 'active' : '' }}">
   Subscription
</a>


        <a href="#" class="relative nav-hover text-white font-medium px-4 py-2 rounded-full transition-all">Contact Us</a>
      </div>
      <div class="hidden md:flex space-x-3">
        @auth
        <form action="{{ route('logout') }}" method="POST" class="flex items-center space-x-3">
          @csrf
          <span class="text-white font-medium">{{ Auth::user()->name }}</span>
          <button type="submit" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full hover:bg-red-100 transition">
            Logout
          </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition">Login</a>
        <a href="{{ route('register') }}" class="border border-white text-white font-semibold px-5 py-2 rounded-full hover:bg-white hover:text-green-600 transition">Sign Up</a>
        @endauth
      </div>
      <button id="menu-toggle" class="md:hidden text-white text-3xl focus:outline-none">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden flex flex-col gap-2 items-center bg-green-700 rounded-lg mt-2 py-4 transition-all duration-300">
      <a href="/" class="text-white font-medium py-1 hover:bg-white hover:text-green-700 w-11/12 text-center rounded-full transition">Home</a>
      <a href="{{ route('plans.index') }}" class="text-white font-medium py-1 hover:bg-white hover:text-green-700 w-11/12 text-center rounded-full transition {{ request()->is('plans') ? 'bg-white text-green-700' : '' }}">Menu</a>
      <a href="{{ route('subscription.create') }}" 
   class="text-white font-medium py-1 hover:bg-white hover:text-green-700 w-11/12 text-center rounded-full transition {{ $subscriptionActive ? 'bg-white text-green-700' : '' }}">
   Subscription
</a>


      <a href="#" class="text-white font-medium py-1 hover:bg-white hover:text-green-700 w-11/12 text-center rounded-full transition">Contact Us</a>

      @auth
      <div class="text-white font-semibold mt-2">{{ Auth::user()->name }}</div>
      <form action="{{ route('logout') }}" method="POST" class="w-full flex justify-center">
        @csrf
        <button type="submit" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition mt-2">
          Logout
        </button>
      </form>
      @else
      <a href="{{ route('login') }}" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full mt-2 hover:bg-gray-100 transition">Login</a>
      <a href="{{ route('register') }}" class="border border-white text-white font-semibold px-5 py-2 rounded-full hover:bg-white hover:text-green-700 transition">Sign Up</a>
      @endauth
    </div>
  </div>
</nav>

<!-- Dynamic Page Content -->
<main class="min-h-[calc(100vh-64px-96px)]"> {{-- 64px navbar + 96px footer approx --}}
  @yield('content')
</main>


<!-- Global Footer -->
<footer class="bg-green-600 text-white text-center py-6 mt-16">
  <p class="font-semibold">SEA Catering &copy; {{ date('Y') }} | Contact Manager: Brian | 08123456789</p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ once: true, duration: 800, offset: 120, easing: 'ease-in-out' });
  document.getElementById("menu-toggle").addEventListener("click", () => {
    document.getElementById("mobile-menu").classList.toggle("hidden");
  });
</script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if (session('success'))
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    confirmButtonColor: '#22c55e',
  });
@endif
</script>

</body>
</html>
