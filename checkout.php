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
    /* Memperbaiki warna teks input saat diketik agar tidak gelap */
    .form-control { color: white !important; }

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
                    
                    <form id="formCheckout">
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

                        <!-- Kotak Alamat & Ongkir (Hanya Muncul Jika Pilih Diantar) -->
                        <div class="alamat-box" id="boxAlamat">
                            <!-- Input Link Maps / Detail Alamat -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control rounded-3" id="alamat" placeholder="Tuliskan alamat lengkap atau Paste Link Google Maps" style="height: 100px"></textarea>
                                <label for="alamat">Alamat Lengkap / Link Google Maps</label>
                            </div>
                            
                            <!-- Input Jarak (Untuk Kalkulasi Otomatis) -->
                            <div class="alert alert-warning bg-transparent border-warning text-warning mb-4 rounded-3 d-flex align-items-center">
                                <i class="fa-solid fa-map-location-dot fs-3 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Cek Jarak di Google Maps</h6>
                                    <small class="opacity-75">Berapa kilometer jarak dari lokasi Anda ke Numanke? (Ketik angkanya di bawah ini untuk menghitung ongkir).</small>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control rounded-3" id="jarakKm" placeholder="Contoh: 6.2" step="0.1" min="0" oninput="hitungOngkir()">
                                <label for="jarakKm">Jarak dari Numanke (dalam KM), cth: 6.2</label>
                            </div>
                        </div>

                        <h4 class="mt-4 mb-3 text-warning fw-bold"><i class="fa-solid fa-wallet me-2"></i> Metode Pembayaran</h4>
                        
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
                    
                    <!-- Item Keranjang (Simulasi) -->
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
                        <span class="text-white" id="subtotalValue" data-value="38000">Rp 38.000</span>
                    </div>
                    
                    <!-- Baris Ongkos Kirim (Dinamis) -->
                    <div class="d-flex justify-content-between mb-4" id="ongkirRow" style="display: none !important;">
                        <span class="text-white-50">Ongkos Kirim</span>
                        <span class="text-warning fw-bold" id="ongkirText">Rp 0</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center bg-danger bg-opacity-25 p-3 rounded-3 border border-danger">
                        <span class="fw-bold text-white fs-5">Total</span>
                        <span class="fw-bold text-warning fs-5" id="totalText">Rp 38.000</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Script Bootstrap & Logika Form -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Menyimpan variabel tarif secara global
    let ongkirSekarang = 0;
    const subtotal = 38000; // Hardcode subtotal berdasarkan simulasi keranjang

    // Fungsi utilitas format Rupiah
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    // Fungsi memunculkan/menyembunyikan form alamat & ongkir
    function toggleAlamat() {
        const isDelivery = document.getElementById('delivery').checked;
        const boxAlamat = document.getElementById('boxAlamat');
        const ongkirRow = document.getElementById('ongkirRow');
        const inputJarak = document.getElementById('jarakKm');
        
        if(isDelivery) {
            boxAlamat.style.display = 'block';
            ongkirRow.style.setProperty('display', 'flex', 'important');
            hitungOngkir(); // Hitung ulang jika ada input sebelumnya
        } else {
            boxAlamat.style.display = 'none';
            ongkirRow.style.setProperty('display', 'none', 'important');
            ongkirSekarang = 0;
            inputJarak.value = ""; 
            updateTotalDOM();
        }
    }

    // Fungsi menghitung Ongkos Kirim sesuai rumus
    function hitungOngkir() {
        const inputJarak = document.getElementById('jarakKm').value;
        const jarakKm = parseFloat(inputJarak);
        
        if (isNaN(jarakKm) || jarakKm <= 0) {
            ongkirSekarang = 0;
            updateTotalDOM();
            return;
        }

        // Konversi KM ke Meter
        const jarakMeter = jarakKm * 1000;

        // Logika Ongkir: Max 5km (5000m) = Rp 5000. 
        // Di atas 5km, setiap 200m tambah Rp 2000.
        if (jarakMeter <= 5000) {
            ongkirSekarang = 5000;
        } else {
            const sisaJarak = jarakMeter - 5000;
            // Gunakan Math.ceil agar sisa meter dibulatkan ke atas menjadi 1 blok kelipatan (200m)
            const kelipatan = Math.ceil(sisaJarak / 200); 
            ongkirSekarang = 5000 + (kelipatan * 2000);
        }

        updateTotalDOM();
    }

    // Fungsi untuk memperbarui tampilan Harga di Ringkasan Pesanan
    function updateTotalDOM() {
        const ongkirText = document.getElementById('ongkirText');
        const totalText = document.getElementById('totalText');
        
        if (ongkirSekarang > 0) {
            ongkirText.innerText = formatRupiah(ongkirSekarang);
        } else {
            ongkirText.innerText = 'Rp 0';
        }
        
        const grandTotal = subtotal + ongkirSekarang;
        totalText.innerText = formatRupiah(grandTotal);
    }

    // Fungsi untuk mengirim data lengkap ke WhatsApp
    function kirimKeWa() {
        let nama = document.getElementById('nama').value;
        let nomor = document.getElementById('nomorWa').value;
        let tipe = document.querySelector('input[name="tipePesanan"]:checked').value;
        let bayar = document.querySelector('input[name="metodeBayar"]:checked').value;
        let alamat = document.getElementById('alamat').value;
        let jarak = document.getElementById('jarakKm').value;
        
        // Validasi Dasar
        if(!nama || !nomor) {
            alert('Mohon lengkapi Nama dan Nomor WhatsApp terlebih dahulu!');
            return;
        }

        if(tipe === "Diantar") {
            if(!alamat || !jarak) {
                alert('Mohon isi alamat pengiriman dan estimasi jarak (KM) terlebih dahulu!');
                return;
            }
        }

        let grandTotal = subtotal + ongkirSekarang;

        // Susun teks pesan WhatsApp menggunakan spasi dan Enter biasa (\n)
        let textWa = `Halo Admin Numanke! 🍗🔥\n\n`;
        textWa += `Saya ingin memesan dengan rincian berikut:\n\n`;
        textWa += `*🛒 DATA PEMESAN:*\n`;
        textWa += `- Nama: ${nama}\n`;
        textWa += `- No. WA: ${nomor}\n`;
        textWa += `- Tipe Pesanan: ${tipe}\n`;
        
        if(tipe === "Diantar") {
            textWa += `- Alamat/Maps: ${alamat}\n`;
            textWa += `- Jarak: ${jarak} KM\n`;
        }
        
        textWa += `- Pembayaran: ${bayar}\n\n`;
        
        textWa += `*📝 RINCIAN PESANAN:*\n`;
        textWa += `- 1x Ayam Brongot Level Dewa (Single)\n`; 
        textWa += `- 2x Es Teh Kampul\n\n`;

        textWa += `*💰 TOTAL BIAYA:*\n`;
        textWa += `- Subtotal: ${formatRupiah(subtotal)}\n`;
        
        if(tipe === "Diantar") {
            textWa += `- Ongkos Kirim: ${formatRupiah(ongkirSekarang)}\n`;
        }
        textWa += `---------------------------\n`;
        textWa += `*Total Bayar: ${formatRupiah(grandTotal)}*\n\n`;
        
        textWa += `Mohon segera diproses dan konfirmasi ya min. Terima kasih!`;

      let nomorAdmin = "6288802732001"; // Nomor WA asli Numanke

        // Enkripsi pesan agar aman dari error spasi/simbol
        let pesanFinal = encodeURIComponent(textWa);
        let linkWhatsapp = `https://api.whatsapp.com/send?phone=${nomorAdmin}&text=${pesanFinal}`;

        // Hapus keranjang
        localStorage.removeItem('numanke_cart');
        
        // Alihkan ke WhatsApp
        window.location.href = linkWhatsapp;
    
    }
</script>

<?php require_once 'includes/footer.php'; ?>