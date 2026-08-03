<!-- index.php -->
<?php 
require_once 'includes/header.php'; 
?>

<style>
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
        background: rgba(30, 30, 30, 0.5) !important; /* Latar tembus pandang */
        backdrop-filter: blur(12px); /* Efek blur/kaca */
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px 0 rgba(220, 53, 69, 0.3); /* Glow merah saat disorot */
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
            <!-- Gambar Hero -->
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="200">
                <div class="position-relative d-inline-block">
                    <!-- Efek Glow di belakang gambar -->
                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle" style="width: 100%; height: 100%; background: radial-gradient(circle, rgba(255,215,0,0.4) 0%, rgba(0,0,0,0) 70%); filter: blur(20px); z-index: -1;"></div>
                    
                    <img src="assets/images/foto depan numanke.png" alt="Suasana Depan Restoran Numanke" class="img-fluid rounded-circle shadow-lg" style="width: 100%; max-width: 450px; aspect-ratio: 1/1; object-fit: cover; border: 8px solid rgba(255, 255, 255, 0.1);">
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
            <!-- Card 1 -->
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

            <!-- Card 2 -->
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

            <!-- Card 3 -->
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
<section id="about" class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5 flex-column-reverse flex-lg-row">
            <div class="col-lg-6" data-aos="zoom-in-right">
                <div class="rounded-4 shadow-lg overflow-hidden d-flex align-items-center justify-content-center border border-secondary border-2" style="height: 400px;">
                    <img src="assets/images/filosofi.jpg" alt="Filosofi Numanke" class="img-fluid w-100 h-100" style="object-fit: cover; filter: brightness(0.85);">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="display-5 fw-bold mb-4" style="color: #FFD700;">Filosofi Numanke</h2>
                <div class="p-4 rounded-4 shadow-sm glass-card">
                    <p class="fs-5 text-light mb-3 opacity-100">
                        Berawal dari resep rahasia keluarga, <strong class="text-warning">Numanke</strong> hadir untuk mengembalikan kejayaan rasa Nusantara yang autentik. 
                        Kata "Brongot" bagi kami bukan sekadar rasa pedas yang lewat, melainkan sebuah jejak rasa—kombinasi dari rempah pilihan, arang berkualitas, dan teknik pembakaran tingkat tinggi.
                    </p>
                    <p class="fs-5 text-light mb-0 opacity-100">
                        Kami percaya bahwa makanan yang baik adalah yang dibuat den n kejujuran. Setiap piring yang keluar dari dapur kami adalah bentuk penghormatan kami terhadap seni kuliner pedas Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5 flex-column-reverse flex-lg-row">
            <div class="col-lg-6" data-aos="zoom-in-right">
                <div class="rounded-4 shadow-lg overflow-hidden d-flex align-items-center justify-content-center border border-secondary border-2" style="height: 400px;">
                    <img src="assets/images/filosofi.jpg" alt="Filosofi Numanke" class="img-fluid w-100 h-100" style="object-fit: cover; filter: brightness(0.85);">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="display-5 fw-bold mb-4" style="color: #FFD700;">Filosofi Numanke</h2>
                <div class="p-4 rounded-4 shadow-sm glass-card">
                    <p class="fs-5 text-light mb-3 opacity-100">
                        Berawal dari resep rahasia keluarga, <strong class="text-warning">Numanke</strong> hadir untuk mengembalikan kejayaan rasa Nusantara yang autentik. 
                        Kata "Brongot" bagi kami bukan sekadar rasa pedas yang lewat, melainkan sebuah jejak rasa—kombinasi dari rempah pilihan, arang berkualitas, dan teknik pembakaran tingkat tinggi.
                    </p>
                    <p class="fs-5 text-light mb-0 opacity-100">
                        Kami percaya bahwa makanan yang baik adalah yang dibuat dengan kejujuran. Setiap piring yang keluar dari dapur kami adalah bentuk penghormatan kami terhadap seni kuliner pedas Indonesia.
                    </p>
                </div>
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
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-4" data-aos="flip-up" data-aos-delay="200">
                <div class="p-5 text-white rounded-4 shadow-lg h-100 border-top border-danger border-4 glass-card">
                    <div class="mb-3"><i class="fa-solid fa-location-dot fs-1 text-danger"></i></div>
                    <h3 class="fw-bold text-warning mb-3 h4">Lokasi Kami</h3>
                    <p class="text-light opacity-75 mb-0">Jl. Ayam Brongot No. 1<br>Semarang, Jawa Tengah</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up" data-aos-delay="400">
                <div class="p-5 text-white rounded-4 shadow-lg h-100 border-top border-danger border-4 glass-card">
                    <div class="mb-3"><i class="fa-brands fa-whatsapp fs-1 text-success"></i></div>
                    <h3 class="fw-bold text-warning mb-3 h4">Reservasi & Pesan</h3>
                    <p class="mb-0"><a href="https://wa.me/6288802732001" class="text-white fw-bold text-decoration-none fs-5 btn-hover-glow d-inline-block">+62 888-0273-2001</a></p>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up" data-aos-delay="600">
                <div class="p-5 text-white rounded-4 shadow-lg h-100 border-top border-danger border-4 glass-card">
                    <div class="mb-3"><i class="fa-regular fa-clock fs-1 text-info"></i></div>
                    <h3 class="fw-bold text-warning mb-3 h4">Jam Operasional</h3>
                    <p class="text-light opacity-75 mb-0">Senin - Minggu<br>10:00 - 22:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>