<?php 
require_once 'includes/header.php'; 

$c_wa_order = $site_settings['wa_order'] ?? '62882006236802';
$c_wa_order_txt = $site_settings['wa_order_display'] ?? '+62 882-0062-36802';
$c_wa_partner = $site_settings['wa_partner'] ?? '6288802732001';
$c_wa_partner_txt = $site_settings['wa_partner_display'] ?? '+62 888-0273-2001';
$c_address = $site_settings['address_full'] ?? 'Jl. Pete Sel. No.18, Sekaran, Kec. Gunungpati, Kota Semarang, Jawa Tengah 50229';
$c_hours = $site_settings['open_hours'] ?? '10:00 – 21:00 WIB';
$c_days = $site_settings['open_days'] ?? 'Senin – Minggu (Setiap Hari Tanpa Libur)';
?>

<!-- Header Banner -->
<section class="py-5" style="background: linear-gradient(135deg, var(--color-red) 0%, var(--color-red-dark) 100%); color: var(--color-white); border-bottom: 3px solid var(--color-gold);">
    <div class="container text-center py-2">
        <span class="badge mb-2" style="background: rgba(255,255,255,0.2); color: var(--color-white); font-weight: 700; padding: 6px 14px; border-radius: 20px;">
            📍 INFORMASI & LOKASI
        </span>
        <h1 class="font-display" style="font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 800; margin-bottom: 0.5rem;">
            Kontak Numanke<span style="color: var(--color-gold);">.</span>
        </h1>
        <p style="color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 520px; margin: 0 auto;">
            Pintu resto kami selalu terbuka untuk Anda. Reservasi tempat, pesanan katering, atau pertanyaan kemitraan.
        </p>
    </div>
</section>

<!-- ============================================================
     MAIN CONTACT SECTION – In Framed Card Box
     ============================================================ -->
<section class="section-wrapper-bg">
    <div class="container">
        <div class="section-framed-card" data-aos="fade-up">
            
            <div class="row g-4 g-lg-5">
                
                <!-- Left: Address & Interactive Google Maps -->
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="card-ticket-clean h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-location-dot text-danger fs-4"></i>
                                <h3 class="font-display fs-3 text-dark mb-0">Lokasi Restoran</h3>
                            </div>
                            <span class="badge" style="background: var(--color-gold-light); color: #b45309; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                                Sekaran, Semarang
                            </span>
                        </div>

                        <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                            <a href="https://maps.app.goo.gl/yZiiLaGTeUJ3g9gP8" target="_blank" class="text-dark text-decoration-none d-inline-flex align-items-center gap-2">
                                <span><?php echo htmlspecialchars($c_address); ?></span>
                                <i class="fa-solid fa-arrow-up-right-from-square text-danger small"></i>
                            </a>
                        </p>

                        <div class="w-100 flex-grow-1 rounded-4 overflow-hidden" style="min-height: 340px; border: 1px solid var(--color-border); box-shadow: var(--shadow-sm);">
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

                <!-- Right: Direct WhatsApp Box & Hours -->
                <div class="col-lg-5 d-flex flex-column gap-4" data-aos="fade-left">
                    
                    <!-- Chat WA Box -->
                    <div class="card-ticket-clean">
                        <h3 class="font-display fs-4 text-dark mb-2">Hubungi via WhatsApp</h3>
                        <p class="text-muted small mb-4">Hubungi kami langsung untuk respon pemesanan dan pertanyaan cepat:</p>

                        <!-- Order WA -->
                        <a href="https://wa.me/<?php echo htmlspecialchars($c_wa_order); ?>" target="_blank" class="btn-numanke-primary w-100 mb-3" style="justify-content: flex-start; padding: 14px 20px;">
                            <i class="fa-brands fa-whatsapp fs-3 me-3 text-white"></i>
                            <div class="text-start">
                                <div style="font-size: 0.72rem; text-transform: uppercase; opacity: 0.85;">Pemesanan & Antar Makanan</div>
                                <div style="font-size: 1.05rem; font-weight: 800;"><?php echo htmlspecialchars($c_wa_order_txt); ?></div>
                            </div>
                        </a>

                        <!-- Partnership WA -->
                        <a href="https://wa.me/<?php echo htmlspecialchars($c_wa_partner); ?>" target="_blank" class="btn-numanke-secondary w-100" style="justify-content: flex-start; padding: 14px 20px;">
                            <i class="fa-solid fa-handshake fs-3 me-3 text-warning"></i>
                            <div class="text-start">
                                <div style="font-size: 0.72rem; text-transform: uppercase; color: var(--color-text-muted);">Operasional & Kemitraan</div>
                                <div style="font-size: 1.05rem; font-weight: 800; color: var(--color-dark);"><?php echo htmlspecialchars($c_wa_partner_txt); ?></div>
                            </div>
                        </a>
                    </div>

                    <!-- Hours Box -->
                    <div class="card-ticket-clean flex-grow-1 d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <span class="d-inline-flex p-3 rounded-circle" style="background: var(--color-gold-light); color: var(--color-gold);">
                                <i class="fa-regular fa-clock fs-4"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-dark fs-5">Jam Operasional</div>
                                <small class="text-muted"><?php echo htmlspecialchars($c_days); ?></small>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center" style="border-color: var(--color-border) !important;">
                            <span class="text-muted fw-semibold">Waktu Buka</span>
                            <span class="font-display fs-3 fw-bold text-danger"><?php echo htmlspecialchars($c_hours); ?></span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
