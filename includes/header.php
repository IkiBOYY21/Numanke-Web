<!-- Memuat library yang dibutuhkan -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    .anim-lift { transition: transform 0.4s ease, box-shadow 0.4s ease; }
    .anim-lift:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(255, 215, 0, 0.15) !important; z-index: 10; }
</style>

<style>
    @keyframes logoPopIn {
        0% { opacity: 0; transform: scale(0.3) translateY(-30px) rotate(-15deg); }
        70% { transform: scale(1.1) rotate(5deg); }
        100% { opacity: 1; transform: scale(1) translateY(0) rotate(0); }
    }
    
    .logo-animasi {
        animation: logoPopIn 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    .navbar-custom {
        background: linear-gradient(135deg, #CC0000 0%, #990000 100%);
        padding: 0;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    }
    
    .navbar-brand-custom {
        color: #FFFFFF !important;
        font-size: 2rem;
        font-weight: 800;
        transition: all 0.3s ease;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    .navbar-brand-custom:hover {
        transform: scale(1.05);
    }
    
    .nav-link-custom {
        color: #FFFFFF !important;
        text-transform: uppercase;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 25px 15px !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0.85;
        position: relative;
    }
    
    .nav-link-custom::after {
        content: '';
        position: absolute;
        bottom: 15px;
        left: 50%;
        width: 0;
        height: 2px;
        background: #FFD700;
        transform: translateX(-50%);
        transition: width 0.4s ease;
    }
    
    .nav-link-custom:hover::after,
    .nav-link-custom.active::after {
        width: 80%;
    }
    
    .nav-link-custom:hover, .nav-link-custom.active {
        color: #FFD700 !important;
        opacity: 1;
        transform: translateY(-2px);
    }
    
    .btn-navbar-custom {
        background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
        color: #CC0000 !important;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 12px 28px;
        border: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }
    
    .btn-navbar-custom:hover {
        background: linear-gradient(135deg, #FFFFFF 0%, #FFE75C 100%);
        color: #CC0000 !important;
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        transform: translateY(-3px);
    }

    .nav-cart-btn {
        background-color: transparent;
        border: 2px solid #FFFFFF;
        color: #FFFFFF;
        padding: 8px 15px;
        border-radius: 8px;
        transition: all 0.4s ease;
    }
    
    .nav-cart-btn:hover {
        background-color: #FFFFFF;
        color: #CC0000;
        transform: scale(1.1);
    }

    @media (max-width: 991px) {
        .nav-link-custom { padding: 10px 15px !important; }
        .btn-navbar-custom { padding: 15px; margin-bottom: 10px; }
        .navbar-toggler { border-color: rgba(255, 255, 255, 0.5); }
        .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='round' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand navbar-brand-custom d-flex align-items-center" href="index.php">
            <img src="assets/images/logo numanke.png" alt="Logo Numanke" height="70" class="me-2 rounded-circle logo-animasi"> 
            Numanke
        </a>
        
        <!-- Tombol Keranjang khusus HP ditaruh di sebelah tombol menu -->
        <div class="d-flex align-items-center d-lg-none ms-auto me-3">
            <button class="nav-cart-btn position-relative me-2" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="if(window.location.pathname.indexOf('order.php') === -1) window.location.href='order.php';">
                <i class="fa-solid fa-cart-shopping fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="navCartCountMobile" style="display: none;">0</span>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php#home">Home</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php#showcase">Menu Andalan</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php#about">Cerita Kami</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php#contact">Kontak</a></li>
                
                <!-- Menu Pesan Baru -->
                <li class="nav-item"><a class="nav-link nav-link-custom fw-bold" href="order.php" style="color: #ffffff !important;"><i class="fa-solid fa-utensils me-1"></i> Pesan</a></li>
                
                <!-- Tombol Keranjang Khusus Desktop -->
                <li class="nav-item ms-lg-3 d-none d-lg-block">
                    <button class="nav-cart-btn position-relative" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="if(window.location.pathname.indexOf('order.php') === -1) window.location.href='order.php';">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-danger border border-danger" id="navCartCountDesktop" style="display: none;">0</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Memastikan Update Jumlah Item Keranjang Berjalan di Seluruh Halaman -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let keranjang = JSON.parse(localStorage.getItem('numanke_cart')) || [];
        let countDesktop = document.getElementById('navCartCountDesktop');
        let countMobile = document.getElementById('navCartCountMobile');
        let totalQty = keranjang.reduce((sum, item) => sum + item.qty, 0);
        
        if(totalQty > 0) {
            if(countDesktop) { countDesktop.style.display = 'inline-block'; countDesktop.innerText = totalQty; }
            if(countMobile) { countMobile.style.display = 'inline-block'; countMobile.innerText = totalQty; }
        } else {
            if(countDesktop) countDesktop.style.display = 'none';
            if(countMobile) countMobile.style.display = 'none';
        }
    });
</script>