<?php
$footer_settings = function_exists('get_site_settings') ? get_site_settings() : [];
$f_hours = $footer_settings['open_hours'] ?? '10:00 – 21:00 WIB';
$f_days = $footer_settings['open_days'] ?? 'Senin – Minggu (Setiap Hari)';
$f_addr = $footer_settings['address_short'] ?? 'Jl. Pete Sel. No.18, Sekaran, Kec. Gunungpati, Kota Semarang';
$f_wa = $footer_settings['wa_order'] ?? '62882006236802';
$f_wa_display = $footer_settings['wa_order_display'] ?? '+62 882-0062-36802';
?>
<!-- includes/footer.php -->

<!-- ============================================================
     FOOTER – Simple & Elegant
     ============================================================ -->
<footer class="footer-elegant">
    <div class="container">
        <div class="row g-4 g-lg-5 justify-content-between mb-5">
            
            <!-- Col 1: Brand Info -->
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="assets/images/logo numanke.png" alt="Numanke Logo" 
                         style="width: 52px; height: 52px; border-radius: 50%; border: 2px solid var(--color-gold); object-fit: cover;">
                    <div class="footer-brand-title">
                        Numanke<span>.</span>
                    </div>
                </div>
                <p style="color: rgba(255,255,255,0.65); font-size: 0.95rem; line-height: 1.7; max-width: 340px;">
                    Spesial Ayam Brongot dengan bumbu rempah warisan Nusantara. Dimarinasi 12 jam dan dibakar perlahan di atas arang batok alami.
                </p>
                <div class="d-flex align-items-center gap-2 mt-4">
                    <span class="live-dot-pulse"></span>
                    <span style="font-size: 0.85rem; color: #4ade80; font-weight: 700;">Buka <?php echo htmlspecialchars($f_days); ?> (<?php echo htmlspecialchars($f_hours); ?>)</span>
                </div>
            </div>

            <!-- Col 2: Nav Links -->
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Navigasi</div>
                <ul class="list-unstyled mb-0">
                    <li><a href="index.php" class="footer-link">Home</a></li>
                    <li><a href="order.php" class="footer-link">Menu & Pesan</a></li>
                    <li><a href="about.php" class="footer-link">Cerita Kami</a></li>
                    <li><a href="contact.php" class="footer-link">Kontak & Lokasi</a></li>
                </ul>
            </div>

            <!-- Col 3: Menu Favorit -->
            <div class="col-6 col-lg-3">
                <div class="footer-heading">Menu Andalan</div>
                <ul class="list-unstyled mb-0" style="font-size: 0.9rem; color: rgba(255,255,255,0.65); line-height: 2;">
                    <li>Ayam Brongot Original</li>
                    <li>Ayam Brongot Level Dewa</li>
                    <li>Nasi Ayam Geprek Keju</li>
                    <li>Rongot Freeze Coklat</li>
                    <li>Es Teh Kampul Spesial</li>
                </ul>
            </div>

            <!-- Col 4: Lokasi & Kontak -->
            <div class="col-lg-3">
                <div class="footer-heading">Kunjungi Kami</div>
                <p style="color: rgba(255,255,255,0.65); font-size: 0.9rem; line-height: 1.7; margin-bottom: 1rem;">
                    <i class="fa-solid fa-location-dot me-2 text-warning"></i>
                    <?php echo htmlspecialchars($f_addr); ?>
                </p>
                <a href="https://wa.me/<?php echo htmlspecialchars($f_wa); ?>" target="_blank" class="btn-numanke-primary w-100" style="padding: 10px 18px; font-size: 0.88rem;">
                    <i class="fa-brands fa-whatsapp fs-5"></i> Chat WhatsApp
                </a>
            </div>

        </div>

        <!-- Bottom Copyright -->
        <div class="pt-4 mt-2 d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
            <p style="margin: 0; font-size: 0.85rem; color: rgba(255, 255, 255, 0.45);">
                &copy; <?php echo date("Y"); ?> Numanke – Spesial Ayam Brongot. Seluruh hak cipta dilindungi.
            </p>
            <p style="margin: 0; font-size: 0.85rem; color: rgba(255, 255, 255, 0.45); margin-top: 6px;" class="mt-md-0">
                Dibuat hangat dengan <i class="fa-solid fa-heart text-danger mx-1"></i> di Sekaran, Semarang
            </p>
        </div>
    </div>
</footer>

<!-- Preloader Smooth Hide Script -->
<script>
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            preloader.style.transition = 'opacity 0.4s ease';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 400);
        }
    });
</script>
</body>
</html>
