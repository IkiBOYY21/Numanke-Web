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

    @keyframes softPulse {
        0%, 100% { filter: brightness(1) saturate(0.95); }
        50% { filter: brightness(1.02) saturate(1.05); }
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        background: linear-gradient(135deg, #FFFFFF 0%, #FFF9F0 50%, #FFFBF7 100%);
        background-attachment: fixed;
        color: #333333;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
        position: relative;
        animation: softPulse 15s ease-in-out infinite;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(204, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 90% 80%, rgba(255, 179, 0, 0.02) 0%, transparent 50%);
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

    @keyframes slideGradient {
        0% { width: 0; }
        100% { width: 100%; }
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 250, 245, 0.92) 100%);
        border: 2px solid rgba(255, 179, 0, 0.25);
        border-radius: 20px;
        box-shadow: 0 12px 35px rgba(204, 0, 0, 0.12), 0 0 25px rgba(255, 179, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 55px rgba(204, 0, 0, 0.18), 0 0 35px rgba(255, 179, 0, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
        border-color: rgba(255, 179, 0, 0.4);
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

    /* --- HERO SECTION STYLES (LAMA) - DIHAPUS, DIGANTI TAILWIND --- */
    /* Semua styling untuk hero sekarang menggunakan Tailwind CSS */

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
        border: 2px solid rgba(204, 0, 0, 0.15) !important;
        background: linear-gradient(135deg, #FFFFFF 0%, #FFFAF8 100%) !important;
        box-shadow: 0 10px 35px rgba(204, 0, 0, 0.12), 0 0 20px rgba(255, 179, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
        position: relative;
        overflow: hidden;
    }

    .showcase-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #CC0000 0%, #FFB300 100%);
        z-index: 1;
    }

    .showcase-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 60px rgba(204, 0, 0, 0.2), 0 0 30px rgba(255, 179, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
        border-color: rgba(255, 179, 0, 0.3) !important;
    }

    .showcase-card:hover::before {
        animation: slideGradient 0.6s ease;
    }

    .showcase-image {
        position: relative;
        transition: all 0.6s ease;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(204, 0, 0, 0.08), rgba(255, 179, 0, 0.05)) !important;
        border-bottom: 3px solid rgba(255, 179, 0, 0.3);
    }

    .showcase-image::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255, 179, 0, 0.5), transparent);
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
        background: linear-gradient(135deg, #CC0000 0%, #B71C1C 100%) !important;
        border: 2px solid rgba(255, 179, 0, 0.4) !important;
        box-shadow: 0 12px 40px rgba(204, 0, 0, 0.35), 0 0 30px rgba(255, 179, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.15);
    }

    .filosofi-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255, 179, 0, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .filosofi-card:hover {
        transform: translateY(-12px);
        background: linear-gradient(135deg, #E53935 0%, #C62828 100%) !important;
        border-color: rgba(255, 179, 0, 0.6) !important;
        box-shadow: 0 20px 60px rgba(204, 0, 0, 0.5), 0 0 40px rgba(255, 179, 0, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .filosofi-card h3 {
        color: #FFFFFF !important;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .filosofi-card p {
        color: rgba(255, 255, 255, 0.95) !important;
        position: relative;
        z-index: 1;
    }

    .filosofi-img {
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid rgba(255, 179, 0, 0.3) !important;
    }

    .filosofi-card:hover .filosofi-img {
        transform: scale(1.05);
        filter: brightness(1.05) drop-shadow(0 0 15px rgba(255, 179, 0, 0.15));
        border-color: rgba(255, 179, 0, 0.4) !important;
    }
</style>

<!-- 1. SECTION HOME (HERO BANNER) - MODERN & ATTRACTIVE -->
<section id="home" class="py-5" style="background: linear-gradient(135deg, rgba(204, 0, 0, 0.85) 0%, rgba(139, 0, 0, 0.85) 100%), url('assets/images/bg-headingweb.png') center/cover no-repeat; background-attachment: fixed; min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
    
    <!-- Overlay Gradient -->
    <div style="position: absolute; inset: 0; background: linear-gradient(90deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.3) 100%); z-index: 0;"></div>
    
    <!-- Content Container -->
    <div class="container position-relative" style="z-index: 10; max-width: 1200px;">
        <div class="row align-items-center g-4">
            
            <!-- LEFT COLUMN - TEXT & CTA -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                
                <!-- MAIN HEADING -->
                <div class="mb-4">
                    <h1 class="display-3 fw-black text-white mb-2" style="line-height: 1.1; text-shadow: 0 6px 20px rgba(0,0,0,0.5); animation: slideInLeft 0.8s ease-out; font-size: clamp(2.5rem, 8vw, 4rem);">Sensasi</h1>
                    <h1 class="fw-black mb-3" style="background: linear-gradient(to right, #FFB300, #FFCC00); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.1; text-shadow: 0 6px 20px rgba(0,0,0,0.3); animation: slideInLeft 0.8s ease-out 0.2s both; font-size: clamp(2.5rem, 8vw, 4rem);">Pedas Legendaris</h1>
                    
                    <p class="lead text-white-80 mb-4" style="font-size: 1.1rem; opacity: 0.9; max-width: 500px; animation: fadeIn 0.8s ease-out 0.4s both;">
                        Potongan ayam segar yang dimarinasi 12 jam, dibakar perlahan dengan bumbu rempah rahasia Nusantara. Perpaduan sempurna yang meresap hingga ke tulang.
                    </p>
                </div>
                
                <!-- CTA BUTTONS -->
                <div class="d-flex gap-3 flex-wrap" style="animation: fadeIn 0.8s ease-out 0.6s both;">
                    <!-- Circular CTA Button -->
                    <a href="order.php" class="btn rounded-circle d-flex align-items-center justify-content-center" style="width: 140px; height: 140px; background: linear-gradient(135deg, #FFB300 0%, #FFC700 100%); color: #CC0000; border: none; box-shadow: 0 10px 40px rgba(255, 179, 0, 0.4); font-weight: 900; font-size: 1.1rem; position: relative; overflow: hidden; transition: all 0.4s ease; text-decoration: none;" onmouseover="this.style.transform='scale(1.15)'; this.style.boxShadow='0 20px 60px rgba(255, 179, 0, 0.6)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 10px 40px rgba(255, 179, 0, 0.4)'">
                        <div style="text-align: center;">
                            <i class="fa-solid fa-utensils d-block mb-2" style="font-size: 1.8rem;"></i>
                            <small style="font-weight: 700;">PESAN</small>
                        </div>
                    </a>
                    
                    <!-- Secondary Button - Updated to Contact -->
                    <a href="#contact" class="btn btn-lg" style="background: transparent; border: 2px solid #FFFFFF; color: #FFFFFF; font-weight: 700; padding: 18px 35px; border-radius: 15px; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.background='transparent'; this.style.transform='translateY(0)'">
                        <i class="fa-solid fa-phone me-2"></i>Hubungi Kami
                    </a>
                </div>
                
                <!-- STATS -->
                <div class="d-flex gap-4 mt-5 flex-wrap" style="animation: fadeIn 0.8s ease-out 0.8s both;">
                    <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 15px 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateY(-5px)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                        <div class="text-warning fw-black" style="font-size: 1.8rem;">500+</div>
                        <small class="text-white-80">Pelanggan</small>
                    </div>
                    <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 15px 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateY(-5px)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                        <div class="text-warning fw-black" style="font-size: 1.8rem;">20+</div>
                        <small class="text-white-80">Menu</small>
                    </div>
                    <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 15px 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateY(-5px)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                        <div class="text-warning fw-black" style="font-size: 1.8rem;">⭐4.9</div>
                        <small class="text-white-80">Rating</small>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT COLUMN - PRODUCT IMAGE & BADGES (Desktop Only) -->
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center position-relative" style="min-height: 500px;">
                
                <!-- Product Image (Floating) -->
                <div class="position-relative" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;" data-aos="zoom-in" data-aos-delay="300">
                    <img src="assets/images/bg-headingweb.png" alt="Ayam Brongot" style="max-width: 85%; height: auto; filter: drop-shadow(0 20px 60px rgba(0,0,0,0.3)); animation: float 3s ease-in-out infinite; border-radius: 20px;">
                </div>
                
                <!-- Top Badge -->
                <div class="position-absolute" style="top: 50px; right: 50px; background: rgba(255,255,255,0.95); padding: 20px 25px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); backdrop-filter: blur(10px); animation: float 3s ease-in-out infinite; z-index: 20;" data-aos="zoom-in" data-aos-delay="500">
                    <div class="text-center">
                        <div style="font-size: 2.5rem; font-weight: 900; color: #CC0000;">★</div>
                        <small class="d-block fw-bold" style="color: #CC0000;">BEST</small>
                        <small style="color: #666;">SELLER</small>
                    </div>
                </div>
                
                <!-- Bottom Badge -->
                <div class="position-absolute" style="bottom: 80px; left: 50px; background: rgba(255,255,255,0.95); padding: 20px 25px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); backdrop-filter: blur(10px); animation: float 4s ease-in-out infinite 0.5s; z-index: 20;" data-aos="zoom-in" data-aos-delay="700">
                    <div class="text-center">
                        <div style="font-size: 2rem; font-weight: 900; color: #CC0000;">-20%</div>
                        <small style="color: #CC0000; font-weight: 700;">PROMO</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Animations -->
    <style>
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .text-white-80 { color: rgba(255,255,255,0.8); }
    </style>
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