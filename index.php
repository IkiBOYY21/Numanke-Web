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
     position: fixed; top: 0; left: 0; width: 100%; height: 100vh;
     background: linear-gradient(135deg, #FFFFFF 0%, #F5F5F5 100%);
     display: flex; justify-content: center; align-items: center;
     z-index: 999999; transition: opacity 0.6s ease, visibility 0.6s ease;
  }
  .loading-logo {
     width: 150px; aspect-ratio: 1/1; object-fit: cover; border-radius: 50%;
     animation: pulseLogo 1.5s infinite ease-in-out; border: 4px solid rgba(204, 0, 0, 0.3);
     box-shadow: 0 0 20px rgba(204, 0, 0, 0.2);
  }
  @keyframes pulseLogo {
     0% { transform: scale(0.9); opacity: 0.8; box-shadow: 0 0 10px rgba(204, 0, 0, 0.2); }
     50% { transform: scale(1.1); opacity: 1; box-shadow: 0 0 30px rgba(204, 0, 0, 0.4); }
     100% { transform: scale(0.9); opacity: 0.8; box-shadow: 0 0 10px rgba(204, 0, 0, 0.2); }
  }
  .preloader-hidden { opacity: 0; visibility: hidden; }

    body {
        background: linear-gradient(135deg, #FFFFFF 0%, #FFF5F5 50%, #FFFAF9 100%);
        background-attachment: fixed;
        color: #333333;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(204, 0, 0, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 90% 80%, rgba(255, 215, 0, 0.03) 0%, transparent 50%),
            repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(204, 0, 0, 0.01) 2px,
                rgba(204, 0, 0, 0.01) 4px
            );
        pointer-events: none;
        z-index: 1;
    }

    * {
        position: relative;
        z-index: 2;
    }

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    @keyframes rotateGradient {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .glass-card {
        background: linear-gradient(135deg, #FFFFFF 0%, #FFF5F5 50%, #FFFAF9 100%);
        border: 2px solid rgba(204, 0, 0, 0.25);
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(204, 0, 0, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(204, 0, 0, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.8);
        border-color: rgba(204, 0, 0, 0.4);
    }

    .btn-hover-glow {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .btn-hover-glow::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        z-index: 0;
    }

    .btn-hover-glow:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-hover-glow:hover {
        transform: scale(1.08);
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.4), 0 0 60px rgba(160, 0, 0, 0.2);
    }

    section {
        background-color: transparent !important;
        position: relative;
        z-index: 2;
    }

    /* --- HERO SECTION STYLES --- */
    .hero-arc-section {
        min-height: 70vh;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 15px 30px 15px;
        overflow: hidden;
        position: relative;
        background: linear-gradient(135deg, rgba(204, 0, 0, 0.7) 0%, rgba(153, 0, 0, 0.7) 100%), 
                    url('assets/images/foto\ depan\ numanke.png') center/cover no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .hero-arc-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 50%, rgba(0, 0, 0, 0.4) 100%);
        z-index: 0;
    }

    .hero-arc-container {
        position: absolute;
        top: 50%;
        right: 5%;
        width: 100%;
        max-width: 450px;
        aspect-ratio: 1/1;
        margin: 0;
        transform: translateY(-50%);
        display: none;
    }

    .hero-arc-dashed,
    .hero-arc-item,
    .hero-arc-image-wrapper,
    .hero-arc-order-btn {
        display: none;
    }

    @media (max-width: 992px) {
        .hero-arc-section {
            min-height: auto;
            padding: 40px 12px 30px 12px;
        }
    }

    @media (max-width: 576px) {
        .hero-arc-section {
            padding: 35px 12px 25px 12px;
        }
    }

    .wa-contact-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.15);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: block;
        position: relative;
    }

    .wa-contact-btn:hover {
        background: rgba(46, 204, 113, 0.1);
        border-color: rgba(46, 204, 113, 0.6);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4), 0 0 20px rgba(46, 204, 113, 0.3);
    }

    .wa-contact-btn:hover .icon-circle {
        transform: scale(1.15);
        box-shadow: 0 0 20px rgba(46, 204, 113, 0.5) !important;
    }

    .icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 0 15px currentColor;
    }

    @keyframes badgeBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .showcase-card {
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid rgba(204, 0, 0, 0.2) !important;
        background: linear-gradient(135deg, #FFFFFF 0%, #FFF5F5 50%, #FFFAF9 100%) !important;
        box-shadow: 0 8px 25px rgba(204, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.8) !important;
    }

    .showcase-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(204, 0, 0, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.8) !important;
        border-color: rgba(204, 0, 0, 0.35) !important;
    }

    .showcase-image {
        position: relative;
        transition: all 0.6s ease;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(204, 0, 0, 0.12), rgba(255, 215, 0, 0.06)) !important;
        border-bottom: 2px solid rgba(204, 0, 0, 0.15);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1, h2, h3, h4, h5, h6 {
        animation: fadeInUp 0.8s ease-out;
    }

    .lead {
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .btn {
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .filosofi-card {
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #FFFFFF 0%, #FFFBF9 100%) !important;
        border: 2px solid rgba(204, 0, 0, 0.2) !important;
        box-shadow: 0 8px 25px rgba(204, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .filosofi-card:hover {
        transform: translateY(-8px);
        background: linear-gradient(135deg, #FFFFFF 0%, #FFFBF9 100%) !important;
        border-color: rgba(204, 0, 0, 0.35) !important;
        box-shadow: 0 20px 50px rgba(204, 0, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .filosofi-img {
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid rgba(204, 0, 0, 0.15) !important;
    }

    .filosofi-card:hover .filosofi-img {
        transform: scale(1.05);
        filter: brightness(1.05) drop-shadow(0 0 15px rgba(204, 0, 0, 0.15));
        border-color: rgba(204, 0, 0, 0.25) !important;
    }
</style>

<!-- 1. SECTION HOME (HERO BANNER) -->
<section id="home" class="hero-arc-section">
    <div class="container-fluid px-2 px-sm-3" style="position: relative; z-index: 10;">
        <div class="row align-items-center g-2 g-md-3">
            <!-- Text Content dengan Card -->
            <div class="col-lg-5 col-xl-4" data-aos="fade-right">
                <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 18px; padding: 28px 24px; border: 2px solid rgba(255, 255, 255, 0.5); box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                    <h1 class="fw-bold mb-2" style="color: #333333; line-height: 1.05; font-size: clamp(1.4rem, 3.8vw, 2.2rem);">
                        Sensasi Pedas<br><span style="color: #CC0000; font-weight: 900;">Ayam Brongot</span><br>Juara!
                    </h1>
                    
                    <p class="mb-3" style="color: #666666; font-size: clamp(0.8rem, 1.6vw, 0.95rem); line-height: 1.5;">
                        Nikmati perpaduan bumbu rempah rahasia Nusantara yang dibakar sempurna hingga meresap ke tulang.    
                    </p>
                    
                    <div class="d-flex gap-1 gap-sm-2 flex-column flex-sm-row">
                        <a href="order.php" class="btn fw-bold btn-hover-glow" style="background: linear-gradient(135deg, #CC0000 0%, #990000 100%); color: white; border: none; box-shadow: 0 8px 20px rgba(204, 0, 0, 0.3); padding: 9px 18px; font-size: clamp(0.8rem, 1.6vw, 0.9rem); flex: 1; border-radius: 12px;">
                            <i class="fa-solid fa-utensils me-1"></i>Pesan
                        </a>
                        <a href="#showcase" class="btn fw-bold btn-hover-glow" style="background: white; border: 2px solid #CC0000; color: #CC0000; box-shadow: 0 8px 20px rgba(204, 0, 0, 0.15); padding: 9px 18px; font-size: clamp(0.8rem, 1.6vw, 0.9rem); flex: 1; border-radius: 12px;">
                            <i class="fa-solid fa-fire me-1"></i>Menu
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="col-lg-7 col-xl-8 position-relative d-none d-lg-flex justify-content-end align-items-center" style="z-index: 5; padding-right: 0;">
                <div style="position: relative; width: 100%; max-width: 380px; aspect-ratio: 1/1;">
                    <!-- Floating badge -->
                    <div style="position: absolute; top: 5px; right: 5px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 14px 20px; border-radius: 12px; border: 2px solid rgba(255, 255, 255, 0.5); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); text-align: center; animation: floatAnimation 3s ease-in-out infinite;">
                        <div style="font-size: 1.8rem; margin-bottom: 6px;">🌶️</div>
                        <div style="color: #CC0000; font-weight: 700; font-size: 0.9rem;">Best Seller</div>
                        <div style="color: #666666; font-size: 0.75rem; margin-top: 3px;">Favorit</div>
                    </div>
                    
                    <!-- Bottom badge -->
                    <div style="position: absolute; bottom: 15px; left: 5px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 14px 20px; border-radius: 12px; border: 2px solid rgba(255, 255, 255, 0.5); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); animation: floatAnimation 4s ease-in-out infinite 0.5s;">
                        <div style="font-size: 0.85rem; color: #CC0000; font-weight: 700; margin-bottom: 5px;">🔥 Spesial</div>
                        <div style="font-size: 1.6rem; color: #333333; font-weight: 900;">-20%</div>
                        <div style="color: #666666; font-size: 0.75rem; margin-top: 3px;">Menu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. SECTION SHOWCASE (MENU ANDALAN) -->
<section id="showcase" class="py-5" style="background: linear-gradient(135deg, rgba(255, 245, 245, 0.5) 0%, rgba(255, 255, 255, 0.3) 100%); border-bottom: 1px solid rgba(204, 0, 0, 0.1);">
    <div class="container py-5">
         <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3" style="color: #CC0000;" data-aos="fade-up">Karya Dapur Kami</h2>
            <p class="lead mx-auto p-3 rounded-4 glass-card" style="max-width: 600px; color: #666666;" data-aos="fade-up" data-aos-delay="100">
                Dipilih dan diracik dengan dedikasi tinggi. Inilah beberapa hidangan dan minuman spesial yang menjadi favorit para pelanggan setia Numanke.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 rounded-4 overflow-hidden glass-card text-dark showcase-card">
                    <div class="position-relative d-flex align-items-center justify-content-center showcase-image" style="height: 250px;">
                        <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 rounded-pill shadow-sm" style="background-color: #CC0000; color: white; animation: badgeBounce 2s ease-in-out infinite;">🌶️ Best Seller</span>
                        <span class="opacity-50" style="color: #999;">[Foto Ayam Original]</span>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h4 class="card-title fw-bold mb-3" style="color: #CC0000;">Ayam Brongot Original</h4>
                        <p class="card-text" style="color: #666666;">Potongan ayam segar yang dimarinasi selama 12 jam, dibakar perlahan dengan bumbu kecap pedas manis karamel khas Numanke.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 rounded-4 overflow-hidden glass-card text-dark showcase-card">
                    <div class="position-relative d-flex align-items-center justify-content-center showcase-image" style="height: 250px;">
                        <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 rounded-pill shadow-sm" style="background-color: #990000; color: white; animation: badgeBounce 2s ease-in-out infinite 0.3s;">🔥 Ekstra Pedas</span>
                        <span class="opacity-50" style="color: #999;">[Foto Ayam Level Dewa]</span>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h4 class="card-title fw-bold mb-3" style="color: #CC0000;">Ayam Brongot Level Dewa</h4>
                        <p class="card-text" style="color: #666666;">Bukan untuk yang lemah hati. Sensasi pedas membakar dari campuran cabai rawit merah pilihan yang menyatu dalam kelembutan daging ayam.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="card h-100 rounded-4 overflow-hidden glass-card text-dark showcase-card">
                    <div class="position-relative d-flex align-items-center justify-content-center showcase-image" style="height: 250px;">
                        <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 rounded-pill shadow-sm" style="background-color: #4ECDC4; color: white; animation: badgeBounce 2s ease-in-out infinite 0.6s;">❄️ Segar</span>
                        <span class="opacity-50" style="color: #999;">[Foto Es Teh Kampul]</span>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h4 class="card-title fw-bold mb-3" style="color: #CC0000;">Es Teh Kampul Spesial</h4>
                        <p class="card-text" style="color: #666666;">Penyegar dahaga sempurna setelah hidangan pedas. Seduhan teh wangi dengan irisan jeruk peras segar yang memberikan sensasi asam manis melegakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. SECTION ABOUT -->
<section class="filosofi-section py-5" id="filosofi" style="background: linear-gradient(135deg, rgba(255, 245, 245, 0.6) 0%, rgba(255, 250, 249, 0.4) 100%); border-top: 1px solid rgba(204, 0, 0, 0.1); border-bottom: 1px solid rgba(204, 0, 0, 0.1);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #CC0000;">Filosofi Numanke</h2>
            <p class="text-dark" style="opacity: 0.75;">Tiga pilar utama yang menjadi ruh dalam setiap sajian kami.</p>
        </div>
         <div class="row align-items-center mb-5 p-4 p-md-5 rounded-4 shadow-lg filosofi-card" data-aos="fade-up">
            <div class="col-md-5 mb-4 mb-md-0">
                <img src="assets/images/filosofi1.jpg" alt="Srawung" class="img-fluid rounded-4 shadow-lg filosofi-img" style="border: 2px solid rgba(204, 0, 0, 0.1); object-fit: cover; width: 100%; height: 300px;">
            </div>
            <div class="col-md-7 ps-md-5">
                <h3 class="fw-bold mb-3" style="color: #CC0000;">1. Srawung (Kebersamaan)</h3>
                <p class="text-dark mb-0" style="font-size: 1.1rem; opacity: 0.8; line-height: 1.8;">
                    Bukan sekadar tempat makan, Numanke adalah ruang berkumpul. Kami menyajikan hidangan untuk dinikmati bersama dalam suasana hangat dan kekeluargaan.
                </p>
            </div>
        </div>
        <div class="row align-items-center mb-5 p-4 p-md-5 rounded-4 shadow-lg filosofi-card flex-md-row-reverse" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-5 mb-4 mb-md-0 d-flex justify-content-center">
                <img src="assets/images/filosofi2.jpg" alt="Autentisitas Rasa" class="img-fluid rounded-circle shadow-lg filosofi-img" style="border: 2px solid rgba(204, 0, 0, 0.1); object-fit: cover; width: 300px; height: 300px;">
            </div>
            <div class="col-md-7 pe-md-5 text-md-start text-md-end">
                <h3 class="fw-bold mb-3" style="color: #CC0000;">2. Autentisitas Rasa</h3>
                <p class="text-dark mb-0" style="font-size: 1.1rem; opacity: 0.8; line-height: 1.8;">
                    Resep warisan yang dibuat dengan kejujuran. Kombinasi rempah pilihan dan teknik pembakaran tingkat tinggi menghadirkan cita rasa yang kaya dan berkarakter.
                </p>
            </div>
        </div>
        <div class="row align-items-center p-4 p-md-5 rounded-4 shadow-lg filosofi-card" data-aos="fade-up" data-aos-delay="400">
            <div class="col-md-5 mb-4 mb-md-0">
                <img src="assets/images/filosofi3.jpg" alt="Pelayanan Sepenuh Hati" class="img-fluid shadow-lg filosofi-img" style="border-radius: 50px 10px 50px 10px; border: 2px solid rgba(204, 0, 0, 0.1); object-fit: cover; width: 100%; height: 300px;">
            </div>
            <div class="col-md-7 ps-md-5">
                <h3 class="fw-bold mb-3" style="color: #CC0000;">3. Pelayanan Sepenuh Hati</h3>
                <p class="text-dark mb-0" style="font-size: 1.1rem; opacity: 0.8; line-height: 1.8;">
                    Setiap piring yang keluar dari dapur adalah bentuk penghormatan. Kami melayani Anda bak keluarga sendiri dengan senyum dan keikhlasan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 4. SECTION CONTACT -->
<section id="contact" class="py-5" style="background: linear-gradient(135deg, rgba(255, 245, 245, 0.5) 0%, rgba(255, 255, 255, 0.3) 100%); border-top: 1px solid rgba(204, 0, 0, 0.1);">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-dark mb-3">Kunjungi & Nikmati</h2>
            <p class="lead mx-auto mb-5 p-3 rounded-4 glass-card" style="max-width: 600px; color: #666666;">
                Pintu kami selalu terbuka untuk Anda. Butuh reservasi tempat atau pemesanan dalam jumlah besar? Staf kami siap membantu Anda.
            </p>
        </div>
        
        <!-- Layout Peta di Kiri, Kontak di Kanan -->
        <div class="row g-4">
            
            <!-- KOLOM KIRI: LOKASI & GOOGLE MAPS -->
            <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
                <div class="p-4 rounded-4 shadow-lg h-100 border-top border-4 glass-card d-flex flex-column text-start" style="border-color: #CC0000 !important; color: #333333;">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-location-dot fs-2" style="color: #CC0000;"></i>
                        <h3 class="fw-bold mb-0 h4 ms-3" style="color: #CC0000;">Lokasi Kami</h3>
                    </div>
                    
                    <p class="mb-4" style="color: #666666;">
                        <a href="https://maps.app.goo.gl/yZiiLaGTeUJ3g9gP8" class="text-dark text-decoration-none btn-hover-glow d-inline-block" target="_blank">
                            Jl. Pete Sel. No.18, Sekaran, Kec. Gn. Pati, Kota Semarang, Jawa Tengah 50229
                        </a>
                    </p>
                    
                    <!-- Google Maps Embed iframe -->
                    <div class="w-100 flex-grow-1 rounded-4 overflow-hidden shadow" style="min-height: 350px; border: 1px solid rgba(204, 0, 0, 0.15);">
                        <iframe 
                            src="https://maps.google.com/maps?q=Jl.%20Pete%20Sel.%20No.18,%20Sekaran,%20Semarang&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
            
            <!-- KOLOM KANAN: HUBUNGI KAMI & JAM OPERASIONAL -->
            <div class="col-lg-5 d-flex flex-column gap-4">
                
                <!-- Card: Hubungi Kami -->
                <div class="p-4 rounded-4 shadow-lg border-top border-4 glass-card text-start" data-aos="fade-left" data-aos-delay="400" style="border-color: #CC0000 !important; color: #333333;">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fa-brands fa-whatsapp fs-2" style="color: #25D366;"></i>
                        <h3 class="fw-bold mb-0 h4 ms-3" style="color: #CC0000;">Hubungi Kami</h3>
                    </div>
                    
                    <div class="d-flex flex-column gap-3 w-100">
                        <a href="https://wa.me/62882006236802" target="_blank" class="wa-contact-btn text-decoration-none p-3 rounded-4 w-100" style="background: rgba(204, 0, 0, 0.05); border: 1px solid rgba(204, 0, 0, 0.2);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle bg-success text-white shadow-sm flex-shrink-0">
                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                </div>
                                <div class="text-start">
                                    <span class="d-block fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px; color: #CC0000;">PEMESANAN</span>
                                    <span class="fw-semibold text-dark" style="font-size: 0.95rem;">+62 882-0062-36802</span>
                                </div>
                            </div>
                        </a>
                        
                        <a href="https://wa.me/6288802732001" target="_blank" class="wa-contact-btn text-decoration-none p-3 rounded-4 w-100" style="background: rgba(204, 0, 0, 0.05); border: 1px solid rgba(204, 0, 0, 0.2);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle text-white shadow-sm flex-shrink-0" style="background-color: #4ECDC4;">
                                    <i class="fa-solid fa-handshake"></i>
                                </div>
                                <div class="text-start">
                                    <span class="d-block fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px; color: #CC0000;">OPERASIONAL & MITRA</span>
                                    <span class="fw-semibold text-dark" style="font-size: 0.95rem;">+62 888-0273-2001</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Card: Jam Operasional -->
                <div class="p-4 rounded-4 shadow-lg border-top border-4 glass-card text-start flex-grow-1 d-flex flex-column justify-content-center" data-aos="fade-left" data-aos-delay="600" style="border-color: #CC0000 !important; color: #333333;">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-regular fa-clock fs-2" style="color: #CC0000;"></i>
                        <h3 class="fw-bold mb-0 h4 ms-3" style="color: #CC0000;">Jam Operasional</h3>
                    </div>
                    <p style="color: #666666; margin-bottom: 0; font-size: 1.1rem; padding-left: 3rem;">Senin - Minggu<br>10:00 - 21:00 WIB</p>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- SCRIPT UNTUK HERO ARC MENU & PRELOADER -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const heroMenus = [
            { name: 'Geprek Keju', img: 'assets/images/image_68b9f7.jpg' },
            { name: 'Brongot Dewata', img: 'assets/images/image_fc0d3a.jpg' },
            { name: 'Ayam Brongot Ori', img: 'assets/images/foto depan numanke.png' }, 
            { name: 'Brongot Freeze', img: 'assets/images/image_68b9f7.jpg' },
            { name: 'Es Teh Kampul', img: 'assets/images/image_fc0d3a.jpg' }
        ];

        const container = document.getElementById('heroArcContainer');
        const itemsBox = document.getElementById('heroArcItems');
        const mainImg = document.getElementById('heroArcMainImage');

        function renderHeroArc() {
            itemsBox.innerHTML = ''; 
            const w = container.offsetWidth;
            const radius = w / 2;
            const cx = radius;
            const cy = radius;
            
            const startAngle = 195; 
            const endAngle = 345;
            const angleStep = (endAngle - startAngle) / (heroMenus.length - 1);

            heroMenus.forEach((menu, index) => {
                const angle = startAngle + (index * angleStep);
                const rad = angle * (Math.PI / 180);
                
                const x = cx + radius * Math.cos(rad);
                const y = cy + radius * Math.sin(rad);

                const div = document.createElement('div');
                div.className = 'hero-arc-item' + (index === 2 ? ' active' : ''); 
                div.style.left = x + 'px';
                div.style.top = y + 'px';
                
                const textRotation = angle + 90;
                const textOffset = -30; 
                
                div.innerHTML = `
                    <div class="hero-arc-dot"></div>
                    <div class="hero-arc-text" style="transform: translate(-50%, -50%) rotate(${textRotation}deg) translateY(${textOffset}px);">
                        ${menu.name}
                    </div>
                `;
                
                div.addEventListener('click', () => {
                    if (div.classList.contains('active')) return;
                    
                    document.querySelectorAll('.hero-arc-item').forEach(el => el.classList.remove('active'));
                    div.classList.add('active');
                    
                    mainImg.classList.add('hide');
                    setTimeout(() => {
                        mainImg.src = menu.img;
                        mainImg.classList.remove('hide');
                    }, 400); 
                });

                itemsBox.appendChild(div);
            });
        }

        renderHeroArc();
        window.addEventListener('resize', renderHeroArc);
    });

    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        setTimeout(function() {
            preloader.classList.add('preloader-hidden');
        }, 800); 
    });
</script>

<?php require_once 'includes/footer.php'; ?>