<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garuda Perpus - Perpustakaan Digital Indonesia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #0056b3;
            --dark-bg: #111827;
            --light-text: #f3f4f6;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--dark-bg);
            color: var(--light-text);
            line-height: 1.6;
        }

        /* Navbar Styling */
        .navbar {
            background-color: rgba(17, 24, 39, 0.95);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar .logo img {
            height: 40px;
        }

        .navbar a {
            color: var(--light-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            margin-left: 2rem;
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
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .navbar a:hover::after {
            width: 100%;
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            color: white;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
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
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('/api/placeholder/1920/1080');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero-content {
            max-width: 800px;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-weight: 800;
        }

        .hero p {
            font-size: 1.25rem;
            color: #e5e7eb;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Features Section */
        .features {
            padding: 5rem 2rem;
            background-color: #1a202c;
        }

        .features h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: white;
        }

        .features .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .feature-card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .feature-card h4 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        /* About Section */
        .about {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        }

        .about .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .about h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: white;
        }

        .about p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #e5e7eb;
        }

        /* Testimonials */
        .testimonials {
            padding: 5rem 2rem;
            background-color: #111827;
        }

        .testimonials .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: white;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .testimonial-card .quote {
            font-style: italic;
            margin-bottom: 1rem;
            color: #e5e7eb;
        }

        .testimonial-card .author {
            font-weight: bold;
            color: var(--primary-color);
        }

        /* Footer */
        footer {
            background-color: #0f172a;
            padding: 2rem;
            text-align: center;
            color: #9ca3af;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .navbar .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="https://files.oaiusercontent.com/file-YTHfAhcevNtGoI9Ma5qE3aWY?se=2024-11-09T04%3A29%3A47Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D3afd7a21-c8e9-420e-82b7-4fa7eb1f0bf5.webp&sig=gEixEm7B5KaDxWazIZ7yZPZ36S581e0IfW3X/I38uO4%3D" alt="Garuda Perpus Logo">
            <a href="#">Garuda Perpus</a>
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
            <h1>Membaca Tanpa Batas di Garuda Perpus</h1>
            <p>Jelajahi ribuan koleksi buku digital Indonesia dalam genggaman Anda. Garuda Perpus hadir sebagai perpustakaan digital terdepan yang menghubungkan pengetahuan dengan teknologi modern.</p>
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
            <h2>Tentang Garuda Perpus</h2>
            <p>Garuda Perpus adalah platform perpustakaan digital nasional yang didedikasikan untuk meningkatkan literasi digital Indonesia. Kami menggabungkan teknologi modern dengan koleksi pustaka yang komprehensif untuk memberikan akses pendidikan berkualitas bagi seluruh masyarakat Indonesia.</p>
            <p>Dengan lebih dari 100.000 judul buku dari berbagai kategori, kami berkomitmen untuk menjadi mitra terpercaya dalam perjalanan pembelajaran Anda. Sistem kami yang user-friendly memungkinkan Anda untuk dengan mudah mencari, membaca, dan mengelola koleksi bacaan digital Anda.</p>
        </div>
    </section>

    <section id="testimoni" class="testimonials">
        <div class="container">
            <h2>Testimoni Pembaca</h2>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="quote">"Garuda Perpus mengubah cara saya membaca. Akses ke ribuan buku dalam genggaman sangat membantu studi saya."</p>
                    <p class="author">- Sarah Wijaya, Mahasiswa</p>
                </div>
                <div class="testimonial-card">
                    <p class="quote">"Platform yang luar biasa untuk pengembangan diri. Koleksi bukunya lengkap dan selalu diperbarui."</p>
                    <p class="author">- Budi Santoso, Profesional</p>
                </div>
                <div class="testimonial-card">
                    <p class="quote">"Sebagai pengajar, saya sangat terbantu dengan adanya Garuda Perpus. Referensi yang lengkap dan mudah diakses."</p>
                    <p class="author">- Dr. Ahmad Ramadhan, Dosen</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Garuda Perpus - Perpustakaan Digital Indonesia. Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        function goToLogin(event) {
            event.preventDefault();
            window.location.href = "/login";
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
