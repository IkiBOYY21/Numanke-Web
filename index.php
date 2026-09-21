<!-- index.php -->
<?php 
require_once 'includes/header.php'; 
?>

<!-- PRELOADER START -->
<div id="preloader">
    <img src="assets/images/logo numanke.png" alt="Loading Numanke" class="loading-logo">
</div>
<!-- PRELOADER END -->

<style>
    /* --- PRELOADER STYLES --- */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: #0f0f0f;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999999;
        transition: opacity 0.6s ease, visibility 0.6s ease;
    }

    .loading-logo {
        width: 150px;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 50%;
        animation: pulseLogo 1.5s infinite ease-in-out;
        border: 4px solid rgba(255, 215, 0, 0.5);
    }

    @keyframes pulseLogo {
        0% { transform: scale(0.9); opacity: 0.7; box-shadow: 0 0 10px rgba(255, 215, 0, 0.3); }
        50% { transform: scale(1.1); opacity: 1; box-shadow: 0 0 30px rgba(220, 53, 69, 0.6); }
        100% { transform: scale(0.9); opacity: 0.7; box-shadow: 0 0 10px rgba(255, 215, 0, 0.3); }
    }

    .preloader-hidden {
        opacity: 0;
        visibility: hidden;
    }

    /* Background Kayu Gelap */
    body {
        background-image: linear-gradient(rgba(15, 15, 15, 0.88), rgba(15, 15, 15, 0.88)), url('assets/images/image_68b9f7.jpg');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }

    /* Efek Kaca Buram Modern (Glassmorphism) */
    .glass-card {
        background: rgba(30, 30, 30, 0.5) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px 0 rgba(220, 53, 69, 0.3);
    }

    /* Animasi halus pada tombol */
    .btn-hover-glow {
        transition: all 0.3s ease;
    }
    .btn-hover-glow:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(220, 53, 69, 0.6);
    }
    
    section { background-color: transparent !important; }

    /* --- CAROUSEL HERO STYLES --- */
    .hero-carousel-container {
        width: 100%;
        max-width: 450px;
        aspect-ratio: 1/1;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        border: 8px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.5s ease, border-color 0.5s ease;
        position: relative;
        z-index: 10; /* Z-index tinggi agar pasti bisa diklik */
    }

    .hero-carousel-container:hover {
        transform: scale(1.03); 
        box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
        border-color: rgba(255, 215, 0, 0.6);
    }

    .hero-carousel-container .carousel,
    .hero-carousel-container .carousel-inner,
    .hero-carousel-container .carousel-item {
        height: 100%;
        width: 100%;
    }

    /* MEMBUAT TRANSISI GAMBAR SANGAT SMOOTH */
    .hero-carousel-container .carousel-fade .carousel-item {
        transition: opacity 1.2s ease-in-out !important;
    }

    .hero-carousel-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Memperhalus Tombol Panah (Manual Slide) */
    .hero-carousel-container .carousel-control-prev,
    .hero-carousel-container .carousel-control-next {
        z-index: 20 !important; 
        width: 25%;
        opacity: 0.6;
        transition: opacity 0.3s ease, transform 0.3s ease;
        cursor: pointer;
    }
    .hero-carousel-container:hover .carousel-control-prev,
    .hero-carousel-container:hover .carousel-control-next {
        opacity: 0.9;
    }
    .hero-carousel-container .carousel-control-prev:hover { transform: translateX(-3px); }
    .hero-carousel-container .carousel-control-next:hover { transform: translateX(3px); }

    /* --- STYLE TOMBOL WHATSAPP KONTAK --- */
    .wa-contact-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        display: block;
    }
    .wa-contact-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(46, 204, 113, 0.5);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .wa-contact-btn:hover .icon-circle {
        transform: scale(1.1);
    }
    .icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }
</style>

<!-- 1. SECTION HOME (HERO) -->
<section id="home" class="py-5 mt-3">
    <div class="container min-vh-75 d-flex align-items-center py-4">
        <div class="row align-items-center w-100 flex-column-reverse flex-lg-row">
            <!-- Teks -->
            <div class="col-lg-6 text-center text-lg-start mt-5 mt-lg-0" data-aos="fade-right">
                <h1 class="display-3 fw-bold text-white mb-3" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Sensasi Pedas <br><span style="color: #FFD700;">Ayam Brongot</span> Juara!</h1>
                <p class="lead text-light mb-4 opacity-75">Nikmati perpaduan bumbu rempah rahasia Nusantara yang dibakar sempurna hingga meresap ke tulang. Sebuah simfoni rasa untuk Anda pencinta kuliner pedas sejati.</p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="order.php" class="btn btn-danger btn-lg rounded-pill px-4 shadow-lg fw-semibold btn-hover-glow" style="background-color: #990000; border: none;">Lihat Menu & Pesan</a>
                    <a href="#showcase" class="btn btn-outline-warning btn-lg rounded-pill px-4 fw-semibold btn-hover-glow text-white border-white">Jelajahi Rasa</a>
                </div>
            </div>
            
            <!-- Gambar Hero (Slideshow Lingkaran) -->
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="200">
                <div class="position-relative d-inline-block w-100 d-flex justify-content-center">
                    
                    <!-- Tambahkan pointer-events: none; agar glow tidak menghalangi klik -->
                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle" style="width: 100%; max-width: 450px; aspect-ratio: 1/1; background: radial-gradient(circle, rgba(255,215,0,0.4) 0%, rgba(0,0,0,0) 70%); filter: blur(20px); z-index: 1; pointer-events: none;"></div>
                    
                    <div class="hero-carousel-container">
                        
                        <!-- Menggunakan data-bs-ride="carousel" sebagai pemicu asli bawaan Bootstrap -->
                        <div id="heroHomeCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500" data-bs-touch="true">
                            <div class="carousel-inner h-100">
                                <div class="carousel-item active h-100">
                                    <img src="assets/images/fotoslide1.png" alt="Suasana Depan Restoran Numanke">
                                </div>
                                <div class="carousel-item h-100">
                                    <img src="assets/images/fotoslide2.jpg" alt="Suasana Malam Resto">
                                </div>
                                <div class="carousel-item h-100">
                                    <img src="assets/images/fotoslide3.jpg" alt="Eksterior Resto Malam">
                                </div>
                            </div>
                            
                            <!-- Panah Kiri Manual -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroHomeCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0px 0px 5px rgba(0,0,0,0.8)); transform: scale(1.2);"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            
                            <!-- Panah Kanan Manual -->
                            <button class="carousel-control-next" type="button" data-bs-target="#heroHomeCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: drop-shadow(0px 0px 5px rgba(0,0,0,0.8)); transform: scale(1.2);"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. SECTION SHOWCASE (MENU ANDALAN) -->
<section id="showcase" class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3" style="color: #FFD700;" data-aos="fade-up">Karya Dapur Kami</h2>
            <p class="lead text-light mx-auto p-3 rounded-4 glass-card" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="100">
                Dipilih dan diracik dengan dedikasi tinggi. Inilah beberapa hidangan dan minuman spesial yang menjadi favorit para pelanggan setia Numanke.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 rounded-4 overflow-hidden glass-card text-white">
                    <div class="position-relative d-flex align-items-center justify-content-center" style="height: 250px; background: rgba(0,0,0,0.4);">
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 rounded-pill shadow-sm">🌶️ Best Seller</span>
                        <span class="opacity-50">[Foto Ayam Original]</span>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h4 class="card-title fw-bold mb-3 text-warning">Ayam Brongot Original</h4>
                        <p class="card-text text-light opacity-75">Potongan ayam segar yang dimarinasi selama 12 jam, dibakar perlahan dengan bumbu kecap pedas manis karamel khas Numanke.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 rounded-4 overflow-hidden glass-card text-white">
                    <div class="position-relative d-flex align-items-center justify-content-center" style="height: 250px; background: rgba(0,0,0,0.4);">
                        <span class="badge bg-dark border border-secondary position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 rounded-pill shadow-sm">🔥 Ekstra Pedas</span>
                        <span class="opacity-50">[Foto Ayam Level Dewa]</span>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h4 class="card-title fw-bold mb-3 text-warning">Ayam Brongot Level Dewa</h4>
                        <p class="card-text text-light opacity-75">Bukan untuk yang lemah hati. Sensasi pedas membakar dari campuran cabai rawit merah pilihan yang menyatu dalam kelembutan daging ayam.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="card h-100 rounded-4 overflow-hidden glass-card text-white">
                    <div class="position-relative d-flex align-items-center justify-content-center" style="height: 250px; background: rgba(0,0,0,0.4);">
                        <span class="badge bg-info text-dark position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 rounded-pill shadow-sm">❄️ Segar</span>
                        <span class="opacity-50">[Foto Es Teh Kampul]</span>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h4 class="card-title fw-bold mb-3 text-warning">Es Teh Kampul Spesial</h4>
                        <p class="card-text text-light opacity-75">Penyegar dahaga sempurna setelah hidangan pedas. Seduhan teh wangi dengan irisan jeruk peras segar yang memberikan sensasi asam manis melegakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. SECTION ABOUT -->
<section class="filosofi-section py-5" id="filosofi" style="background: transparent;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #FFD700;">Filosofi Numanke</h2>
            <p class="text-light" style="opacity: 0.9;">Tiga pilar utama yang menjadi ruh dalam setiap sajian kami.</p>
        </div>
        <div class="row align-items-center mb-5 p-4 p-md-5 rounded-4 shadow-lg" style="background-color: rgba(25, 25, 25, 0.85); border: 1px solid rgba(255, 255, 255, 0.05);">
            <div class="col-md-5 mb-4 mb-md-0">
                <img src="assets/images/filosofi1.jpg" alt="Srawung" class="img-fluid rounded-4 shadow-lg" style="border: 2px solid rgba(255,255,255,0.1); object-fit: cover; width: 100%; height: 300px;">
            </div>
            <div class="col-md-7 ps-md-5">
                <h3 class="fw-bold mb-3" style="color: #FFD700;">1. Srawung (Kebersamaan)</h3>
                <p class="text-light mb-0" style="font-size: 1.1rem; opacity: 0.85; line-height: 1.8;">
                    Bukan sekadar tempat makan, Numanke adalah ruang berkumpul. Kami menyajikan hidangan untuk dinikmati bersama dalam suasana hangat dan kekeluargaan.
                </p>
            </div>
        </div>
        <div class="row align-items-center mb-5 p-4 p-md-5 rounded-4 shadow-lg flex-md-row-reverse" style="background-color: rgba(25, 25, 25, 0.85); border: 1px solid rgba(255, 255, 255, 0.05);">
            <div class="col-md-5 mb-4 mb-md-0 d-flex justify-content-center">
                <img src="assets/images/filosofi2.jpg" alt="Autentisitas Rasa" class="img-fluid rounded-circle shadow-lg" style="border: 2px solid rgba(255,255,255,0.1); object-fit: cover; width: 300px; height: 300px;">
            </div>
            <div class="col-md-7 pe-md-5 text-md-start text-md-end">
                <h3 class="fw-bold mb-3" style="color: #FFD700;">2. Autentisitas Rasa</h3>
                <p class="text-light mb-0" style="font-size: 1.1rem; opacity: 0.85; line-height: 1.8;">
                    Resep warisan yang dibuat dengan kejujuran. Kombinasi rempah pilihan dan teknik pembakaran tingkat tinggi menghadirkan cita rasa yang kaya dan berkarakter.
                </p>
            </div>
        </div>
        <div class="row align-items-center p-4 p-md-5 rounded-4 shadow-lg" style="background-color: rgba(25, 25, 25, 0.85); border: 1px solid rgba(255, 255, 255, 0.05);">
            <div class="col-md-5 mb-4 mb-md-0">
                <img src="assets/images/filosofi3.jpg" alt="Pelayanan Sepenuh Hati" class="img-fluid shadow-lg" style="border-radius: 50px 10px 50px 10px; border: 2px solid rgba(255,255,255,0.1); object-fit: cover; width: 100%; height: 300px;">
            </div>
            <div class="col-md-7 ps-md-5">
                <h3 class="fw-bold mb-3" style="color: #FFD700;">3. Pelayanan Sepenuh Hati</h3>
                <p class="text-light mb-0" style="font-size: 1.1rem; opacity: 0.85; line-height: 1.8;">
                    Setiap piring yang keluar dari dapur adalah bentuk penghormatan. Kami melayani Anda bak keluarga sendiri dengan senyum dan keikhlasan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 4. SECTION CONTACT -->
<section id="contact" class="py-5">
    <div class="container py-5 text-center">
        <div data-aos="fade-up">
            <h2 class="display-5 fw-bold text-white mb-3">Kunjungi & Nikmati</h2>
            <p class="lead text-light mx-auto mb-5 p-3 rounded-4 glass-card" style="max-width: 600px;" data-aos="delay-100">
                Pintu kami selalu terbuka untuk Anda. Butuh reservasi tempat atau pemesanan dalam jumlah besar? Staf kami siap membantu Anda.
            </p>
        </div>
        
        <div class="row g-4 justify-content-center align-items-stretch">
            <div class="col-lg-4 col-md-6" data-aos="flip-up" data-aos-delay="200">
                <div class="p-4 text-white rounded-4 shadow-lg h-100 border-top border-danger border-4 glass-card d-flex flex-column align-items-center justify-content-center">
                    <div class="mb-3"><i class="fa-solid fa-location-dot fs-1 text-danger"></i></div>
                    <h3 class="fw-bold text-warning mb-3 h4">Lokasi Kami</h3>
                    <p class="mb-0 mt-auto"><a href="https://maps.app.goo.gl/yZiiLaGTeUJ3g9gP8" class="text-white text-decoration-none fs-6 btn-hover-glow d-inline-block" target="_blank">Jl. Pete Sel. No.18, Sekaran<br> Kec. Gn. Pati, Kota Semarang, Jawa Tengah 50229</a></p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="flip-up" data-aos-delay="400">
                <div class="p-4 text-white rounded-4 shadow-lg h-100 border-top border-success border-4 glass-card d-flex flex-column align-items-center justify-content-center">
                    <div class="mb-2"><i class="fa-brands fa-whatsapp fs-1 text-success"></i></div>
                    <h3 class="fw-bold text-warning mb-4 h4">Hubungi Kami</h3>
                    
                    <div class="d-flex flex-column gap-3 w-100 mt-auto">
                        <a href="https://wa.me/62882006236802" target="_blank" class="wa-contact-btn text-decoration-none p-3 rounded-4 w-100">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle bg-success text-white shadow-sm flex-shrink-0">
                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                </div>
                                <div class="text-start">
                                    <span class="d-block fw-bold text-success" style="font-size: 0.75rem; letter-spacing: 0.5px;">PEMESANAN</span>
                                    <span class="text-white fw-semibold" style="font-size: 0.95rem;">+62 882-0062-36802</span>
                                </div>
                            </div>
                        </a>

                        <a href="https://wa.me/6288802732001" target="_blank" class="wa-contact-btn text-decoration-none p-3 rounded-4 w-100">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle bg-info text-white shadow-sm flex-shrink-0">
                                    <i class="fa-solid fa-handshake"></i>
                                </div>
                                <div class="text-start">
                                    <span class="d-block fw-bold text-info" style="font-size: 0.75rem; letter-spacing: 0.5px;">OPERASIONAL & MITRA</span>
                                    <span class="text-white fw-semibold" style="font-size: 0.95rem;">+62 888-0273-2001</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="flip-up" data-aos-delay="600">
                <div class="p-4 text-white rounded-4 shadow-lg h-100 border-top border-info border-4 glass-card d-flex flex-column align-items-center justify-content-center">
                    <div class="mb-3"><i class="fa-regular fa-clock fs-1 text-info"></i></div>
                    <h3 class="fw-bold text-warning mb-3 h4">Jam Operasional</h3>
                    <p class="text-light opacity-75 mb-0 mt-auto fs-5">Senin - Minggu<br>10:00 - 21:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SCRIPT UNTUK PRELOADER -->
<script>
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        setTimeout(function() {
            preloader.classList.add('preloader-hidden');
        }, 800); 
    });
</script>

<?php require_once 'includes/footer.php'; ?>