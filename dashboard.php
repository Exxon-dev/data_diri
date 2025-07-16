<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pribadi — Sekolah</title>

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
            overflow-x: hidden;
            /* Mencegah scroll horizontal */
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
                8px 8px 25px rgba(155, 89, 182, 0.4),
                /* Shadow Ungu */
                -8px -8px 25px rgba(233, 30, 99, 0.4);
            /* Shadow Pink */
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
            font-size: clamp(2.5rem, 8vw, 5rem);
            /* Ukuran font responsif */
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
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
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

        /* --- Jurusan --- */
        .jurusan-grid {
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

        /* --- Prestasi --- */
        .prestasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
        }

        .prestasi-item {
            overflow: hidden;
            text-align: left;
        }

        .prestasi-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .prestasi-item:hover img {
            transform: scale(1.1);
        }

        .prestasi-content {
            padding: 1.5rem;
        }

        .prestasi-content h3 {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
        }

        .prestasi-content p {
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

        .contact-form input,
        .contact-form textarea {
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

        .contact-form input:focus,
        .contact-form textarea:focus {
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

            nav ul {
                display: none;
            }

            /* Untuk simpel, sembunyikan menu. Bisa diganti menu burger */

            .section-title {
                font-size: 2.2rem;
            }

            #about .about-container {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- Header & Navigasi -->
    <header>
        <nav>
            <a href="#hero" class="logo">SMK MW9</a>
            <ul>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#jurusan">Jurusan</a></li>
                <li><a href="#prestasi">Prestasi</a></li>
                <li><a href="#contact">Kontak</a></li>
                <li><a href="blog.php">Blogclear
                </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero">
            <div class="hero-content">
                <h1 class="rgb-shadow-text">SMK Wali Songo Kajoran</h1>
                <p class="subtitle" id="typewriter-target">Sekolah Menengah Kejuruan</p>
                <a href="#prestasi" class="cta-button">Lihat Prestasi</a>
            </div>
        </section>

        <!-- Tentang Saya -->
        <section id="about">
            <h2 class="section-title rgb-shadow-text">Tentang Sekolah</h2>
            <div class="about-container">
                <img src="img/smk.jpg" alt="Logo sekolah" class="profile-pic">
                <div class="about-text">
                    <h3>Selamat Datang Website Sekolah SMK MW9</h3>
                    <p>
                        Sekolah ini berfokus pada pengembangan karakter religius dan profesionalitas, menyediakan jurusan teknologi yang relevan, dan aktif dalam kegiatan ekstrakurikuler serta perayaan budaya lokal.
                        <br><br>
                        <strong>Visi:</strong>
                        Menjadi SMK unggul yang menghasilkan lulusan bertaqwa, berkarakter kebangsaan, berwawasan lingkungan, serta profesional dan terampil.
                        <br><br>
                        <strong>Misi utama:</strong>

                        Menanamkan nilai Islam Ahlussunnah Wal Jama’ah & nilai kebangsaan

                        Mengintegrasikan ilmu & teknologi sesuai kebutuhan masyarakat dan dunia industri

                        Mengembangkan potensi siswa melalui kemajuan teknologi informasi

                        Membangun kemitraan dengan dunia usaha/industri untuk penyaluran lulusan & wirausaha
                    </p>
                </div>
            </div>
        </section>

        <!-- Jurusan -->
        <section id="jurusan">
            <h2 class="section-title rgb-shadow-text">Jurusan</h2>
            <div class="jurusan-grid">
                <div class="skill-card rgb-shadow-box">
                    <i class="fas fa-code"></i>
                    <h3>PPLGim</h3>
                    <p>Pengembangan Perangkat Lunak dan Gim</p>
                </div>
                <div class="skill-card rgb-shadow-box">
                    <i class="fas fa-building"></i>
                    <h3>MPLB</h3>
                    <p>Menejemen Perkantoran dan Layanan Bisnis</p>
                </div>
                <div class="skill-card rgb-shadow-box">
                    <i class="fas fa-video"></i>
                    <h3>BCF</h3>
                    <p>Broadcasting dan Perfilman</p>
                </div>
            </div>
        </section>

        <!-- Prestasi -->
        <section id="prestasi">
            <h2 class="section-title rgb-shadow-text">Prestasi Sekolah</h2>
            <div class="prestasi-grid">
                <div class="prestasi-item rgb-shadow-box">
                    <img src="img/poto1.png" alt="Gambar Sekolah 1">
                    <div class="prestasi-content">
                        <h3>IT Web Desain Tecnology</h3>
                        <p>Selamat dan Sukses atas prestasi yang diraih dalam lomba kompetensi siswa tingkat kabupaten magelang pada mata lomba IT Web Design Technology</p>
                        <a href="#" class="cta-button" target="_blank">Lihat Sekolah</a>
                    </div>
                </div>
                <div class="prestasi-item rgb-shadow-box">
                    <img src="img/poto2.png" alt="Gambar Sekolah 2">
                    <div class="prestasi-content">
                        <h3>Bilingual Secretary</h3>
                        <p>Selamat dan Sukses atas prestasi yang diraih dalam lomba kompetensi siswa tingkat kabupaten magelang pada mata lomba Bilingual Secretary</p>
                        <a href="#" class="cta-button" target="_blank">Lihat Sekolah</a>
                    </div>
                </div>
                <div class="prestasi-item rgb-shadow-box">
                    <img src="img/poto3.png" alt="Gambar Sekolah 3">
                    <div class="prestasi-content">
                        <h3>Tv News Production</h3>
                        <p>Selamat dan Sukses atas prestasi yang diraih dalam lomba kompetensi siswa tingkat kabupaten magelang pada mata lomba Tv News Production.</p>
                        <a href="#" class="cta-button" target="_blank">Lihat Sekolah</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kontak -->
        <section id="contact">
            <h2 class="section-title rgb-shadow-text">Hubungi Saya</h2>
            <!-- Tambahkan ini di bagian form -->
            <form class="contact-form" action="proses/proses_kirimpesan.php" method="POST">
                <input type="text" name="pengirim" placeholder="Nama Lengkap Anda" required>
                <input type="text" name="judul" placeholder="Judul Pesan (Kritik, Pesan, dan Saran)" required>
                <textarea name="isi" rows="6" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                <button type="submit" class="cta-button">Kirim Pesan</button>
            </form>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.getElementById('pesanForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: "Anda yakin ingin mengirim pesan ini?",
                        icon: 'question',
                        background: '#1a1a1a',
                        color: '#f0f0f0',
                        showCancelButton: true,
                        confirmButtonColor: '#9b59b6',
                        cancelButtonColor: '#e91e63',
                        confirmButtonText: 'Ya, Kirim!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form setelah konfirmasi
                            this.submit();

                            // Tampilkan loading
                            Swal.fire({
                                title: 'Mengirim...',
                                text: 'Sedang memproses pesan Anda',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        }
                    });
                });

                // Notifikasi hasil pengiriman (JANGAN DIHAPUS)
                <?php if (isset($_SESSION['flash_sukses'])): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '<?= $_SESSION['flash_sukses'] ?>',
                        background: "#1a1a1a",
                        confirmButtonColor: "#9b59b6"
                    });
                    <?php unset($_SESSION['flash_sukses']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['flash_error'])): ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '<?= $_SESSION['flash_error'] ?>',
                        background: "#1a1a1a",
                        confirmButtonColor: "#e91e63"
                    });
                    <?php unset($_SESSION['flash_error']); ?>
                <?php endif; ?>
            </script>
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
        <p>&copy; 2025 &mdash; Dibuat oleh Tim PKL</p>
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