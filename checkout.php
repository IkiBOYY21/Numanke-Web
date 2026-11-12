<!-- checkout.php -->
<?php 
require_once 'includes/header.php'; 
?>

<!-- Header Banner -->
<section class="py-5" style="background: linear-gradient(135deg, var(--color-red) 0%, var(--color-red-dark) 100%); color: var(--color-white); border-bottom: 3px solid var(--color-gold);">
    <div class="container text-center py-2">
        <span class="badge mb-2" style="background: rgba(255,255,255,0.2); color: var(--color-white); font-weight: 700; padding: 6px 14px; border-radius: 20px;">
            🛒 FORMULIR PEMESANAN
        </span>
        <h1 class="font-display" style="font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 0.5rem;">
            Selesaikan Pesanan<span style="color: var(--color-gold);">.</span>
        </h1>
        <p style="color: rgba(255,255,255,0.85); font-size: 1rem; max-width: 480px; margin: 0 auto;">
            Isi rincian pemesan di bawah untuk meneruskan pesanan Anda langsung ke WhatsApp resmi Numanke.
        </p>
    </div>
</section>

<!-- Main Checkout Section -->
<section class="section-wrapper-bg">
    <div class="container">
        <div class="row g-4 g-lg-5 justify-content-center">
            
            <!-- LEFT: Customer Form -->
            <div class="col-lg-7" data-aos="fade-right">
                <div class="p-4 p-md-5 rounded-4 border bg-white" style="box-shadow: var(--shadow-card);">
                    
                    <div class="d-flex align-items-center gap-2 mb-4 pb-2 border-bottom">
                        <i class="fa-solid fa-user-pen text-danger fs-5"></i>
                        <h4 class="font-display fs-4 text-dark mb-0">Informasi Pemesan</h4>
                    </div>

                    <form id="formCheckout">
                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted" for="nama">Nama Lengkap</label>
                            <input type="text" class="input-elegant" id="nama" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <!-- Nomor WA -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted" for="nomorWa">Nomor WhatsApp</label>
                            <input type="tel" class="input-elegant" id="nomorWa" placeholder="0812xxxxxx" required>
                        </div>

                        <!-- Tipe Pesanan -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted d-block mb-2">Tipe Pesanan</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="tipePesanan" id="dineIn" value="Makan di Tempat" checked onchange="toggleAlamat()">
                                    <label class="btn btn-outline-danger w-100 py-3 rounded-4 fw-bold text-center" for="dineIn">
                                        <i class="fa-solid fa-store fs-5 d-block mb-1"></i>
                                        <span class="small">Dine In</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="tipePesanan" id="takeaway" value="Ambil Sendiri" onchange="toggleAlamat()">
                                    <label class="btn btn-outline-danger w-100 py-3 rounded-4 fw-bold text-center" for="takeaway">
                                        <i class="fa-solid fa-bag-shopping fs-5 d-block mb-1"></i>
                                        <span class="small">Bungkus</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="tipePesanan" id="delivery" value="Diantar" onchange="toggleAlamat()">
                                    <label class="btn btn-outline-danger w-100 py-3 rounded-4 fw-bold text-center" for="delivery">
                                        <i class="fa-solid fa-motorcycle fs-5 d-block mb-1"></i>
                                        <span class="small">Diantar</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Box (Delivery Only) -->
                        <div class="p-3 bg-light rounded-4 border mb-4" id="boxAlamat" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-dark" for="alamat">Alamat Lengkap / Link Google Maps</label>
                                <textarea class="input-elegant" id="alamat" rows="3" placeholder="Tuliskan nama jalan, nomor rumah, atau link pin Google Maps"></textarea>
                            </div>

                            <div class="alert alert-warning border-warning bg-warning bg-opacity-10 d-flex align-items-center py-2 px-3 mb-3 rounded-3">
                                <i class="fa-solid fa-map-location-dot fs-4 text-warning me-3"></i>
                                <div class="small">
                                    <strong class="text-dark">Estimasi Jarak dari Numanke:</strong><br>
                                    <span class="text-muted">Masukkan perkiraan kilometer jarak dari resto kami di Sekaran untuk hitung ongkir otomatis.</span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small fw-bold text-dark" for="jarakKm">Jarak dari Numanke (dalam KM)</label>
                                <input type="number" class="input-elegant" id="jarakKm" placeholder="Contoh: 3.5" step="0.1" min="0" oninput="hitungOngkir()">
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted d-block mb-2">Metode Pembayaran</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="metodeBayar" id="cash" value="Cash" checked>
                                    <label class="btn btn-outline-secondary w-100 py-3 rounded-4 fw-bold text-center" for="cash">
                                        <i class="fa-solid fa-money-bill-wave fs-5 d-block mb-1"></i>
                                        <span class="small">Tunai (Cash)</span>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="metodeBayar" id="qris" value="QRIS">
                                    <label class="btn btn-outline-secondary w-100 py-3 rounded-4 fw-bold text-center" for="qris">
                                        <i class="fa-solid fa-qrcode fs-5 d-block mb-1"></i>
                                        <span class="small">QRIS</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn-numanke-primary w-100 py-3 fs-6" onclick="kirimKeWa()">
                            <i class="fa-brands fa-whatsapp fs-5"></i> Kirim Pesanan ke WhatsApp Resmi
                        </button>
                    </form>

                </div>
            </div>

            <!-- RIGHT: Order Summary -->
            <div class="col-lg-5" data-aos="fade-left">
                <div class="p-4 p-md-5 rounded-4 border bg-white sticky-lg-top" style="top: 100px; box-shadow: var(--shadow-card);">
                    
                    <div class="d-flex align-items-center gap-2 mb-4 pb-2 border-bottom">
                        <i class="fa-solid fa-receipt text-danger fs-5"></i>
                        <h4 class="font-display fs-4 text-dark mb-0">Ringkasan Pesanan</h4>
                    </div>

                    <!-- Items -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-bold text-dark fs-6">Ayam Brongot Level Dewa</div>
                            <small class="text-muted">1x Porsi Single</small>
                        </div>
                        <span class="fw-bold text-dark">Rp 28.000</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-bold text-dark fs-6">Es Teh Kampul Spesial</div>
                            <small class="text-muted">2x Porsi</small>
                        </div>
                        <span class="fw-bold text-dark">Rp 10.000</span>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal Menu</span>
                        <span class="fw-bold text-dark" id="subtotalValue" data-value="38000">Rp 38.000</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3" id="ongkirRow" style="display: none !important;">
                        <span class="text-muted">Ongkos Kirim</span>
                        <span class="fw-bold text-danger" id="ongkirText">Rp 0</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center p-3 rounded-4 mt-3" style="background: var(--color-red-light); border: 1px solid rgba(201,42,42,0.2);">
                        <span class="fw-bold text-dark fs-6">Total Pembayaran</span>
                        <span class="fw-bold fs-4 text-danger" id="totalText">Rp 38.000</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Script Logika Form -->
<script>
    let ongkirSekarang = 0;
    const subtotal = 38000;

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    function toggleAlamat() {
        const isDelivery = document.getElementById('delivery').checked;
        const boxAlamat = document.getElementById('boxAlamat');
        const ongkirRow = document.getElementById('ongkirRow');
        const inputJarak = document.getElementById('jarakKm');
        
        if(isDelivery) {
            boxAlamat.style.display = 'block';
            ongkirRow.style.setProperty('display', 'flex', 'important');
            hitungOngkir();
        } else {
            boxAlamat.style.display = 'none';
            ongkirRow.style.setProperty('display', 'none', 'important');
            ongkirSekarang = 0;
            inputJarak.value = ""; 
            updateTotalDOM();
        }
    }

    function hitungOngkir() {
        const inputJarak = document.getElementById('jarakKm').value;
        const jarakKm = parseFloat(inputJarak);
        
        if (isNaN(jarakKm) || jarakKm <= 0) {
            ongkirSekarang = 0;
            updateTotalDOM();
            return;
        }

        const jarakMeter = jarakKm * 1000;

        if (jarakMeter <= 5000) {
            ongkirSekarang = 5000;
        } else {
            const sisaJarak = jarakMeter - 5000;
            const kelipatan = Math.ceil(sisaJarak / 200); 
            ongkirSekarang = 5000 + (kelipatan * 2000);
        }

        updateTotalDOM();
    }

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

    function kirimKeWa() {
        let nama = document.getElementById('nama').value.trim();
        let nomor = document.getElementById('nomorWa').value.trim();
        let tipe = document.querySelector('input[name="tipePesanan"]:checked').value;
        let bayar = document.querySelector('input[name="metodeBayar"]:checked').value;
        let alamat = document.getElementById('alamat').value.trim();
        let jarak = document.getElementById('jarakKm').value;
        
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
        
        textWa += `Mohon segera diproses ya min. Terima kasih!`;

        let nomorAdmin = "6288802732001";
        let pesanFinal = encodeURIComponent(textWa);
        let linkWhatsapp = `https://api.whatsapp.com/send?phone=${nomorAdmin}&text=${pesanFinal}`;

        localStorage.removeItem('numanke_cart');
        window.location.href = linkWhatsapp;
    }
</script>

<?php require_once 'includes/footer.php'; ?>
