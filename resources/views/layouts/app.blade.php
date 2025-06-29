<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SEA Catering</title>

  <!-- Alpine.js -->
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
      background-color: rgba(255, 255, 255, 0.2);
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
        <img src="{{ asset('images/icon.png') }}" alt="Logo" class="w-14 h-14">
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

       
        <a href="#contact" class="relative nav-hover text-white font-medium px-4 py-2 rounded-full transition-all">Contact Us</a>
      </div>

      <!-- User Auth -->
      <div class="hidden md:flex items-center space-x-3">
        @auth
          <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center space-x-2 text-white font-medium focus:outline-none">
              <span>{{ Auth::user()->name }}</span>
              <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div 
              x-show="open"
              @click.away="open = false"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95"
              class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 overflow-hidden"
            >
              <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-green-700 hover:bg-green-50 transition">📊 Dashboard</a>
              <form action="{{ route('logout') }}" method="POST" class="border-t">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition">
                  🔒 Logout
                </button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition">Login</a>
          <a href="{{ route('register') }}" class="border border-white text-white font-semibold px-5 py-2 rounded-full hover:bg-white hover:text-green-600 transition">Sign Up</a>
        @endauth
      </div>
      <button id="menu-toggle" class="md:hidden text-white text-3xl focus:outline-none">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden flex flex-col gap-2 items-center bg-green-700 rounded-lg mt-2 py-4 transition-all duration-300">
      <a href="/"
         class="font-medium py-1 w-11/12 text-center rounded-full transition
         {{ request()->is('/') ? 'bg-white text-green-700' : 'text-white hover:bg-white hover:text-green-700' }}">
        Home
      </a>

      <a href="{{ route('plans.index') }}"
         class="font-medium py-1 w-11/12 text-center rounded-full transition
         {{ request()->is('plans') ? 'bg-white text-green-700' : 'text-white hover:bg-white hover:text-green-700' }}">
        Menu
      </a>

      <a href="{{ route('subscription.create') }}"
         class="font-medium py-1 w-11/12 text-center rounded-full transition
         {{ request()->is('subscription/create') || request()->is('my-subscriptions') || Route::is('subscription.*') ? 'bg-white text-green-700' : 'text-white hover:bg-white hover:text-green-700' }}">
        Subscription
      </a>

      <a href="#contact"
         class="font-medium py-1 w-11/12 text-center rounded-full transition text-white hover:bg-white hover:text-green-700">
        Contact Us
      </a>

      @auth
        <a href="{{ route('dashboard') }}"
           class="font-medium py-1 w-11/12 text-center rounded-full transition
           {{ request()->is('dashboard') ? 'bg-white text-green-700' : 'text-white hover:bg-white hover:text-green-700' }}">
          Dashboard
        </a>
        <form action="{{ route('logout') }}" method="POST" class="w-full flex justify-center">
          @csrf
          <button type="submit" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition mt-2">
            Logout
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition mt-2">Login</a>
        <a href="{{ route('register') }}" class="border border-white text-white font-semibold px-5 py-2 rounded-full hover:bg-white hover:text-green-700 transition mt-2">Sign Up</a>
      @endauth
    </div>

  </div>
</nav>

<main class="min-h-[calc(100vh-64px-96px)]">
  @yield('content')
</main>

<footer id="contact" class="bg-green-600 text-white text-center py-6 mt-16">
  <p class="font-semibold">SEA Catering &copy; {{ date('Y') }} | Contact Manager: Brian | 08123456789</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ once: true, duration: 800, offset: 120, easing: 'ease-in-out' });
  document.getElementById("menu-toggle").addEventListener("click", () => {
    document.getElementById("mobile-menu").classList.toggle("hidden");
  });
</script>

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
