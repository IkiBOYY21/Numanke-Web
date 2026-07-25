<!-- index.php -->
<?php 
require_once 'includes/header.php'; 
?>

<!-- 1. SECTION HOME (HERO) -->
<section id="home" class="hero">
    <div class="hero-content" data-aos="fade-right">
        <h1>Sensasi Pedas <br><span>Ayam Brongot</span> Juara!</h1>
        <p>Nikmati perpaduan bumbu rempah rahasia Nusantara yang dibakar sempurna hingga meresap ke tulang. Sebuah simfoni rasa untuk Anda pencinta kuliner pedas sejati.</p>
        <div class="hero-buttons">
            <a href="order.php" class="btn btn-primary">Lihat Menu & Pesan</a>
            <a href="#showcase" class="btn btn-accent">Jelajahi Rasa</a>
        </div>
    </div>
    
    <div class="hero-image" data-aos="fade-left" data-aos-delay="200">
        <!-- Lingkaran gradien oranye diganti dengan tag <img> -->
        <img src="assets/images/foto depan numanke.png" alt="Suasana Depan Restoran Numanke" style="width: 450px; height: 450px; border-radius: 50%; object-fit: cover; box-shadow: 0 20px 40px rgba(0,0,0,0.2); border: 10px solid var(--white);">
    </div>
</section>

<!-- 2. SECTION SHOWCASE (MENU ANDALAN) -->
<section id="showcase" style="padding: 100px 5%; background-color: var(--white); text-align: center;">
    <h2 data-aos="fade-up" style="color: var(--primary-red); font-size: 3rem; margin-bottom: 15px;">Karya Dapur Kami</h2>
    <p data-aos="fade-up" data-aos-delay="100" style="color: var(--text-muted); max-width: 600px; margin: 0 auto 50px auto; font-size: 1.1rem;">
        Dipilih dan diracik dengan dedikasi tinggi. Inilah beberapa hidangan dan minuman spesial yang menjadi favorit para pelanggan setia Numanke.
    </p>

    <div class="showcase-grid">
        <!-- Card 1 -->
        <div class="showcase-card" data-aos="fade-up" data-aos-delay="200">
            <div class="showcase-img">
                <div class="showcase-badge">🌶️ Best Seller</div>
                <div style="width: 100%; height: 100%; background: #e0e0e0; display:flex; align-items:center; justify-content:center; color:#999;">[Foto Ayam Original]</div>
            </div>
            <div class="showcase-info">
                <h3>Ayam Brongot Original</h3>
                <p>Potongan ayam segar yang dimarinasi selama 12 jam, dibakar perlahan dengan bumbu kecap pedas manis karamel khas Numanke.</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="showcase-card" data-aos="fade-up" data-aos-delay="400">
            <div class="showcase-img">
                <div class="showcase-badge">🔥 Ekstra Pedas</div>
                <div style="width: 100%; height: 100%; background: #e0e0e0; display:flex; align-items:center; justify-content:center; color:#999;">[Foto Ayam Level Dewa]</div>
            </div>
            <div class="showcase-info">
                <h3>Ayam Brongot Level Dewa</h3>
                <p>Bukan untuk yang lemah hati. Sensasi pedas membakar dari campuran cabai rawit merah pilihan yang menyatu dalam kelembutan daging ayam.</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="showcase-card" data-aos="fade-up" data-aos-delay="600">
            <div class="showcase-img">
                <div class="showcase-badge">❄️ Segar</div>
                <div style="width: 100%; height: 100%; background: #e0e0e0; display:flex; align-items:center; justify-content:center; color:#999;">[Foto Es Teh Kampul]</div>
            </div>
            <div class="showcase-info">
                <h3>Es Teh Kampul Spesial</h3>
                <p>Penyegar dahaga sempurna setelah hidangan pedas. Seduhan teh wangi dengan irisan jeruk peras segar yang memberikan sensasi asam manis melegakan.</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. SECTION ABOUT -->
<section id="about" style="padding: 100px 5%; background-color: var(--light-bg); display: flex; align-items: center; gap: 50px;">
    <div style="flex: 1;" data-aos="zoom-in-right">
        <div style="width: 100%; height: 400px; background-color: #ddd; border-radius: 15px; display:flex; align-items:center; justify-content:center; color:#999;">
            [Foto Suasana Restoran / Dapur]
        </div>
    </div>
    <div style="flex: 1;" data-aos="fade-left">
        <h2 style="color: var(--primary-red); font-size: 2.8rem; margin-bottom: 20px;">Filosofi Numanke</h2>
        <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">
            Berawal dari resep rahasia keluarga, <strong>Numanke</strong> hadir untuk mengembalikan kejayaan rasa Nusantara yang autentik. 
            Kata "Brongot" bagi kami bukan sekadar rasa pedas yang lewat, melainkan sebuah jejak rasa—kombinasi dari rempah pilihan, arang berkualitas, dan teknik pembakaran tingkat tinggi.
        </p>
        <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8;">
            Kami percaya bahwa makanan yang baik adalah yang dibuat dengan kejujuran. Setiap piring yang keluar dari dapur kami adalah bentuk penghormatan kami terhadap seni kuliner pedas Indonesia.
        </p>
    </div>
</section>

<!-- 4. SECTION CONTACT -->
<section id="contact" style="padding: 100px 5%; background-color: var(--white); text-align: center;">
    <h2 data-aos="fade-up" style="color: var(--text-dark); font-size: 2.8rem; margin-bottom: 15px;">Kunjungi & Nikmati</h2>
    <p data-aos="fade-up" data-aos-delay="100" style="color: var(--text-muted); max-width: 600px; margin: 0 auto 50px auto; font-size: 1.1rem;">
        Pintu kami selalu terbuka untuk Anda. Butuh reservasi tempat atau pemesanan dalam jumlah besar? Staf kami siap membantu Anda.
    </p>
    
    <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
        <div data-aos="flip-up" data-aos-delay="200" style="background: var(--light-bg); padding: 40px 30px; border-radius: 15px; min-width: 280px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
            <h3 style="color: var(--primary-red); margin-bottom: 15px; font-size: 1.5rem;">Lokasi Kami</h3>
            <p style="color: var(--text-muted);">Jl. Ayam Brongot No. 1<br>Semarang, Jawa Tengah</p>
        </div>
        <div data-aos="flip-up" data-aos-delay="400" style="background: var(--light-bg); padding: 40px 30px; border-radius: 15px; min-width: 280px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
            <h3 style="color: var(--primary-red); margin-bottom: 15px; font-size: 1.5rem;">Reservasi & Pesan</h3>
            <p><a href="https://wa.me/6281234567890" style="color: var(--text-dark); font-weight: 600; font-family: 'Poppins', sans-serif; font-size: 1.1rem;">+62 812-3456-7890</a></p>
        </div>
        <div data-aos="flip-up" data-aos-delay="600" style="background: var(--light-bg); padding: 40px 30px; border-radius: 15px; min-width: 280px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
            <h3 style="color: var(--primary-red); margin-bottom: 15px; font-size: 1.5rem;">Jam Operasional</h3>
            <p style="color: var(--text-muted);">Senin - Minggu<br>10:00 - 22:00 WIB</p>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>