<?php 
require_once 'includes/header.php'; 

// Load dynamic stories and settings from Content Manager
$stories = get_site_stories(true);
$hero_pill = $site_settings['hero_pill'] ?? 'Cita Rasa Otentik Sejak 2024';
$hero_title_1 = $site_settings['hero_title_line1'] ?? 'Sensasi Pedas Legendaris';
$hero_title_hi = $site_settings['hero_title_highlight'] ?? 'Ayam Brongot';
$hero_title_2 = $site_settings['hero_title_line2'] ?? 'Nusantara.';
$hero_desc = $site_settings['hero_subtitle'] ?? 'Potongan ayam pilihan dimarinasi 12 jam dengan rempah rahasia Nusantara, dibakar perlahan di atas arang batok alami, menghasilkan kelembutan daging berkaramel gurih yang meresap hingga ke tulang.';
$stat1_val = $site_settings['hero_stat_1_val'] ?? '12 Jam';
$stat1_lbl = $site_settings['hero_stat_1_lbl'] ?? 'Marinasi Rempah';
$stat2_val = $site_settings['hero_stat_2_val'] ?? '100% Arang';
$stat2_lbl = $site_settings['hero_stat_2_lbl'] ?? 'Batok Kelapa';
$stat3_val = $site_settings['hero_stat_3_val'] ?? '4.9 / 5.0';
$stat3_lbl = $site_settings['hero_stat_3_lbl'] ?? '1.500+ Ulasan';
$marquee_items = $site_settings['marquee_items'] ?? [
    "Ayam Brongot Original", "Sambal Ulek Dadakan", "Nasi Ayam Geprek Keju", 
    "Marinasi 12 Jam Meresap", "Rongot Freeze Coklat", "Es Teh Kampul Segar", "Bakar Arang Tradisional"
];
$wa_order_num = $site_settings['wa_order'] ?? '62882006236802';
$wa_order_txt = $site_settings['wa_order_display'] ?? '+62 882-0062-36802';
$wa_partner_num = $site_settings['wa_partner'] ?? '6288802732001';
$wa_partner_txt = $site_settings['wa_partner_display'] ?? '+62 888-0273-2001';
$open_hours_txt = $site_settings['open_hours'] ?? '10:00 – 21:00 WIB';
$open_days_txt = $site_settings['open_days'] ?? 'Senin – Minggu (Setiap Hari Tanpa Libur)';
?>

<!-- ============================================================
     PRELOADER – Clean & Refined
     ============================================================ -->
<div id="preloader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background: #ffffff; display: flex; justify-content: center; align-items: center; z-index: 999999; transition: opacity 0.4s ease;">
    <div class="text-center">
        <div class="position-relative d-inline-block">
            <img src="assets/images/logo numanke.png" alt="Loading Numanke" 
                 style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 2px solid var(--color-red); box-shadow: var(--shadow-hover); animation: pulsePreloader 1.5s infinite ease-in-out;">
        </div>
        <div class="font-display mt-3" style="font-size: 1.35rem; font-weight: 700; color: var(--color-dark); letter-spacing: 0.5px;">
            Numanke<span style="color: var(--color-red);">.</span>
        </div>
        <div class="small text-muted" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;">
            Spesial Ayam Brongot
        </div>
    </div>
</div>

<style>
    @keyframes pulsePreloader {
        0%, 100% { transform: scale(0.96); box-shadow: 0 4px 15px rgba(201, 42, 42, 0.15); }
        50% { transform: scale(1.05); box-shadow: 0 10px 30px rgba(201, 42, 42, 0.35); }
    }
</style>

<!-- ============================================================
     1. HERO SECTION – Simple, Elegant, Anti-AI Slop with Embers
     ============================================================ -->
<section class="hero-wrapper" id="home">
    <!-- Floating Ember Sparkles (Animasi Bara Api Tradisional) -->
    <div class="ember-spark" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="ember-spark" style="top: 55%; left: 6%; animation-delay: 2.2s; width: 8px; height: 8px;"></div>
    <div class="ember-spark" style="top: 30%; right: 18%; animation-delay: 3.5s;"></div>
    <div class="ember-spark" style="top: 70%; right: 8%; animation-delay: 1.2s; width: 7px; height: 7px;"></div>
    <div class="ember-spark" style="top: 85%; left: 35%; animation-delay: 4s;"></div>

    <div class="container">
        <div class="row align-items-center g-5">
            
            <!-- LEFT COLUMN: Typography & CTA -->
            <div class="col-lg-6" data-aos="fade-right">
                
                <!-- Pill Badge -->
                <div class="hero-pill-badge">
                    <i class="fa-solid fa-fire text-danger"></i>
                    <span><?php echo htmlspecialchars($hero_pill); ?></span>
                </div>

                <!-- Main Heading -->
                <h1 class="hero-title-main">
                    <?php echo htmlspecialchars($hero_title_1); ?> <br>
                    <span class="highlight-red"><?php echo htmlspecialchars($hero_title_hi); ?></span> <?php echo htmlspecialchars($hero_title_2); ?>
                </h1>

                <!-- MOBILE FLOATING OUTLET IMAGE (Melayang di Heading Section saat Mobile) -->
                <div class="d-block d-lg-none hero-dish-mobile-container" data-aos="zoom-in" data-aos-delay="100">
                    <div class="hero-dish-mobile">
                        <!-- Floating Top Badge -->
                        <div class="hero-floating-card hero-card-top">
                            <span class="d-inline-flex p-2 rounded-circle" style="background: var(--color-gold-light); color: var(--color-gold);">
                                <i class="fa-solid fa-award fs-5"></i>
                            </span>
                            <div>
                                <div style="font-weight: 800; font-size: 0.8rem; color: var(--color-dark);">Menu Favorit UNNES</div>
                                <small style="color: var(--color-text-muted); font-size: 0.72rem;">Terjual 500+ porsi / minggu</small>
                            </div>
                        </div>

                        <!-- Main Dish Image -->
                        <img src="assets/images/bg-headingweb.png" alt="Outlet & Menu Spesial Numanke" class="hero-dish-img" onerror="this.src='assets/images/logo numanke.png'">

                        <!-- Floating Bottom Badge -->
                        <div class="hero-floating-card hero-card-bottom">
                            <span class="d-inline-flex p-2 rounded-circle" style="background: var(--color-red-light); color: var(--color-red);">
                                <i class="fa-solid fa-pepper-hot fs-5"></i>
                            </span>
                            <div>
                                <div style="font-weight: 800; font-size: 0.8rem; color: var(--color-dark);">Sambal Ulek Dadakan</div>
                                <small style="color: var(--color-text-muted); font-size: 0.72rem;">Pedas segar diulek langsung</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subtitle -->
                <p class="hero-desc-text">
                    <?php echo htmlspecialchars($hero_desc); ?>
                </p>

                <!-- CTA Buttons -->
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="order.php" class="btn-numanke-primary" style="font-size: 1rem; padding: 14px 32px;">
                        <i class="fa-solid fa-utensils"></i> Pesan Sekarang
                    </a>
                    <a href="#showcase" class="btn-numanke-secondary" style="font-size: 1rem; padding: 14px 28px;">
                        <i class="fa-solid fa-book-open text-danger"></i> Eksplor Menu
                    </a>
                </div>

                <!-- Key Highlights (Interactive Cards with Layered Shadows) -->
                <div class="pt-3 border-top d-flex flex-wrap gap-3 align-items-center" style="border-color: var(--color-border) !important;">
                    <div class="hero-stat-card">
                        <span class="d-inline-flex p-2 rounded-circle" style="background: var(--color-gold-light); color: var(--color-gold);">
                            <i class="fa-solid fa-clock-rotate-left fs-6"></i>
                        </span>
                        <div>
                            <div class="fw-bold fs-6 text-dark" style="line-height: 1.1;"><?php echo htmlspecialchars($stat1_val); ?></div>
                            <small class="text-muted" style="font-size: 0.78rem;"><?php echo htmlspecialchars($stat1_lbl); ?></small>
                        </div>
                    </div>
                    <div class="hero-stat-card">
                        <span class="d-inline-flex p-2 rounded-circle" style="background: var(--color-red-light); color: var(--color-red);">
                            <i class="fa-solid fa-fire-burner fs-6"></i>
                        </span>
                        <div>
                            <div class="fw-bold fs-6 text-dark" style="line-height: 1.1;"><?php echo htmlspecialchars($stat2_val); ?></div>
                            <small class="text-muted" style="font-size: 0.78rem;"><?php echo htmlspecialchars($stat2_lbl); ?></small>
                        </div>
                    </div>
                    <div class="hero-stat-card">
                        <span class="d-inline-flex p-2 rounded-circle" style="background: var(--color-gold-light); color: var(--color-gold);">
                            <i class="fa-solid fa-star fs-6"></i>
                        </span>
                        <div>
                            <div class="fw-bold fs-6 text-dark" style="line-height: 1.1;"><?php echo htmlspecialchars($stat3_val); ?></div>
                            <small class="text-muted" style="font-size: 0.78rem;"><?php echo htmlspecialchars($stat3_lbl); ?></small>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Elegant Dish Showcase (Desktop Only) -->
            <div class="col-lg-6 d-none d-lg-flex justify-content-center" data-aos="fade-left" data-aos-delay="150">
                <div class="hero-dish-wrapper">
                    
                    <!-- Floating Top Badge -->
                    <div class="hero-floating-card hero-card-top">
                        <span class="d-inline-flex p-2 rounded-circle" style="background: var(--color-gold-light); color: var(--color-gold);">
                            <i class="fa-solid fa-award fs-5"></i>
                        </span>
                        <div>
                            <div style="font-weight: 800; font-size: 0.85rem; color: var(--color-dark);">Menu Favorit UNNES</div>
                            <small style="color: var(--color-text-muted); font-size: 0.75rem;">Terjual 500+ porsi / minggu</small>
                        </div>
                    </div>

                    <!-- Main Dish Image -->
                    <img src="assets/images/bg-headingweb.png" alt="Ayam Brongot Numanke" class="hero-dish-img" onerror="this.src='assets/images/logo numanke.png'">

                    <!-- Floating Bottom Badge -->
                    <div class="hero-floating-card hero-card-bottom">
                        <span class="d-inline-flex p-2 rounded-circle" style="background: var(--color-red-light); color: var(--color-red);">
                            <i class="fa-solid fa-pepper-hot fs-5"></i>
                        </span>
                        <div>
                            <div style="font-weight: 800; font-size: 0.85rem; color: var(--color-dark);">Sambal Ulek Dadakan</div>
                            <small style="color: var(--color-text-muted); font-size: 0.75rem;">Pedas segar diulek langsung</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     2. INFINITE MARQUEE RIBBON – Elegant Red & Gold
     ============================================================ -->
<div class="marquee-ribbon">
    <div class="marquee-ribbon-content">
        <?php foreach ($marquee_items as $m_item): ?>
            <div class="marquee-ribbon-item"><?php echo htmlspecialchars($m_item); ?> <span class="marquee-spark">✦</span></div>
        <?php endforeach; ?>
    </div>
    <!-- Duplicate track for seamless infinite scroll -->
    <div class="marquee-ribbon-content" aria-hidden="true">
        <?php foreach ($marquee_items as $m_item): ?>
            <div class="marquee-ribbon-item"><?php echo htmlspecialchars($m_item); ?> <span class="marquee-spark">✦</span></div>
        <?php endforeach; ?>
    </div>
</div>

<!-- ============================================================
     3. MENU ANDALAN (SHOWCASE) – In Framed Content Box
     ============================================================ -->
<section class="section-wrapper-bg" id="showcase">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <!-- Section Header -->
            <div class="text-center mb-5">
                <span class="section-tag-gold">Pilihan Terpopuler</span>
                <h2 class="section-heading-serif">Karya Dapur Kami</h2>
                <p class="section-subtext">
                    Diramu dengan rempah segar dan ketelitian proses. Tiga sajian istimewa yang paling sering dirindukan pelanggan Numanke.
                </p>
            </div>

            <!-- 3 Elegant Cards -->
            <div class="row g-4">
                
                <!-- Card 1: Ayam Brongot Ori -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-menu-elegant">
                        <div class="card-menu-img-box">
                            <span class="card-menu-badge badge-bestseller">★ Best Seller</span>
                            <img src="assets/images/fotoslide1.png" alt="Ayam Brongot Original" onerror="this.src='assets/images/bg-headingweb.png'">
                        </div>
                        <div class="card-menu-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="card-menu-title mb-0">Ayam Brongot Ori</h3>
                                <span class="spice-level-indicator">🌶️ 2 / 3</span>
                            </div>
                            <p class="card-menu-desc">
                                Ayam segar marinasi 12 jam, dibakar perlahan dengan bumbu kecap pedas manis karamel khas Numanke yang meresap ke dalam daging.
                            </p>
                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center" style="border-color: var(--color-border) !important;">
                                <div>
                                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Mulai Dari</small>
                                    <div class="fw-bold fs-5 text-dark">Rp 15.000</div>
                                </div>
                                <a href="order.php" class="btn-numanke-primary" style="padding: 8px 18px; font-size: 0.85rem;">
                                    + Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Ayam Brongot Level Dewa -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-menu-elegant">
                        <div class="card-menu-img-box">
                            <span class="card-menu-badge badge-hot">🔥 Ekstra Pedas</span>
                            <img src="assets/images/fotoslide2.JPG" alt="Ayam Brongot Level Dewa" onerror="this.src='assets/images/bg-headingweb.png'">
                        </div>
                        <div class="card-menu-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="card-menu-title mb-0">Brongot Level Dewa</h3>
                                <span class="spice-level-indicator" style="background:#fee2e2; color:#b91c1c;">🌶️🌶️🌶️ 3 / 3</span>
                            </div>
                            <p class="card-menu-desc">
                                Sensasi cabai rawit merah pilihan berpadu dengan bumbu bakar karamel pekat. Khusus untuk Anda penikmat pedas sejati.
                            </p>
                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center" style="border-color: var(--color-border) !important;">
                                <div>
                                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Mulai Dari</small>
                                    <div class="fw-bold fs-5 text-dark">Rp 17.000</div>
                                </div>
                                <a href="order.php" class="btn-numanke-primary" style="padding: 8px 18px; font-size: 0.85rem;">
                                    + Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Es Teh Kampul Spesial -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-menu-elegant">
                        <div class="card-menu-img-box">
                            <span class="card-menu-badge badge-fresh">❄️ Segar Melegakan</span>
                            <img src="assets/images/fotoslide3.JPG" alt="Es Teh Kampul Spesial" onerror="this.src='assets/images/bg-headingweb.png'">
                        </div>
                        <div class="card-menu-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="card-menu-title mb-0">Es Teh Kampul</h3>
                                <span class="badge" style="background: var(--color-gold-light); color: #b45309; font-weight: 700; font-size: 0.75rem;">🍋 Jeruk Peras</span>
                            </div>
                            <p class="card-menu-desc">
                                Seduhan teh melati wangi dengan perasan dan irisan jeruk peras asli. Penyejuk dahaga sempurna sehabis menikmati hidangan pedas.
                            </p>
                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center" style="border-color: var(--color-border) !important;">
                                <div>
                                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Harga Porsi</small>
                                    <div class="fw-bold fs-5 text-dark">Rp 7.000</div>
                                </div>
                                <a href="order.php" class="btn-numanke-secondary" style="padding: 8px 18px; font-size: 0.85rem;">
                                    + Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Center CTA Button -->
            <div class="text-center mt-5">
                <a href="order.php" class="btn-numanke-primary" style="padding: 14px 34px; font-size: 1rem;">
                    <i class="fa-solid fa-list-ul"></i> Lihat Menu Lengkap (30+ Pilihan Menu)
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     4. KABAR & CERITA DAPUR NUMANKE (DYNAMIC FROM ADMIN CMS)
     ============================================================ -->
<?php if (!empty($stories)): ?>
<section class="section-wrapper-bg" id="cerita">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-5">
                <div>
                    <span class="section-tag-red">Kisah & Liputan Dapur</span>
                    <h2 class="section-heading-serif mb-2">Kabar & Cerita Numanke</h2>
                    <p class="text-muted mb-0" style="font-size: 1rem;">Ikuti kabar terbaru, rahasia resep, dan kisah hangat dari dapur kami.</p>
                </div>
                <a href="about.php" class="btn-numanke-secondary" style="font-size: 0.9rem; padding: 10px 22px;">
                    <i class="fa-solid fa-arrow-right text-danger"></i> Buka Semua Cerita
                </a>
            </div>

            <div class="row g-4">
                <?php 
                $display_stories = array_slice($stories, 0, 3);
                foreach ($display_stories as $st_idx => $st): 
                ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?php echo ($st_idx + 1) * 100; ?>">
                        <div class="story-web-card" style="background: #ffffff; border: 1.5px solid var(--color-border); border-radius: 20px; overflow: hidden; display: flex; flex-direction: column; height: 100%; box-shadow: var(--shadow-card);">
                            <div class="story-web-img-box" style="width: 100%; height: 220px; max-height: 220px; overflow: hidden; position: relative; background: #f8fafc; flex-shrink: 0;">
                                <span class="story-web-badge" style="position: absolute; top: 12px; left: 12px; z-index: 2; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; background: rgba(255, 255, 255, 0.95); color: var(--color-red); box-shadow: 0 2px 8px rgba(0,0,0,0.1);"><?php echo htmlspecialchars($st['badge'] ?? 'Cerita'); ?></span>
                                <img src="<?php echo htmlspecialchars($st['image']); ?>" alt="<?php echo htmlspecialchars($st['title']); ?>" style="width: 100%; height: 100%; max-height: 220px; object-fit: cover; display: block;" onerror="this.src='assets/images/bg-headingweb.png'">
                            </div>
                            <div class="story-web-body">
                                <div class="story-web-date">
                                    <i class="fa-regular fa-calendar-days me-1"></i> <?php echo htmlspecialchars($st['date'] ?? '-'); ?>
                                </div>
                                <h3 class="story-web-title"><?php echo htmlspecialchars($st['title']); ?></h3>
                                <p class="story-web-desc">
                                    <?php echo htmlspecialchars($st['summary'] ?? substr($st['content'], 0, 120) . '...'); ?>
                                </p>
                                <a href="about.php" class="text-danger fw-bold text-decoration-none mt-auto d-inline-flex align-items-center gap-2" style="font-size: 0.88rem;">
                                    <span>Baca Cerita</span>
                                    <i class="fa-solid fa-arrow-right small"></i>
                                </a>
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
     5. SEHARI DI DAPUR NUMANKE (TIMELINE STORY)
     ============================================================ -->
<section class="section-wrapper-bg" id="timeline">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <span class="section-tag-red">Dedikasi Setiap Hari</span>
                <h2 class="section-heading-serif">Sehari di Dapur Numanke</h2>
                <p class="section-subtext">
                    Di balik setiap piring yang hangat, ada proses cermat yang kami mulai sejak matahari terbit.
                </p>
            </div>

            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="timeline-card-box">
                        <span class="timeline-hour">06:00</span>
                        <h4 class="fw-bold fs-5 text-dark mb-2">Ulekan Rempah Pagi</h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                            Bumbu rempah segar Nusantara diulek halus. Potongan ayam segar mulai dimarinasi agar rasa meresap hingga ke serat tulang terdalam.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="timeline-card-box">
                        <span class="timeline-hour">10:00</span>
                        <h4 class="fw-bold fs-5 text-dark mb-2">Arang Batok Membara</h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                            Panggangan arang batok kelapa dinyalakan. Asap karamel manis gurih mulai menyeruak, menyambut para pemburu makan siang.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="timeline-card-box">
                        <span class="timeline-hour">12:00</span>
                        <h4 class="fw-bold fs-5 text-dark mb-2">Sambal Ulek Dadakan</h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                            Cabai rawit merah segar dan bawang ditumbuk dadakan saat pesanan masuk. Sajian dihidangkan panas mengepul ke meja Anda.
                        </p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="timeline-card-box">
                        <span class="timeline-hour">21:00</span>
                        <h4 class="fw-bold fs-5 text-dark mb-2">Piring Terakhir & Senyum</h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                            Lapar terpuaskan dan obrolan hangat mereda. Kami menutup hari dengan rasa syukur dan bersiap menghadirkan rasa terbaik esok hari.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     6. FILOSOFI NUMANKE (3 PILAR)
     ============================================================ -->
<section class="section-wrapper-bg" id="filosofi">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <span class="section-tag-gold">Nilai Luhur</span>
                <h2 class="section-heading-serif">Filosofi Numanke</h2>
                <p class="section-subtext">
                    Tiga pilar utama yang menjadi ruh dalam setiap sajian yang keluar dari dapur kami.
                </p>
            </div>

            <!-- Pillar 1: Srawung -->
            <div class="card-ticket-clean mb-4" data-aos="fade-up">
                <div class="row align-items-center g-4">
                    <div class="col-md-5">
                        <img src="assets/images/filosofi1.JPG" alt="Kebersamaan Srawung" class="w-100 rounded-4" style="height: 280px; object-fit: cover; box-shadow: var(--shadow-sm);" onerror="this.src='assets/images/bg-headingweb.png'">
                    </div>
                    <div class="col-md-7 ps-md-4">
                        <span class="section-tag-red mb-2">Pilar 01</span>
                        <h3 class="font-display fs-2 text-dark mb-3">Kebersamaan (Srawung)</h3>
                        <p class="text-muted fs-6" style="line-height: 1.8;">
                            Numanke hadir bukan sekadar tempat menyantap makanan, melainkan ruang hangat untuk saling berjumpa, bertukar tawa, dan mempererat silaturahmi. Setiap hidangan dirancang untuk dinikmati bersama dengan rasa kekeluargaan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 2: Autentisitas -->
            <div class="card-ticket-clean mb-4" data-aos="fade-up">
                <div class="row align-items-center g-4 flex-md-row-reverse">
                    <div class="col-md-5">
                        <img src="assets/images/filosofi2.JPG" alt="Autentisitas Rasa" class="w-100 rounded-4" style="height: 280px; object-fit: cover; box-shadow: var(--shadow-sm);" onerror="this.src='assets/images/bg-headingweb.png'">
                    </div>
                    <div class="col-md-7 pe-md-4">
                        <span class="section-tag-gold mb-2">Pilar 02</span>
                        <h3 class="font-display fs-2 text-dark mb-3">Autentisitas Rasa</h3>
                        <p class="text-muted fs-6" style="line-height: 1.8;">
                            Kejujuran bahan adalah komitmen mutlak kami. Perpaduan rempah asli Nusantara, marinasi waktu penuh, dan pembakaran arang batok alami melahirkan karakter cita rasa yang pekat, gurih, dan tidak tertandingi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 3: Pelayanan Sepenuh Hati -->
            <div class="card-ticket-clean" data-aos="fade-up">
                <div class="row align-items-center g-4">
                    <div class="col-md-5">
                        <img src="assets/images/filosofi3.JPG" alt="Pelayanan Sepenuh Hati" class="w-100 rounded-4" style="height: 280px; object-fit: cover; box-shadow: var(--shadow-sm);" onerror="this.src='assets/images/bg-headingweb.png'">
                    </div>
                    <div class="col-md-7 ps-md-4">
                        <span class="section-tag-red mb-2">Pilar 03</span>
                        <h3 class="font-display fs-2 text-dark mb-3">Pelayanan Sepenuh Hati</h3>
                        <p class="text-muted fs-6" style="line-height: 1.8;">
                            Bagi kami, setiap tamu yang melangkah masuk adalah keluarga yang patut dimuliakan. Kami menyajikan setiap hidangan dengan senyuman tulus, kebersihan prima, dan rasa hormat yang mendalam.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     7. WALL OF REVIEWS (TESTIMONI)
     ============================================================ -->
<section class="section-wrapper-bg" id="testimoni">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <span class="section-tag-gold">Ulasan Pelanggan</span>
                <h2 class="section-heading-serif">Kata Mereka yang Sudah Mampir</h2>
                <p class="section-subtext">
                    Kisah rasa nyata dari mahasiswa, keluarga, dan para penikmat kuliner di Semarang.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="review-clean-card">
                        <div class="stars-rating">★★★★★</div>
                        <p class="review-quote">
                            “Ayam brongotnya beneran nagih! Bumbu rempahnya manis gurih pedas merasuk sampai ke tulang, arangnya wangi pol.”
                        </p>
                        <div class="d-flex align-items-center gap-3 border-top pt-3">
                            <div class="fw-bold text-dark fs-6">Fajar Pratama</div>
                            <small class="text-muted ms-auto">Mahasiswa UNNES</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="review-clean-card">
                        <div class="stars-rating">★★★★★</div>
                        <p class="review-quote">
                            “Sambal dewatanya juara dunia. Pedasnya nendang tapi sedap rempahnya masih kerasa banget. Wajib coba yang suka pedas!”
                        </p>
                        <div class="d-flex align-items-center gap-3 border-top pt-3">
                            <div class="fw-bold text-dark fs-6">Dinda Ayu</div>
                            <small class="text-muted ms-auto">Pelanggan Setia</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="review-clean-card">
                        <div class="stars-rating">★★★★★</div>
                        <p class="review-quote">
                            “Rongot Freeze coklat keju penyelamat sehabis kepedesan. Seger dan manisnya pas banget, anak-anak juga suka.”
                        </p>
                        <div class="d-flex align-items-center gap-3 border-top pt-3">
                            <div class="fw-bold text-dark fs-6">Budi Santoso</div>
                            <small class="text-muted ms-auto">Warga Sekaran</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="review-clean-card">
                        <div class="stars-rating">★★★★★</div>
                        <p class="review-quote">
                            “Porsi double lauknya mantap mengenyangkan, harga sangat bersahabat buat mahasiswa tapi rasa bintang lima.”
                        </p>
                        <div class="d-flex align-items-center gap-3 border-top pt-3">
                            <div class="fw-bold text-dark fs-6">Rian Hidayat</div>
                            <small class="text-muted ms-auto">Foodies Semarang</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     8. KUNJUNGI & KONTAK
     ============================================================ -->
<section class="section-wrapper-bg" id="contact">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <span class="section-tag-red">Kunjungi Resto</span>
                <h2 class="section-heading-serif">Lokasi & Pemesanan</h2>
                <p class="section-subtext">
                    Pintu resto kami selalu terbuka untuk Anda. Nikmati sajian panas langsung dari panggangan kami.
                </p>
            </div>

            <div class="row g-4">
                
                <!-- LEFT: Google Maps -->
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="card-ticket-clean h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h3 class="font-display fs-3 text-dark mb-1">Resto Numanke Sekaran</h3>
                                <p class="text-muted small mb-0">Jl. Pete Sel. No.18, Sekaran, Kec. Gunungpati, Kota Semarang</p>
                            </div>
                            <span class="badge" style="background: var(--color-gold-light); color: #b45309; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                                <span class="live-dot-pulse me-1"></span> Buka Sekarang
                            </span>
                        </div>

                        <div class="w-100 flex-grow-1 rounded-4 overflow-hidden mt-3" style="min-height: 340px; border: 1px solid var(--color-border); box-shadow: var(--shadow-sm);">
                            <iframe 
                                src="https://maps.google.com/maps?q=Jl.%20Pete%20Sel.%20No.18,%20Sekaran,%20Semarang&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                                width="100%" 
                                height="100%" 
                                style="border:0; min-height: 340px;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: WhatsApp & Jam Buka -->
                <div class="col-lg-5 d-flex flex-column gap-4" data-aos="fade-left">
                    
                    <!-- Chat WA Box -->
                    <div class="card-ticket-clean">
                        <h3 class="font-display fs-4 text-dark mb-2">Pesan Cepat via WhatsApp</h3>
                        <p class="text-muted small mb-4">Hubungi admin kami untuk pemesanan antar atau reservasi tempat:</p>

                        <a href="https://wa.me/<?php echo htmlspecialchars($wa_order_num); ?>" target="_blank" class="btn-numanke-primary w-100 mb-3" style="justify-content: flex-start; padding: 14px 20px;">
                            <i class="fa-brands fa-whatsapp fs-3 me-3 text-white"></i>
                            <div class="text-start">
                                <div style="font-size: 0.75rem; text-transform: uppercase; opacity: 0.85;">Admin Pemesanan & Antar</div>
                                <div style="font-size: 1.05rem; font-weight: 800;"><?php echo htmlspecialchars($wa_order_txt); ?></div>
                            </div>
                        </a>

                        <a href="https://wa.me/<?php echo htmlspecialchars($wa_partner_num); ?>" target="_blank" class="btn-numanke-secondary w-100" style="justify-content: flex-start; padding: 14px 20px;">
                            <i class="fa-solid fa-handshake fs-3 me-3 text-warning"></i>
                            <div class="text-start">
                                <div style="font-size: 0.75rem; text-transform: uppercase; color: var(--color-text-muted);">Operasional & Kemitraan</div>
                                <div style="font-size: 1.05rem; font-weight: 800; color: var(--color-dark);"><?php echo htmlspecialchars($wa_partner_txt); ?></div>
                            </div>
                        </a>
                    </div>

                    <!-- Jam Buka Box -->
                    <div class="card-ticket-clean flex-grow-1 d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-inline-flex p-3 rounded-circle" style="background: var(--color-gold-light); color: var(--color-gold);">
                                <i class="fa-regular fa-clock fs-4"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-dark fs-5">Jam Operasional</div>
                                <small class="text-muted"><?php echo htmlspecialchars($open_days_txt); ?></small>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center" style="border-color: var(--color-border) !important;">
                            <span class="text-muted fw-semibold">Waktu Buka</span>
                            <span class="font-display fs-3 fw-bold text-danger"><?php echo htmlspecialchars($open_hours_txt); ?></span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
