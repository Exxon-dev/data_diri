<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pribadi — Company</title>
    
    <!-- Impor Font dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Impor Ikon dari Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* --- Variabel Desain --- */
        :root {
            --bg-dark: #101010;
            --bg-card: #1a1a1a;
            --text-light: #f0f0f0;
            --purple: #9b59b6;
            --pink: #e91e63;
            --font-heading: 'Poppins', sans-serif;
            --font-body: 'Lato', sans-serif;
        }

        /* --- Pengaturan Dasar & Reset --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: var(--font-body);
            line-height: 1.7;
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }

        /* --- EFEK UTAMA: SHADOW RGB TEBAL --- */
        .rgb-shadow-text {
            font-weight: 900;
            color: var(--text-light);
            text-shadow: 
                2px 2px 0px var(--purple), 
                -2px -2px 0px var(--pink);
            transition: all 0.3s ease-in-out;
        }

        .rgb-shadow-box {
            background-color: var(--bg-card);
            border: 1px solid #2f2f2f;
            border-radius: 15px;
            /* Shadow tebal dengan warna ungu dan pink */
            box-shadow: 
                8px 8px 25px rgba(155, 89, 182, 0.4),  /* Shadow Ungu */
                -8px -8px 25px rgba(233, 30, 99, 0.4); /* Shadow Pink */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .rgb-shadow-box:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 
                12px 12px 35px rgba(155, 89, 182, 0.6),
                -12px -12px 35px rgba(233, 30, 99, 0.6);
        }

        /* --- Header & Navigasi --- */
        header {
            background-color: rgba(26, 26, 26, 0.85);
            backdrop-filter: blur(10px);
            width: 100%;
            padding: 1rem 5%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #222;
        }

        nav .logo {
            color: var(--text-light);
            text-decoration: none;
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.5rem;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin-left: 2rem;
        }

        nav ul li a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 700;
            position: relative;
            padding-bottom: 5px;
            transition: color 0.3s ease;
        }
        
        nav ul li a:hover {
            color: var(--pink);
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-image: linear-gradient(to right, var(--pink), var(--purple));
            transition: width 0.4s ease;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        /* --- Pengaturan Section Umum --- */
        section {
            padding: 8rem 5% 4rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-family: var(--font-heading);
            font-size: 3rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        /* --- Hero Section --- */
        #hero {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }

        .hero-content h1 {
            font-family: var(--font-heading);
            font-size: clamp(2.5rem, 8vw, 5rem); /* Ukuran font responsif */
            margin-bottom: 1rem;
        }

        .hero-content .subtitle {
            font-size: clamp(1.2rem, 4vw, 1.5rem);
            margin-bottom: 2.5rem;
            color: #ccc;
            min-height: 2.2rem; 
        }

        /* --- Tombol Aksi (CTA Button) --- */
        .cta-button {
            display: inline-block;
            background-image: linear-gradient(45deg, var(--pink), var(--purple));
            color: #fff;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }

        .cta-button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(233, 30, 99, 0.5);
        }

        /* --- Tentang Saya --- */
        #about .about-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .profile-pic {
            width: 280px;
            height: 280px;
            object-fit: cover;
            border-radius: 50%;
            border: 7px solid transparent;
            background: linear-gradient(var(--bg-card), var(--bg-card)) padding-box,
                        linear-gradient(45deg, var(--purple), var(--pink)) border-box;
        }

        .about-text {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
        }

        /* --- Keahlian --- */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
        }

        .skill-card {
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .skill-card i {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            background: -webkit-linear-gradient(45deg, var(--purple), var(--pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .skill-card h3 {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            margin-bottom: 0.5rem;
        }

        /* --- Portofolio --- */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
        }

        .portfolio-item {
            overflow: hidden;
            text-align: left;
        }

        .portfolio-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }
        
        .portfolio-item:hover img {
            transform: scale(1.1);
        }
        
        .portfolio-content {
            padding: 1.5rem;
        }

        .portfolio-content h3 {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
        }
        
        .portfolio-content p {
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        /* --- Kontak --- */
        .contact-form {
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: 2px solid #333;
            background-color: var(--bg-card);
            color: var(--text-light);
            font-family: var(--font-body);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .contact-form input:focus, .contact-form textarea:focus {
            outline: none;
            border-color: var(--purple);
            box-shadow: 0 0 15px var(--purple);
        }

        /* --- Footer --- */
        footer {
            text-align: center;
            padding: 3rem 5%;
            margin-top: 4rem;
            background-color: var(--bg-card);
            border-top: 1px solid #222;
        }

        .social-links a {
            color: #aaa;
            font-size: 2rem;
            margin: 0 1rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-links a:hover {
            color: var(--pink);
            transform: translateY(-5px);
        }

        footer p {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #777;
        }

        /* --- Responsif untuk Mobile --- */
        @media (max-width: 768px) {
            header {
                padding: 1rem 5%;
            }
            nav ul { display: none; } /* Untuk simpel, sembunyikan menu. Bisa diganti menu burger */
            
            .section-title { font-size: 2.2rem; }
            #about .about-container { text-align: center; }
        }

    </style>
</head>
<body>

    <!-- Header & Navigasi -->
    <header>
        <nav>
            <a href="#hero" class="logo">Company</a>
            <ul>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#skills">Keahlian</a></li>
                <li><a href="#portfolio">Portofolio</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero">
            <div class="hero-content">
                <h1 class="rgb-shadow-text">Halo, Saya Company</h1>
                <p class="subtitle" id="typewriter-target">Web Developer & UI/UX Enthusiast</p>
                <a href="#portfolio" class="cta-button">Lihat Karya Saya</a>
            </div>
        </section>

        <!-- Tentang Saya -->
        <section id="about">
            <h2 class="section-title rgb-shadow-text">Tentang Saya</h2>
            <div class="about-container">
                <img src="https://placehold.co/400x400/1a1a1a/ffffff?text=Foto+Anda" alt="Foto Profil" class="profile-pic">
                <div class="about-text">
                    <h3>Selamat Datang di Dunia Digital Saya!</h3>
                    <p>
                        Saya adalah seorang profesional yang bersemangat dalam dunia teknologi dengan fokus pada pengembangan web modern dan desain antarmuka yang intuitif. Saya suka belajar hal baru, memecahkan masalah, dan mengubah ide-ide kompleks menjadi solusi digital yang elegan dan fungsional bagi pengguna.
                    </p>
                </div>
            </div>
        </section>

        <!-- Keahlian -->
        <section id="skills">
            <h2 class="section-title rgb-shadow-text">Keahlian Saya</h2>
            <div class="skills-grid">
                <div class="skill-card rgb-shadow-box">
                    <i class="fas fa-code"></i>
                    <h3>Front-End</h3>
                    <p>HTML, CSS, JavaScript, React, Vue.js, TailwindCSS</p>
                </div>
                <div class="skill-card rgb-shadow-box">
                    <i class="fas fa-server"></i>
                    <h3>Back-End</h3>
                    <p>Node.js, Express, Python, PHP, SQL, MongoDB</p>
                </div>
                <div class="skill-card rgb-shadow-box">
                    <i class="fas fa-palette"></i>
                    <h3>Desain Grafis</h3>
                    <p>Figma, Adobe XD, Photoshop, Prinsip UI/UX</p>
                </div>
            </div>
        </section>

        <!-- Portofolio -->
        <section id="portfolio">
            <h2 class="section-title rgb-shadow-text">Portofolio Proyek</h2>
            <div class="portfolio-grid">
                <div class="portfolio-item rgb-shadow-box">
                    <img src="https://placehold.co/600x400/9b59b6/ffffff?text=Proyek+Satu" alt="Gambar Proyek 1">
                    <div class="portfolio-content">
                        <h3>Website E-Commerce Modern</h3>
                        <p>Platform toko online yang dibangun dengan React dan Node.js, menampilkan desain yang responsif dan sistem pembayaran terintegrasi.</p>
                        <a href="#" class="cta-button" target="_blank">Lihat Proyek</a>
                    </div>
                </div>
                <div class="portfolio-item rgb-shadow-box">
                    <img src="https://placehold.co/600x400/e91e63/ffffff?text=Proyek+Dua" alt="Gambar Proyek 2">
                    <div class="portfolio-content">
                        <h3>Aplikasi Dashboard Analitik</h3>
                        <p>Aplikasi web untuk visualisasi data interaktif menggunakan D3.js, membantu bisnis dalam mengambil keputusan strategis.</p>
                        <a href="#" class="cta-button" target="_blank">Lihat Proyek</a>
                    </div>
                </div>
                <div class="portfolio-item rgb-shadow-box">
                    <img src="https://placehold.co/600x400/3498db/ffffff?text=Proyek+Tiga" alt="Gambar Proyek 3">
                    <div class="portfolio-content">
                        <h3>Desain Ulang Aplikasi Mobile</h3>
                        <p>Proyek desain UI/UX lengkap untuk aplikasi mobile, berfokus pada peningkatan pengalaman pengguna dan alur kerja yang intuitif.</p>
                        <a href="#" class="cta-button" target="_blank">Lihat Proyek</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kontak -->
        <section id="contact">
            <h2 class="section-title rgb-shadow-text">Hubungi Saya</h2>
            <form class="contact-form" action="kirim_pesan.php" method="POST">
                <input type="text" name="name" placeholder="Nama Lengkap Anda" required>
                <input type="email" name="email" placeholder="Alamat Email Anda" required>
                <textarea name="message" rows="6" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                <button type="submit" class="cta-button">Kirim Pesan</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="social-links">
            <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
            <a href="https://github.com/Exxon-dev" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
            <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
        <p>&copy; 2025 &mdash; Didesain dan Dibuat oleh [Nama Anda]</p>
    </footer>

    <script>
        // Efek Ketik (Typewriter) untuk subjudul di Hero Section
        document.addEventListener('DOMContentLoaded', function() {
            const target = document.getElementById('typewriter-target');
            const text = target.innerHTML;
            target.innerHTML = '';
            let i = 0;

            function type() {
                if (i < text.length) {
                    target.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, 110); // Atur kecepatan ketik di sini (ms)
                }
            }
            // Mulai efek setelah sedikit jeda
            setTimeout(type, 500);
        });
    </script>

</body>
</html>