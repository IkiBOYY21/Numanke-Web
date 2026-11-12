<?php 
require_once 'includes/header.php'; 

// Load dynamic stories from Content Manager
$stories = get_site_stories(true);
?>

<!-- Header Banner -->
<section class="py-5" style="background: linear-gradient(135deg, var(--color-red) 0%, var(--color-red-dark) 100%); color: var(--color-white); border-bottom: 3px solid var(--color-gold);">
    <div class="container text-center py-2">
        <span class="badge mb-2" style="background: rgba(255,255,255,0.2); color: var(--color-white); font-weight: 700; padding: 6px 14px; border-radius: 20px;">
            📜 KISAH PERJALANAN & FILOSOFI
        </span>
        <h1 class="font-display" style="font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 800; margin-bottom: 0.5rem;">
            Cerita Numanke<span style="color: var(--color-gold);">.</span>
        </h1>
        <p style="color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 540px; margin: 0 auto;">
            Dedikasi menyajikan cita rasa ayam bakar rempah Nusantara dengan kehangatan kekeluargaan di Sekaran, Semarang.
        </p>
    </div>
</section>

<!-- ============================================================
     1. KISAH UTAMA (AWAL MULA) – In Framed Card Box
     ============================================================ -->
<section class="section-wrapper-bg">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="section-tag-red mb-2">Awal Mula</span>
                    <h2 class="section-heading-serif">Ayam Brongot yang Meresap Hingga ke Tulang</h2>
                    <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                        Numanke bermula dari keinginan menghadirkan hidangan ayam bakar dengan karakter rasa yang pekat dan mendalam. Kata <em>“Brongot”</em> merepresentasikan teknik pembakaran di atas arang batok kelapa membara yang menghasilkan aroma smokey karamel yang khas.
                    </p>
                    <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                        Setiap potong ayam segar kami marinasi selama 12 jam dengan bumbu rempah rahasia. Saat dibakar, bumbunya mengunci sari rasa daging ayam, menghasilkan tekstur yang lembut, juicy di dalam, dan renyah berkaramel gurih di luar.
                    </p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="position-relative">
                        <img src="assets/images/filosofi1.JPG" alt="Dapur Numanke" class="w-100 rounded-4 shadow" style="height: 380px; object-fit: cover;" onerror="this.src='assets/images/bg-headingweb.png'">
                        <div class="position-absolute bottom-0 start-0 m-4 p-3 rounded-3 bg-white shadow-sm border" style="max-width: 280px;">
                            <div class="fw-bold text-dark fs-6">Dapur Numanke Sekaran</div>
                            <small class="text-muted">Jl. Pete Sel. No.18, Gunungpati</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     2. DYNAMIC STORIES & SECTIONS (DARI DASHBOARD ADMIN)
     ============================================================ -->
<?php if (!empty($stories)): ?>
<section class="section-wrapper-bg" style="padding-top: 0;">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <span class="section-tag-gold">Liputan & Warta Resto</span>
                <h2 class="section-heading-serif">Kisah Dari Balik Layar</h2>
                <p class="section-subtext">Koleksi cerita, tradisi dapur, dan kabar terbaru yang kami bagikan untuk Anda.</p>
            </div>

            <div class="row g-4">
                <?php foreach ($stories as $idx => $st): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo (($idx % 3) + 1) * 100; ?>">
                        <div class="story-web-card" style="background: #ffffff; border: 1.5px solid var(--color-border); border-radius: 20px; overflow: hidden; display: flex; flex-direction: column; height: 100%; box-shadow: var(--shadow-card);">
                            <div class="story-web-img-box" style="width: 100%; height: 220px; max-height: 220px; overflow: hidden; position: relative; background: #f8fafc; flex-shrink: 0;">
                                <span class="story-web-badge" style="position: absolute; top: 12px; left: 12px; z-index: 2; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; background: rgba(255, 255, 255, 0.95); color: var(--color-red); box-shadow: 0 2px 8px rgba(0,0,0,0.1);"><?php echo htmlspecialchars($st['badge'] ?? 'Cerita'); ?></span>
                                <img src="<?php echo htmlspecialchars($st['image']); ?>" alt="<?php echo htmlspecialchars($st['title']); ?>" style="width: 100%; height: 100%; max-height: 220px; object-fit: cover; display: block;" onerror="this.src='assets/images/bg-headingweb.png'">
                            </div>
                            <div class="story-web-body">
                                <div class="story-web-date">
                                    <i class="fa-regular fa-calendar-days me-1"></i> <?php echo htmlspecialchars($st['date'] ?? '-'); ?> • <span style="color:var(--color-red);"><?php echo htmlspecialchars($st['category'] ?? 'Dapur'); ?></span>
                                </div>
                                <h3 class="story-web-title"><?php echo htmlspecialchars($st['title']); ?></h3>
                                <p class="story-web-desc">
                                    <?php echo nl2br(htmlspecialchars($st['content'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================
     3. TIGA PILAR FILOSOFI – In Framed Card Box
     ============================================================ -->
<section class="section-wrapper-bg" style="padding-top: 0;">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <span class="section-tag-gold">Nilai-Nilai Utama</span>
                <h2 class="section-heading-serif">Tiga Pilar Filosofi</h2>
                <p class="section-subtext">Prinsip dasar yang kami rawat dalam setiap sajian yang tersaji di meja Anda.</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-ticket-clean h-100">
                        <span class="section-tag-red mb-3">01. Kebersamaan</span>
                        <h4 class="font-display fs-4 text-dark mb-2">Srawung</h4>
                        <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                            Numanke adalah tempat bertemunya tawa, cerita, dan kebersamaan. Setiap piring disajikan untuk dinikmati bersama kawan dan keluarga.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-ticket-clean h-100">
                        <span class="section-tag-gold mb-3">02. Kualitas</span>
                        <h4 class="font-display fs-4 text-dark mb-2">Autentisitas</h4>
                        <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                            Tidak ada jalan pintas. Rempah segar pilihan, arang batok alami, dan sambal ulek dadakan adalah komitmen rasa kami tanpa kompromi.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-ticket-clean h-100">
                        <span class="section-tag-red mb-3">03. Kehangatan</span>
                        <h4 class="font-display fs-4 text-dark mb-2">Keluarga</h4>
                        <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                            Kami melayani setiap pelanggan bak sanak keluarga yang bertandang ke rumah: hangat, tulus, bersih, dan penuh rasa hormat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Order -->
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="order.php" class="btn-numanke-primary" style="padding: 14px 34px; font-size: 1rem;">
                    <i class="fa-solid fa-utensils me-2"></i> Nikmati Menu Kami Sekarang
                </a>
            </div>

        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
