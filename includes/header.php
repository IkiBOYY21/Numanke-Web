<?php
require_once __DIR__ . '/content_manager.php';
$site_settings = get_site_settings();
$top_bar = $site_settings['announcement_bar'] ?? '🔥 Buka Setiap Hari: 10:00 – 21:00 WIB • Spesial Ayam Brongot Nusantara';
$wa_num = $site_settings['wa_order'] ?? '62882006236802';
$wa_display = $site_settings['wa_order_display'] ?? '+62 882-0062-36802';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numanke - Spesial Ayam Brongot</title>
    <meta name="description" content="Sensasi pedas legendaris ayam brongot khas Nusantara. Dimarinasi 12 jam, dibakar perlahan dengan bumbu rempah rahasia.">
    <meta name="theme-color" content="#c92a2a">

    <!-- Fonts: Playfair Display (Serif) & Plus Jakarta Sans (Modern Clean) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,600;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom Theme Stylesheet (Auto Cache Busting) -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- TOP ANNOUNCEMENT BAR -->
<div class="top-bar-announcement d-none d-md-block">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <span class="live-dot-pulse"></span>
            <span><?php echo htmlspecialchars($top_bar); ?></span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="https://wa.me/<?php echo htmlspecialchars($wa_num); ?>" target="_blank" class="text-white-50 text-decoration-none hover-white" style="transition: color 0.2s;">
                <i class="fa-brands fa-whatsapp text-success me-1"></i> WhatsApp: <?php echo htmlspecialchars($wa_display); ?>
            </a>
        </div>
    </div>
</div>

<!-- ============================================================
     NAVBAR – Simple & Elegant (Red, White, Gold)
     ============================================================ -->
<nav class="navbar navbar-expand-lg navbar-numanke">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand-logo" href="index.php">
            <img src="assets/images/logo numanke.png" alt="Logo Numanke">
            <div class="navbar-brand-title">
                Numanke<span>.</span>
            </div>
        </a>

        <!-- Mobile Action Buttons -->
        <div class="d-flex align-items-center d-lg-none ms-auto gap-2">
            <button class="btn-nav-cart" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="if(window.location.pathname.indexOf('order.php') === -1) window.location.href='order.php';">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-badge-dot" id="navCartCountMobile" style="display: none;">0</span>
            </button>
            <button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="fa-solid fa-bars fs-4 text-dark"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 my-3 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-numanke" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-numanke" href="order.php">Menu & Pesan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-numanke" href="about.php">Cerita Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-numanke" href="contact.php">Kontak</a>
                </li>
                
                <!-- Desktop CTA: Pesan Online -->
                <li class="nav-item ms-lg-3">
                    <a href="order.php" class="btn-numanke-primary">
                        <i class="fa-solid fa-utensils"></i> Pesan Online
                    </a>
                </li>

                <!-- Desktop Cart -->
                <li class="nav-item ms-lg-2 d-none d-lg-block">
                    <button class="btn-nav-cart" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="if(window.location.pathname.indexOf('order.php') === -1) window.location.href='order.php';">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="cart-badge-dot" id="navCartCountDesktop" style="display: none;">0</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Cart Update Script -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        function updateCartBadge() {
            let keranjang = JSON.parse(localStorage.getItem('numanke_cart')) || [];
            let countDesktop = document.getElementById('navCartCountDesktop');
            let countMobile = document.getElementById('navCartCountMobile');
            let totalQty = keranjang.reduce((sum, item) => sum + item.qty, 0);

            if (countDesktop) {
                if (totalQty > 0) {
                    countDesktop.style.display = 'flex';
                    countDesktop.innerText = totalQty;
                } else {
                    countDesktop.style.display = 'none';
                }
            }

            if (countMobile) {
                if (totalQty > 0) {
                    countMobile.style.display = 'flex';
                    countMobile.innerText = totalQty;
                } else {
                    countMobile.style.display = 'none';
                }
            }
        }

        updateCartBadge();
        window.addEventListener('storage', updateCartBadge);
    });
</script>

<!-- Bootstrap & AOS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 750,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80
    });
</script>
