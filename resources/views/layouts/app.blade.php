<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEA Catering</title>
    
    <!-- Bootstrap & AOS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f7fff7;
            scroll-behavior: smooth;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #28a745;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 10px 15px;
            transition: 0.3s ease;
            position: relative;
        }

        .navbar .nav-link::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0%;
            height: 2px;
            background-color: #fff;
            transition: 0.4s ease;
        }

        .navbar .nav-link:hover::after,
        .navbar .nav-link.active::after {
            width: 100%;
            left: 0;
        }

        .navbar-toggler {
            border: none;
        }

        /* Button Styles */
        .btn-sign {
            background: white;
            color: #28a745;
            border-radius: 25px;
            padding: 6px 18px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-sign:hover {
            background: #f1f1f1;
            color: #218838;
        }

        .btn-outline-light {
            border-radius: 25px;
            padding: 6px 18px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .navbar-collapse {
                text-align: center;
            }
            .navbar-nav {
                margin-top: 1rem;
            }
        }

        /* Hero Text Enhancements */
        .hero .lead {
            font-size: 1.5rem;
            color: #2d2d2d;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }

        .hero .description {
            font-size: 1.1rem;
            color: #555;
            max-width: 720px;
            margin: 0 auto;
            line-height: 1.8;
            padding-top: 10px;
            font-weight: 400;
            opacity: 0.9;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">SEA Catering</a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Subscription</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            </ul>

            <!-- Desktop -->
            <div class="d-none d-lg-flex">
                <a href="/login" class="btn btn-sign me-2">Login</a>
                <a href="/register" class="btn btn-outline-light">Sign Up</a>
            </div>

            <!-- Mobile -->
            <div class="d-lg-none mt-3 text-center w-100">
                <a href="/login" class="btn btn-sign me-2 mb-2">Login</a>
                <a href="/register" class="btn btn-outline-light mb-2">Sign Up</a>
            </div>
        </div>
    </div>
</nav>

<!-- Page Content -->
<main>
    @yield('content')
</main>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 800
    });
</script>

</body>
</html>
