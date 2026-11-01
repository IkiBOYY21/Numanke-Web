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
        background-color: #0f0f0f;
        display: flex; justify-content: center; align-items: center;
        z-index: 999999;
        transition: opacity 0.6s ease, visibility 0.6s ease;
    }
    .loading-logo {
        width: 150px; aspect-ratio: 1/1; object-fit: cover;
        border-radius: 50%;
        animation: pulseLogo 1.5s infinite ease-in-out;
        border: 4px solid rgba(255, 215, 0, 0.5);
    }
    @keyframes pulseLogo {
        0% { transform: scale(0.9); opacity: 0.7; box-shadow: 0 0 10px rgba(255, 215, 0, 0.3); }
        50% { transform: scale(1.1); opacity: 1; box-shadow: 0 0 30px rgba(220, 53, 69, 0.6); }
        100% { transform: scale(0.9); opacity: 0.7; box-shadow: 0 0 10px rgba(255, 215, 0, 0.3); }
    }
    .preloader-hidden { opacity: 0; visibility: hidden; }

    /* Background Kayu Gelap */
    body {
        background-image: linear-gradient(rgba(15, 15, 15, 0.88), rgba(15, 15, 15, 0.88)), url('assets/images/image_68b9f7.jpg');
        background-size: cover; background-attachment: fixed; background-position: center;
        color: #ffffff; font-family: 'Poppins', sans-serif;
    }

    /* Glassmorphism & Animasi Card */
    .glass-card {
        background: rgba(30, 30, 30, 0.5) !important;
        backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .glass-card:hover { transform: translateY(-5px); box-shadow: 0 12px 40px 0 rgba(220, 53, 69, 0.3); }
    .btn-hover-glow { transition: all 0.3s ease; }
    .btn-hover-glow:hover { transform: scale(1.05); box-shadow: 0 0 20px rgba(220, 53, 69, 0.6); }
    section { background-color: transparent !important; }

    /* --- HERO ARC MENU STYLES --- */
    .hero-arc-section {
        min-height: 100vh; display: flex; align-items: center;
        padding-top: 80px; overflow: hidden;
    }
    .hero-arc-container {
        position: relative; width: 100%; max-width: 500px;
        aspect-ratio: 1/1; margin: 0 auto;
    }
    .hero-arc-dashed {
        position: absolute; top: 0; left: 0;
        width: 100%; height: 100%;
        border: 2px dashed rgba(255, 215, 0, 0.4); border-radius: 50%;
        pointer-events: none; z-index: 1;
    }
    
    /* Titik Menu Lengkung */
    .hero-arc-item { position: absolute; z-index: 10; }
    .hero-arc-dot {
        position: absolute; width: 14px; height: 14px;
        background: #1a1a1a; border: 2px solid #888; border-radius: 50%;
        transform: translate(-50%, -50%); cursor: pointer;
        transition: all 0.3s ease;
    }
    .hero-arc-item.active .hero-arc-dot, .hero-arc-dot:hover {
        background: #FFD700; border-color: #FFD700;
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.8);
        transform: translate(-50%, -50%) scale(1.5);
    }
    
    /* Teks Menu Lengkung */
    .hero-arc-text {
        position: absolute; top: 0; left: 0; white-space: nowrap;
        color: rgba(255, 255, 255, 0.6); font-size: 0.75rem;
        font-weight: 600; letter-spacing: 1px; text-transform: uppercase;
        cursor: pointer; transition: all 0.3s ease;
    }
    .hero-arc-item.active .hero-arc-text, .hero-arc-text:hover {
        color: #FFD700; text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
    }

    /* Gambar Produk Rotasi */
    .hero-arc-image-wrapper {
        position: absolute; top: 15%; left: 15%;
        width: 70%; height: 70%; border-radius: 50%;
        z-index: 5; overflow: hidden; pointer-events: none;
    }
    .hero-arc-image {
        width: 100%; height: 100%; object-fit: cover; border-radius: 50%;
        transition: transform 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55), opacity 0.5s ease;
        transform: translateY(0) rotate(0deg); opacity: 1;
    }
    .hero-arc-image.hide {
        transform: translateY(100%) rotate(-45deg); opacity: 0;
    }
    
    /* Tombol Order Overlay */
    .hero-arc-order-btn {
        position: absolute; bottom: 20%; left: 50%;
        transform: translateX(-50%); z-index: 20;
        background: rgba(15, 15, 15, 0.85); backdrop-filter: blur(5px);
        color: #FFD700; border: 1px solid rgba(255, 215, 0, 0.5);
        padding: 10px 25px; border-radius: 50px; font-size: 0.85rem;
        font-weight: 700; letter-spacing: 1px; transition: all 0.3s ease;
        text-decoration: none; box-shadow: 0 5px 15px rgba(0,0,0,0.5);
    }
    .hero-arc-order-btn:hover {
        background: #FFD700; color: #000; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);
    }

    /* --- STYLE TOMBOL WHATSAPP KONTAK --- */
    .wa-contact-btn {
        background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease; display: block;
    }
    .wa-contact-btn:hover {
        background: rgba(255, 255, 255, 0.1); border-color: rgba(46, 204, 113, 0.5);
        transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .wa-contact-btn:hover .icon-circle { transform: scale(1.1); }
    .icon-circle {
        width: 42px; height: 42px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; transition: transform 0.3s ease;
    }
</style>

<!-- 1. SECTION HOME (HERO ARC MENU) -->
<section id="home" class="hero-arc-section mt-3">
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
            
            <!-- Interaktif Arc Menu Kanan -->
            <div class="col-lg-6 position-relative d-flex justify-content-center" data-aos="zoom-in" data-aos-delay="200">
                <div class="position-absolute top-50 start-50 translate-middle rounded-circle" style="width: 100%; max-width: 450px; aspect-ratio: 1/1; background: radial-gradient(circle, rgba(255,215,0,0.3) 0%, rgba(0,0,0,0) 70%); filter: blur(20px); pointer-events: none; z-index: 0;"></div>
                
                <div id="heroArcContainer" class="hero-arc-container">
                    <div class="hero-arc-dashed"></div>
                    <div id="heroArcItems"></div>
                    
                    <div class="hero-arc-image-wrapper">
                        <!-- Default Image -->
                        <img src="assets/images/foto depan numanke.png" id="heroArcMainImage" class="hero-arc-image" alt="Menu Terpilih">
                    </div>
                    
                    <a href="order.php" class="hero-arc-order-btn">PESAN SEKARANG</a>
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
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-white mb-3">Kunjungi & Nikmati</h2>
            <p class="lead text-light mx-auto mb-5 p-3 rounded-4 glass-card" style="max-width: 600px;">
                Pintu kami selalu terbuka untuk Anda. Butuh reservasi tempat atau pemesanan dalam jumlah besar? Staf kami siap membantu Anda.
            </p>
        </div>
        
        <!-- Layout Baru: Peta di Kiri, Kontak di Kanan -->
        <div class="row g-4">
            
            <!-- KOLOM KIRI: LOKASI & GOOGLE MAPS -->
            <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
                <div class="p-4 text-white rounded-4 shadow-lg h-100 border-top border-danger border-4 glass-card d-flex flex-column text-start">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-location-dot fs-2 text-danger me-3"></i>
                        <h3 class="fw-bold text-warning mb-0 h4">Lokasi Kami</h3>
                    </div>
                    
                    <p class="mb-4 text-light opacity-75">
                        <a href="https://maps.app.goo.gl/yZiiLaGTeUJ3g9gP8" class="text-white text-decoration-none btn-hover-glow d-inline-block" target="_blank">
                            Jl. Pete Sel. No.18, Sekaran, Kec. Gn. Pati, Kota Semarang, Jawa Tengah 50229
                        </a>
                    </p>
                    
                    <!-- Google Maps Embed iframe -->
                    <div class="w-100 flex-grow-1 rounded-4 overflow-hidden shadow" style="min-height: 350px; border: 1px solid rgba(255,255,255,0.1);">
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
                <div class="p-4 text-white rounded-4 shadow-lg border-top border-success border-4 glass-card text-start" data-aos="fade-left" data-aos-delay="400">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fa-brands fa-whatsapp fs-2 text-success me-3"></i>
                        <h3 class="fw-bold text-warning mb-0 h4">Hubungi Kami</h3>
                    </div>
                    
                    <div class="d-flex flex-column gap-3 w-100">
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
                
                <!-- Card: Jam Operasional -->
                <div class="p-4 text-white rounded-4 shadow-lg border-top border-info border-4 glass-card text-start flex-grow-1 d-flex flex-column justify-content-center" data-aos="fade-left" data-aos-delay="600">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-regular fa-clock fs-2 text-info me-3"></i>
                        <h3 class="fw-bold text-warning mb-0 h4">Jam Operasional</h3>
                    </div>
                    <p class="text-light opacity-75 mb-0 fs-5 ps-5">Senin - Minggu<br>10:00 - 21:00 WIB</p>
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