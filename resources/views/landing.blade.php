<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPK Rekomendasi Tanaman - Presisi Agrikultur Metode SAW</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    
    <style>
        :root {
            --charcoal-brown: #212922;
            --pine-teal: #294936;
            --granite: #3e6259;
            --jungle-teal: #5b8266;
            --celadon: #aef6c7;
            
            --charcoal-rgb: 33, 41, 34;
            --pine-rgb: 41, 73, 54;
            --granite-rgb: 62, 98, 89;
            --jungle-rgb: 91, 130, 102;
            --celadon-rgb: 174, 246, 199;

            --font-main: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-main);
        }

        body {
            background-color: var(--charcoal-brown);
            color: #f0f4f1;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Gradient background helper */
        .bg-gradient-top {
            background: linear-gradient(180deg, var(--charcoal-brown) 0%, var(--pine-teal) 50%, var(--charcoal-brown) 100%);
        }

        /* Header / Navigation */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(33, 41, 34, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(62, 98, 89, 0.4);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 2rem;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.35rem;
        }

        .brand-logo i {
            color: var(--celadon);
            font-size: 1.5rem;
            filter: drop-shadow(0 0 8px rgba(174, 246, 199, 0.4));
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: #d1ded5;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.25s ease;
        }

        .nav-links a:hover {
            color: var(--celadon);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-outline {
            padding: 0.6rem 1.4rem;
            border: 1px solid var(--granite);
            color: var(--celadon);
            background: transparent;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            border-color: var(--celadon);
            background: rgba(174, 246, 199, 0.1);
            transform: translateY(-2px);
        }

        .btn-primary-celadon {
            padding: 0.65rem 1.6rem;
            background: var(--celadon);
            color: var(--charcoal-brown);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 4px 20px rgba(174, 246, 199, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary-celadon:hover {
            background: #cbf9d8;
            box-shadow: 0 6px 25px rgba(174, 246, 199, 0.5);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            padding: 10rem 2rem 6rem;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            min-height: 85vh;
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(41, 73, 54, 0.6);
            border: 1px solid var(--jungle-teal);
            border-radius: 50px;
            color: var(--celadon);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .badge-pill i {
            font-size: 0.8rem;
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: #ffffff;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--celadon) 0%, var(--jungle-teal) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-description {
            font-size: 1.1rem;
            color: #b8c9bc;
            margin-bottom: 2.5rem;
            max-width: 540px;
        }

        .hero-buttons {
            display: flex;
            gap: 1.2rem;
            align-items: center;
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 3.5rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(62, 98, 89, 0.4);
        }

        .stat-item h3 {
            font-size: 1.8rem;
            color: var(--celadon);
            font-weight: 700;
        }

        .stat-item p {
            font-size: 0.85rem;
            color: #9ab0a0;
        }

        /* Hero Graphic / Interactive Card Preview */
        .hero-preview-card {
            background: rgba(41, 73, 54, 0.4);
            border: 1px solid rgba(91, 130, 102, 0.4);
            border-radius: 24px;
            padding: 2rem;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            position: relative;
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(62, 98, 89, 0.4);
        }

        .preview-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--celadon);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .preview-matrix-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 1rem;
            background: rgba(33, 41, 34, 0.6);
            border-radius: 12px;
            margin-bottom: 0.8rem;
            border: 1px solid rgba(62, 98, 89, 0.3);
        }

        .crop-name {
            font-weight: 600;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .crop-name i {
            color: var(--jungle-teal);
        }

        .match-score {
            font-weight: 700;
            color: var(--celadon);
            background: rgba(174, 246, 199, 0.15);
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        /* Features Section */
        .section-features {
            padding: 6rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 4rem;
        }

        .section-subtitle {
            color: var(--celadon);
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 2.3rem;
            font-weight: 800;
            color: #ffffff;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            background: rgba(41, 73, 54, 0.3);
            border: 1px solid rgba(62, 98, 89, 0.4);
            border-radius: 20px;
            padding: 2.2rem;
            transition: all 0.35s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            border-color: var(--jungle-teal);
            background: rgba(41, 73, 54, 0.6);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: rgba(174, 246, 199, 0.15);
            color: var(--celadon);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            color: #ffffff;
            margin-bottom: 0.8rem;
            font-weight: 700;
        }

        .feature-card p {
            color: #a3b8aa;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Process Steps */
        .section-steps {
            background: linear-gradient(180deg, var(--charcoal-brown) 0%, var(--pine-teal) 100%);
            padding: 6rem 2rem;
            border-top: 1px solid rgba(62, 98, 89, 0.3);
            border-bottom: 1px solid rgba(62, 98, 89, 0.3);
        }

        .steps-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3.5rem;
        }

        .step-item {
            position: relative;
            background: rgba(33, 41, 34, 0.7);
            border: 1px solid var(--granite);
            border-radius: 20px;
            padding: 2rem;
        }

        .step-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--celadon);
            opacity: 0.8;
            margin-bottom: 1rem;
        }

        .step-item h4 {
            font-size: 1.15rem;
            color: #ffffff;
            margin-bottom: 0.6rem;
            font-weight: 700;
        }

        .step-item p {
            color: #a3b8aa;
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 2rem;
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .cta-card {
            background: linear-gradient(135deg, var(--pine-teal) 0%, var(--granite) 100%);
            border: 1px solid var(--jungle-teal);
            border-radius: 28px;
            padding: 4rem 2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        .cta-card h2 {
            font-size: 2.4rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .cta-card p {
            color: #cde0d2;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 2.5rem;
        }

        /* Footer */
        footer {
            border-top: 1px solid rgba(62, 98, 89, 0.4);
            padding: 2.5rem 2rem;
            text-align: center;
            background: var(--charcoal-brown);
        }

        footer p {
            color: #7b9482;
            font-size: 0.9rem;
        }

        footer a {
            color: var(--celadon);
            text-decoration: none;
        }

        /* Responsive Media Queries */
        @media (max-width: 992px) {
            .hero {
                grid-template-columns: 1fr;
                padding-top: 8rem;
                text-align: center;
            }
            .hero-description {
                margin: 0 auto 2rem;
            }
            .hero-buttons {
                justify-content: center;
            }
            .hero-stats {
                justify-content: center;
            }
            .features-grid, .steps-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="nav-container">
            <a href="{{ route('landing') }}" class="brand-logo" id="landing-brand-logo">
                <i class="fas fa-seedling"></i>
                <span>SPK Tanaman</span>
            </a>

            <ul class="nav-links">
                <li><a href="#fitur" id="nav-fitur">Fitur Utama</a></li>
                <li><a href="#metode" id="nav-metode">Metode SAW</a></li>
                <li><a href="#alur" id="nav-alur">Alur Kerja</a></li>
            </ul>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard.index') }}" class="btn-primary-celadon" id="nav-btn-dashboard">
                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline" id="nav-btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary-celadon" id="nav-btn-register">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="badge-pill">
                <i class="fas fa-leaf"></i>
                <span>Presisi Agrikultur Berbasis AI & SAW</span>
            </div>
            <h1 class="hero-title">
                Rekomendasi Tanaman Presisi untuk <span>Hasil Panen Maksimal</span>
            </h1>
            <p class="hero-description">
                Sistem Pendukung Keputusan cerdas yang menganalisis parameter fisik lingkungan (suhu, kelembaban, curah hujan, air, dan jenis tanah) menggunakan metode Simple Additive Weighting (SAW).
            </p>
            <div class="hero-buttons">
                @auth
                    <a href="{{ route('perhitungan.index') }}" class="btn-primary-celadon" id="hero-btn-mulai">
                        <i class="fas fa-calculator mr-2"></i> Mulai Perhitungan
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary-celadon" id="hero-btn-daftar">
                        <i class="fas fa-seedling mr-2"></i> Mulai Sekarang Gratis
                    </a>
                    <a href="{{ route('login') }}" class="btn-outline" id="hero-btn-login">
                        Masuk ke Akun
                    </a>
                @endauth
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <h3>5 Parameter</h3>
                    <p>Kriteria Fisik Lahan</p>
                </div>
                <div class="stat-item">
                    <h3>SAW Engine</h3>
                    <p>Fuzzy Linear Normalization</p>
                </div>
                <div class="stat-item">
                    <h3>PDF & Excel</h3>
                    <p>Laporan Rekomendasi</p>
                </div>
            </div>
        </div>

        <!-- Interactive Live Preview Card Graphic -->
        <div class="hero-preview-card">
            <div class="preview-header">
                <div class="preview-title">
                    <i class="fas fa-chart-pie"></i>
                    Simulasi Rekomendasi Teratas
                </div>
                <span style="font-size: 0.8rem; color: #aef6c7; background: rgba(174, 246, 199, 0.1); padding: 2px 8px; border-radius: 10px;">Live Preview</span>
            </div>

            <div class="preview-matrix-item">
                <div class="crop-name">
                    <i class="fas fa-seedling"></i> Padi Sawah
                </div>
                <div class="match-score">Score V = 1.0000</div>
            </div>

            <div class="preview-matrix-item">
                <div class="crop-name">
                    <i class="fas fa-leaf"></i> Jagung Hibrida
                </div>
                <div class="match-score" style="color: #92dbaa;">Score V = 0.8750</div>
            </div>

            <div class="preview-matrix-item">
                <div class="crop-name">
                    <i class="fas fa-pepper-hot"></i> Cabai Merah
                </div>
                <div class="match-score" style="color: #79c492;">Score V = 0.7200</div>
            </div>

            <div class="preview-matrix-item">
                <div class="crop-name">
                    <i class="fas fa-mortar-pestle"></i> Bawang Merah
                </div>
                <div class="match-score" style="color: #62a879;">Score V = 0.6500</div>
            </div>

            <div style="margin-top: 1.2rem; text-align: center; font-size: 0.85rem; color: #9ab0a0;">
                <i class="fas fa-check-circle text-success mr-1"></i> Terkalibrasi secara ilmiah berdasarkan bobot kriteria
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="section-features" id="fitur">
        <div class="section-header">
            <div class="section-subtitle">Fitur Unggulan</div>
            <h2 class="section-title">Solusi Keputusan Agrikultur Berbasis Data</h2>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <h3>Analisis Parameter Lahan</h3>
                <p>Mengukur variabel Suhu (°C), Curah Hujan (mm), Kelembaban (%), Ketersediaan Air, dan Jenis Tanah secara presisi.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h3>Algoritma SAW Hibrid</h3>
                <p>Menggabungkan exact binary matching kategorikal dan distance-based linear fuzzy normalization untuk hasil optimal.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-file-export"></i>
                </div>
                <h3>Export PDF & Excel</h3>
                <p>Cetak laporan rekomendasi tanaman dalam format dokumen PDF atau file spreadsheet Excel CSV secara langsung.</p>
            </div>
        </div>
    </section>

    <!-- Alur Kerja -->
    <section class="section-steps" id="alur">
        <div class="steps-container">
            <div class="section-header">
                <div class="section-subtitle">Langkah Mudah</div>
                <h2 class="section-title">Bagaimana Sistem Bekerja?</h2>
            </div>

            <div class="steps-grid">
                <div class="step-item">
                    <div class="step-number">01</div>
                    <h4>Input Kondisi Lahan</h4>
                    <p>Masukkan data parameter fisik lingkungan tanah dan cuaca pada form interaktif yang telah disediakan.</p>
                </div>

                <div class="step-item">
                    <div class="step-number">02</div>
                    <h4>Kalkulasi SAW Real-time</h4>
                    <p>Engine SPK secara otomatis menghitung matriks keputusan, ternormalisasi, dan perkalian bobot preferensi kriteria.</p>
                </div>

                <div class="step-item">
                    <div class="step-number">03</div>
                    <h4>Dapatkan Rekomendasi</h4>
                    <p>Sistem menyajikan perankingan komoditas tanaman paling ideal beserta visualisasi Match Radar Chart.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-card">
            <h2>Siap Meningkatkan Hasil Panen Anda?</h2>
            <p>Dapatkan keputusan pemeliharaan tanaman yang ilmiah, terukur, dan akurat bersama SPK Tanaman.</p>
            @auth
                <a href="{{ route('perhitungan.index') }}" class="btn-primary-celadon" id="cta-btn-perhitungan">
                    <i class="fas fa-calculator mr-2"></i> Hitung Rekomendasi Sekarang
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary-celadon" id="cta-btn-daftar-sekarang">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Akun Petani Gratis
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} <strong>SPK Tanaman - Metode SAW</strong>. Developed with <i class="fas fa-heart text-danger"></i> for Indonesian Agriculture by RizalRio.</p>
    </footer>

</body>
</html>