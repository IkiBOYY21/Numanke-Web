<!-- checkout.php -->
<?php 
require_once 'includes/header.php'; 
?>

<!-- Memuat Bootstrap 5 via CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Memuat FontAwesome untuk Ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* Background Kayu Gelap Senada */
    body {
        background-image: linear-gradient(rgba(15, 15, 15, 0.90), rgba(15, 15, 15, 0.90)), url('assets/images/image_68b9f7.jpg');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }

    /* Efek Kaca (Glassmorphism) */
    .glass-card {
        background: rgba(30, 30, 30, 0.6) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 215, 0, 0.2) !important;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
    }

    /* Kustomisasi Form Input Modern */
    .form-floating .form-control, .form-floating .form-select {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    .form-floating .form-control:focus {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: #FFD700;
        box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        color: #fff;
    }
    .form-floating label {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Kustomisasi Kotak Pilihan (Radio Button Modern) */
    .btn-check:checked + .btn-outline-warning {
        background-color: #FFD700;
        color: #990000;
        border-color: #FFD700;
        font-weight: bold;
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    }
    .btn-outline-warning {
        border-color: rgba(255, 215, 0, 0.5);
        color: #FFD700;
        transition: all 0.3s ease;
    }
    .btn-outline-warning:hover {
        background-color: rgba(255, 215, 0, 0.1);
    }

    /* Tombol Bayar */
    .btn-checkout {
        background-color: #990000;
        color: #FFD700;
        border: 2px solid #FFD700;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-checkout:hover {
        background-color: #FFD700;
        color: #990000;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 215, 0, 0.4);
    }

    /* Animasi sembunyi/muncul */
    .alamat-box {
        display: none;
        animation: fadeIn 0.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<section class="py-5 mt-4">
    <div class="container">
        <!-- Judul Halaman -->
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="display-5 fw-bold" style="color: #FFD700; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Selesaikan Pesananmu</h1>
            <p class="lead text-light opacity-75">Isi data di bawah ini untuk memproses pesanan lezatmu.</p>
        </div>

        <div class="row g-5 justify-content-center">
            
            <!-- FORM CHECKOUT (Kiri) -->
            <div class="col-lg-7" data-aos="fade-right" data-aos-delay="100">
                <div class="glass-card p-4 p-md-5 rounded-4">
                    <h4 class="mb-4 text-warning fw-bold border-bottom border-secondary pb-3"><i class="fa-solid fa-user-pen me-2"></i> Data Pelanggan</h4>
                    
                    <form id="formCheckout" action="proses_checkout.php" method="POST">
                        <!-- Input Nama -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="nama" placeholder="Nama Lengkap" required>
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        
                        <!-- Input Nomor WA -->
                        <div class="form-floating mb-4">
                            <input type="tel" class="form-control rounded-3" id="nomorWa" placeholder="0812xxxxxx" required>
                            <label for="nomorWa">Nomor WhatsApp</label>
                        </div>

                        <h4 class="mt-5 mb-3 text-warning fw-bold"><i class="fa-solid fa-motorcycle me-2"></i> Tipe Pesanan</h4>
                        
                        <!-- Pilihan Tipe Pesanan Modern -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-4">
                                <input type="radio" class="btn-check" name="tipePesanan" id="dineIn" value="Makan di Tempat" autocomplete="off" checked onchange="toggleAlamat()">
                                <label class="btn btn-outline-warning w-100 h-100 p-3 rounded-3 text-start" for="dineIn">
                                    <i class="fa-solid fa-store fs-4 mb-2 d-block"></i>
                                    Makan Ditempat
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="radio" class="btn-check" name="tipePesanan" id="takeaway" value="Ambil Sendiri" autocomplete="off" onchange="toggleAlamat()">
                                <label class="btn btn-outline-warning w-100 h-100 p-3 rounded-3 text-start" for="takeaway">
                                    <i class="fa-solid fa-bag-shopping fs-4 mb-2 d-block"></i>
                                    Bungkus (Ambil)
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="radio" class="btn-check" name="tipePesanan" id="delivery" value="Diantar" autocomplete="off" onchange="toggleAlamat()">
                                <label class="btn btn-outline-warning w-100 h-100 p-3 rounded-3 text-start" for="delivery">
                                    <i class="fa-solid fa-motorcycle fs-4 mb-2 d-block"></i>
                                    Bungkus (Diantar)
                                </label>
                            </div>
                        </div>

                        <!-- Kotak Alamat (Hanya Muncul Jika Pilih Diantar) -->
                        <div class="form-floating mb-4 alamat-box" id="boxAlamat">
                            <textarea class="form-control rounded-3" id="alamat" placeholder="Tuliskan alamat lengkap" style="height: 100px"></textarea>
                            <label for="alamat">Alamat Pengiriman Lengkap</label>
                        </div>

                        <h4 class="mt-5 mb-3 text-warning fw-bold"><i class="fa-solid fa-wallet me-2"></i> Metode Pembayaran</h4>
                        
                        <!-- Pilihan Pembayaran Modern -->
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="metodeBayar" id="cash" value="Cash" autocomplete="off" checked>
                                <label class="btn btn-outline-warning w-100 p-3 rounded-3 text-center" for="cash">
                                    <i class="fa-solid fa-money-bill-wave fs-3 mb-2 d-block"></i>
                                    Tunai (Cash)
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="metodeBayar" id="qris" value="QRIS" autocomplete="off">
                                <label class="btn btn-outline-warning w-100 p-3 rounded-3 text-center" for="qris">
                                    <i class="fa-solid fa-qrcode fs-3 mb-2 d-block"></i>
                                    QRIS
                                </label>
                            </div>
                        </div>

                        <button type="button" class="btn btn-checkout w-100 py-3 mt-3 fs-5" onclick="kirimKeWa()">
                            Kirim Pesanan ke WhatsApp <i class="fa-brands fa-whatsapp ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- RINGKASAN PESANAN (Kanan) -->
            <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
                <div class="glass-card p-4 rounded-4 sticky-lg-top" style="top: 100px;">
                    <h5 class="text-warning fw-bold mb-4 border-bottom border-secondary pb-3"><i class="fa-solid fa-receipt me-2"></i> Ringkasan Pesanan</h5>
                    
                    <!-- Simulasi Keranjang (Nantinya diisi otomatis pakai PHP/JS) -->
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h6 class="mb-0 text-white">Ayam Brongot Level Dewa</h6>
                            <small class="text-white-50">1x Single</small>
                        </div>
                        <span class="text-white">Rp 28.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h6 class="mb-0 text-white">Es Teh Kampul</h6>
                            <small class="text-white-50">2x</small>
                        </div>
                        <span class="text-white">Rp 10.000</span>
                    </div>
                    
                    <hr class="border-secondary my-4">
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white-50">Subtotal</span>
                        <span class="text-white">Rp 38.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4" id="ongkirRow" style="display: none !important;">
                        <span class="text-white-50">Ongkos Kirim</span>
                        <span class="text-warning">Dihitung Admin</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center bg-danger bg-opacity-25 p-3 rounded-3 border border-danger">
                        <span class="fw-bold text-white fs-5">Total</span>
                        <span class="fw-bold text-warning fs-5">Rp 38.000</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Script Bootstrap & Logika Form -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fungsi untuk memunculkan kolom alamat JIKA memilih "Diantar"
    function toggleAlamat() {
        const isDelivery = document.getElementById('delivery').checked;
        const boxAlamat = document.getElementById('boxAlamat');
        const ongkirRow = document.getElementById('ongkirRow');
        
        if(isDelivery) {
            boxAlamat.style.display = 'block';
            ongkirRow.style.setProperty('display', 'flex', 'important');
        } else {
            boxAlamat.style.display = 'none';
            ongkirRow.style.setProperty('display', 'none', 'important');
        }
    }

    // Fungsi canggih untuk memformat data dan mengirim langsung ke WhatsApp Admin
    function kirimKeWa() {
        // Ambil data dari form
        let nama = document.getElementById('nama').value;
        let nomor = document.getElementById('nomorWa').value;
        
        if(!nama || !nomor) {
            alert('Mohon lengkapi Nama dan Nomor WhatsApp terlebih dahulu!');
            return;
        }

        let tipe = document.querySelector('input[name="tipePesanan"]:checked').value;
        let bayar = document.querySelector('input[name="metodeBayar"]:checked').value;
        let alamat = document.getElementById('alamat').value;

        // Susun teks pesan WhatsApp
        let textWa = `Halo Admin Numanke! 🍗🔥%0A%0ASaya ingin memesan dengan rincian berikut:%0A%0A`;
        textWa += `*Data Pemesan:*%0A`;
        textWa += `- Nama: ${nama}%0A`;
        textWa += `- No. WA: ${nomor}%0A`;
        textWa += `- Tipe Pesanan: ${tipe}%0A`;
        
        if(tipe === "Diantar") {
            if(!alamat) {
                alert('Mohon isi alamat pengiriman!');
                return;
            }
            textWa += `- Alamat: ${alamat}%0A`;
        }
        
        textWa += `- Pembayaran: ${bayar}%0A%0A`;
        textWa += `*Pesanan Saya:*%0A`;
        textWa += `- 1x Ayam Brongot Level Dewa (Single)%0A`; // Ini disimulasikan
        textWa += `- 2x Es Teh Kampul%0A%0A`;
        textWa += `Mohon info total dan konfirmasinya ya min, Terima kasih!`;

        // Ganti dengan nomor WhatsApp Admin Numanke (gunakan kode negara 62)
        let nomorAdmin = "6281234567890"; 
        
        // Buka tab WhatsApp baru
        window.open(`https://wa.me/${nomorAdmin}?text=${textWa}`, '_blank');
    }
</script>

<?php require_once 'includes/footer.php'; ?>