<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nusa Library - Perpustakaan Digital Indonesia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        :root {
            --primary-color: #374151;
            /* Abu-abu gelap */
            --secondary-color: #4b5563;
            /* Abu-abu medium */
            --accent-color: #6b7280;
            /* Abu-abu terang untuk aksen */
            --dark-bg: #111827;
            /* Biru gelap untuk background */
            --light-text: #f9fafb;
            /* Abu-abu terang untuk teks */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--dark-bg);
            color: var(--light-text);
            line-height: 1.6;
        }

        /* Navbar Styling */
        .navbar {
            background-color: rgba(31, 41, 55, 0.95);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .navbar .logo img {
            height: 45px;
            transition: transform 0.3s ease;
        }

        .navbar .logo img:hover {
            transform: scale(1.05);
        }

        .navbar .logo a {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, white, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .navbar a {
            color: var(--light-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .navbar a:hover::after {
            width: 100%;
        }

        .btn-login {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.85rem 2rem;
            color: var(--light-text);
            border-radius: 12px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: 0.5s;
        }

        .btn-login:hover::after {
            left: 100%;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            padding: 2rem;
            background: linear-gradient(rgba(65, 66, 68, 0.8), rgba(31, 41, 55, 0.9)), url('{{ asset('assets/img/img2.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, transparent 0%, var(--dark-bg) 100%);
        }

        .hero-content {
            max-width: 900px;
            z-index: 1;
            padding: 2rem;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: var(--light-text);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-weight: 800;
            background: linear-gradient(45deg, white, rgb(148, 146, 146));
            ;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.4rem;
            color: #e5e7eb;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Statistics Section */
        .statistics {
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #1f2937, #111827);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #e5e7eb;
        }

        /* Features Section */
        .features {
            padding: 6rem 2rem;
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }

        .features h2 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 4rem;
            color: var(--light-text);
            background: linear-gradient(45deg, white, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .features .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 2.5rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .feature-card:hover::before {
            opacity: 0.1;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .feature-card i {
            font-size: 3.5rem;
            background: linear-gradient(45deg, white, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
        }

        .feature-card h4 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--light-text);
        }

        .feature-card p {
            font-size: 1.1rem;
            color: #e5e7eb;
            line-height: 1.8;
        }

        /* About Section */
        .about {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            position: relative;
            overflow: hidden;
        }

        .about::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: var(--primary-color);
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.1;
            top: -100px;
            right: -100px;
        }

        .about .container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .about h2 {
            font-size: 3rem;
            margin-bottom: 2rem;
            color: var(--light-text);
            background: linear-gradient(45deg, white, white);
            ;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .about p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #e5e7eb;
            margin-bottom: 1.5rem;
        }

        /* Testimonials */
        .testimonials {
            padding: 6rem 2rem;
            background-color: #0f172a;
            position: relative;
        }

        .testimonials::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: var(--accent-color);
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.1;
            bottom: -100px;
            left: -100px;
        }

        .testimonials .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .testimonials h2 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 4rem;
            color: var(--light-text);
            background: linear-gradient(45deg, white, white);
            ;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 2.5rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255 ```html, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .testimonial-card .quote {
            font-style: italic;
            margin-bottom: 1.5rem;
            color: #e5e7eb;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .testimonial-card .author {
            font-weight: bold;
            color: var(--accent-color);
            font-size: 1.1rem;
        }

        /* Footer */
        footer {
            background-color: #0f172a;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
        }

        footer p {
            margin: 0;
            font-size: 1rem;
            color: #9ca3af;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--light-text);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                position: fixed;
                top: 80px;
                left: 0;
                right: 0;
                background-color: rgba(31, 41, 55, 0.95);
                flex-direction: column;
                padding: 2rem;
                gap: 1.5rem;
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-links.active {
                display: flex;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .hero-content {
                padding: 1.5rem;
            }

            .statistics {
                padding: 3rem 1rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .features {
                padding: 4rem 1rem;
            }

            .features h2 {
                font-size: 2.5rem;
                margin-bottom: 3rem;
            }

            .feature-card {
                padding: 2rem;
            }

            .feature-card h4 {
                font-size: 1.5rem;
            }

            .about {
                padding: 4rem 1rem;
            }

            .about h2 {
                font-size: 2.5rem;
            }

            .about p {
                font-size: 1.1rem;
            }

            .testimonials {
                padding: 4rem 1rem;
            }

            .testimonials h2 {
                font-size: 2.5rem;
                margin-bottom: 3rem;
            }

            .testimonial-card {
                padding: 2rem;
            }
        }

        /* Small screens */
        @media (max-width: 480px) {
            .navbar .logo img {
                height: 35px;
            }

            .navbar .logo a {
                font-size: 1.2rem;
            }

            .btn-login {
                padding: 0.7rem 1.5rem;
                font-size: 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .feature-card i {
                font-size: 3rem;
            }

            .feature-card h4 {
                font-size: 1.3rem;
            }

            .testimonial ```html .testimonial-card {
                padding: 1.5rem;
            }

            .testimonial-card .quote {
                font-size: 1rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Scroll Animations */
        [data-aos] {
            opacity: 0;
            transition-property: opacity, transform;
        }

        [data-aos].aos-animate {
            opacity: 1;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
        <img src="{{ asset('assets/img/img1.jpeg') }}" alt="Garuda Perpus Logo">
            <a href="#">Nusantara Library</a>
        </div>
        <div class="nav-links">
            <a href="#beranda">Beranda</a>
            <a href="#fitur">Fitur</a>
            <a href="#tentang">Tentang</a>
            <a href="#testimoni">Testimoni</a>
            <button class="btn-login" onclick="goToLogin(event)">Masuk</button>
        </div>
    </nav>

    <section id="beranda" class="hero">
        <div class="hero-content">
            <h1>Membaca Tanpa Batas di Nusantara Library</h1>
            <p>Jelajahi ribuan koleksi buku digital Indonesia dalam genggaman Anda. Nusantara Library hadir sebagai
                perpustakaan digital terdepan yang menghubungkan pengetahuan dengan teknologi modern.</p>
            <button class="btn-login" onclick="goToLogin(event)">Mulai Membaca</button>
        </div>
    </section>

    <section id="fitur" class="features">
        <h2>Fitur Unggulan</h2>
        <div class="row">
            <div class="feature-card">
                <i class="fas fa-book-reader"></i>
                <h4>Koleksi Digital Lengkap</h4>
                <p>Akses ribuan buku digital dari berbagai kategori, termasuk buku langka dan referensi akademik.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-mobile-alt"></i>
                <h4>Akses Multi-Platform</h4>
                <p>Baca di mana saja dan kapan saja melalui aplikasi mobile atau website kami.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-sync-alt"></i>
                <h4>Pembaruan Berkala</h4>
                <p>Koleksi buku selalu diperbarui dengan titel terbaru dari penerbit terkemuka.</p>
            </div>
        </div>
    </section>

    <section id="tentang" class="about">
        <div class="container">
            <h2>Tentang Nusantara Library</h2>
            <p>Nusantara Library adalah platform perpustakaan digital nasional yang didedikasikan untuk meningkatkan
                literasi digital Indonesia. Kami menggabungkan teknologi modern dengan koleksi pustaka yang komprehensif
                untuk memberikan akses pendidikan berkualitas bagi seluruh masyarakat Indonesia.</p>
            <p>Dengan lebih dari 100.000 judul buku dari berbagai kategori, kami berkomitmen untuk menjadi mitra
                terpercaya dalam perjalanan pembelajaran Anda. Sistem kami yang user-friendly memungkinkan Anda untuk
                dengan mudah mencari, membaca, dan mengelola koleksi bacaan digital Anda.</p>
        </div>
    </section>

    <section id="testimoni" class="testimonials">
        <div class="container">
            <h2>Testimoni Pembaca</h2>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="quote">"Nusantara Library mengubah cara saya membaca. Akses ke ribuan buku dalam
                        genggaman sangat membantu studi saya."</p>
                    <p class="author">- Sarah Wijaya, Mahasiswa</p>
                </div>
                <div class="testimonial-card">
                    <p class="quote">"Platform yang luar biasa untuk pengembangan diri. Koleksi bukunya lengkap dan
                        selalu diperbarui."</p>
                    <p class="author">- Budi Santoso, Profesional</p>
                </div>
                <div class="testimonial-card">
                    <p class="quote">"Sebagai pengajar, saya sangat terbantu dengan adanya Nusantara Library. Referensi
                        yang lengkap dan mudah diakses."</p>
                    <p class="author">- Dr. Ahmad Ramadhan, Dosen</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Nusantara Library - Perpustakaan Digital Indonesia. Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        function goToLogin(event) {
            event.preventDefault();
            window.location.href = "/login";
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>