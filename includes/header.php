<!-- Memuat library yang dibutuhkan -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --primary-red: #CC0000;
        --primary-red-dark: #990000;
        --accent-gold: #FFB300;
        --light-bg: #FFFFFF;
        --text-dark: #2C2C2C;
        --text-muted: #666666;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
        background: linear-gradient(135deg, #FFFFFF 0%, #FFF9F0 50%, #FFFBF7 100%);
        min-height: 100vh;
    }

    .anim-lift {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .anim-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(204, 0, 0, 0.2) !important;
        z-index: 10;
    }

    @keyframes logoPopIn {
        0% {
            opacity: 0;
            transform: scale(0.3) translateY(-30px) rotate(-15deg);
        }
        70% {
            transform: scale(1.1) rotate(5deg);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0) rotate(0);
        }
    }

    .logo-animasi {
        animation: logoPopIn 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* NAVBAR STYLING */
    .navbar-custom {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--primary-red-dark) 100%);
        padding: 12px 0;
        box-shadow: 0 4px 20px rgba(204, 0, 0, 0.3);
        border-bottom: 3px solid var(--accent-gold);
        backdrop-filter: blur(10px);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-brand-custom {
        color: #FFFFFF !important;
        font-size: 2rem;
        font-weight: 800;
        font-family: 'Playfair Display', serif !important;
        font-style: italic;
        transition: all 0.3s ease;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .navbar-brand-custom img {
        height: 70px;
        width: auto;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .navbar-brand-custom span {
        font-weight: 900 !important;
        letter-spacing: 2px;
        font-size: 2.2rem;
    }

    .navbar-brand-custom:hover {
        transform: scale(1.05);
    }

    .navbar-brand-custom:hover img {
        transform: rotate(5deg);
    }

    .nav-link-custom {
        color: #FFFFFF !important;
        font-size: 0.95rem;
        font-weight: 600;
        padding: 20px 15px !important;
        transition: all 0.3s ease;
        opacity: 0.85;
        position: relative;
    }

    .nav-link-custom::after {
        content: '';
        position: absolute;
        bottom: 12px;
        left: 50%;
        width: 0;
        height: 3px;
        background: var(--accent-gold);
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }

    .nav-link-custom:hover::after,
    .nav-link-custom.active::after {
        width: 80%;
    }

    .nav-link-custom:hover {
        color: var(--accent-gold) !important;
        opacity: 1;
        transform: translateY(-2px);
    }

    .btn-navbar-custom {
        background: linear-gradient(135deg, var(--accent-gold) 0%, #FFC700 100%);
        color: var(--primary-red) !important;
        border-radius: 50px;
        font-weight: 700;
        padding: 12px 28px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 179, 0, 0.3);
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
    }

    .btn-navbar-custom:hover {
        background: linear-gradient(135deg, #FFFFFF 0%, #FFE75C 100%);
        color: var(--primary-red) !important;
        box-shadow: 0 8px 25px rgba(255, 179, 0, 0.4);
        transform: translateY(-3px);
        text-decoration: none;
    }

    .nav-cart-btn {
        background-color: transparent;
        border: 2px solid #FFFFFF;
        color: #FFFFFF;
        padding: 8px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .nav-cart-btn:hover {
        background-color: var(--accent-gold);
        color: var(--primary-red);
        transform: scale(1.1);
        border-color: var(--accent-gold);
    }

    @media (max-width: 991px) {
        .navbar-custom {
            padding: 8px 0;
        }

        .navbar-brand-custom {
            font-size: 1.5rem;
            gap: 8px;
        }

        .navbar-brand-custom img {
            height: 40px;
        }

        .nav-link-custom {
            padding: 12px 15px !important;
            font-size: 0.9rem;
        }

        .nav-link-custom::after {
            bottom: 8px;
        }

        .btn-navbar-custom {
            padding: 10px 20px;
            font-size: 0.85rem;
            width: 100%;
            margin-top: 10px;
        }
    }

    @media (max-width: 576px) {
        .navbar-custom {
            padding: 6px 0;
        }

        .navbar-brand-custom {
            font-size: 1.2rem;
        }

        .navbar-brand-custom img {
            height: 35px;
        }

        .nav-link-custom {
            padding: 10px 12px !important;
            font-size: 0.8rem;
        }

        .btn-navbar-custom {
            padding: 8px 16px;
            font-size: 0.75rem;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid px-3 px-md-4">
        <!-- Logo -->
        <a class="navbar-brand navbar-brand-custom" href="index.php">
            <img src="assets/images/logo numanke.png" alt="Logo Numanke" class="logo-animasi">
            <span>Numanke</span>
        </a>

        <!-- Mobile Cart & Toggler -->
        <div class="d-flex align-items-center d-lg-none ms-auto gap-2">
            <button class="nav-cart-btn position-relative" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="if(window.location.pathname.indexOf('order.php') === -1) window.location.href='order.php';">
                <i class="fa-solid fa-cart-shopping fs-6"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="navCartCountMobile" style="display: none; font-size: 0.65rem;">0</span>
            </button>
            <button class="navbar-toggler border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Collapse Menu -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="index.php#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="index.php#showcase">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="index.php#filosofi">Cerita kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="index.php#contact">Kontak</a>
                </li>

                <!-- Tombol Pesan -->
                <li class="nav-item ms-lg-3">
                    <a href="order.php" class="btn btn-navbar-custom d-none d-lg-inline-block">
                        <i class="fa-solid fa-utensils me-2"></i>Pesan Sekarang
                    </a>
                </li>

                <!-- Desktop Cart -->
                <li class="nav-item ms-lg-2 d-none d-lg-block">
                    <button class="nav-cart-btn position-relative" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="if(window.location.pathname.indexOf('order.php') === -1) window.location.href='order.php';">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="navCartCountDesktop" style="display: none;">0</span>
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
                    countDesktop.style.display = 'inline-block';
                    countDesktop.innerText = totalQty;
                } else {
                    countDesktop.style.display = 'none';
                }
            }

            if (countMobile) {
                if (totalQty > 0) {
                    countMobile.style.display = 'inline-block';
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
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
</script>