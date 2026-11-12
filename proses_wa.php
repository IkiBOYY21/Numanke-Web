<?php
// Pastikan permintaan ini adalah POST dari form checkout
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses ditolak. Harap pesan melalui halaman menu.");
}

// 1. DATABASE MENU SEMENTARA
// (Salin ulang menu di sini agar PHP tahu harga asli. Ke depannya lebih baik dipisah ke file terpisah, misal: includes/data_menu.php)
$menu_geprek = [
 ['nama' => 'Nasi Ayam Geprek Ori', 'single' => '13 K', 'double' => '18 K'],
 ['nama' => 'Nasi Ayam Geprek Keju', 'single' => '15 K', 'double' => '20 K'],
 ['nama' => 'Nasi Ayam Geprek Moza', 'single' => '17 K', 'double' => '22 K'],
 ['nama' => 'Nasi Jamur Geprek Ori', 'single' => '10 K', 'double' => '14 K'],
 ['nama' => 'Nasi Jamur Geprek Keju', 'single' => '12 K', 'double' => '16 K'],
 ['nama' => 'Nasi Jamur Geprek Moza', 'single' => '14 K', 'double' => '18 K'],
 ['nama' => 'Nasi Telur Geprek Ori', 'single' => '11 K', 'double' => '16 K'],
 ['nama' => 'Nasi Telur Geprek Keju', 'single' => '13 K', 'double' => '18 K'],
 ['nama' => 'Nasi Telur Geprek Moza', 'single' => '15 K', 'double' => '20 K'],
 ['nama' => 'Nasi Ayam+Jamur Geprek Ori', 'single' => '13 K', 'double' => '18 K'],
 ['nama' => 'Nasi Ayam+Jamur Geprek Keju', 'single' => '15 K', 'double' => '20 K'],
 ['nama' => 'Nasi Ayam+Jamur Geprek Moza', 'single' => '17 K', 'double' => '22 K'],
];
$menu_dewata = [
 ['nama' => 'Nasi Ayam Geprek Dewata Ori', 'single' => '15 K', 'double' => '19 K'],
 ['nama' => 'Nasi Ayam Geprek Dewata Keju', 'single' => '17 K', 'double' => '21 K'],
 ['nama' => 'Nasi Ayam Geprek Dewata Moza', 'single' => '19 K', 'double' => '23 K'],
 ['nama' => 'Nasi Jamur Geprek Dewata Ori', 'single' => '12 K', 'double' => '16 K'],
 ['nama' => 'Nasi Jamur Geprek Dewata Keju', 'single' => '14 K', 'double' => '18 K'],
 ['nama' => 'Nasi Jamur Geprek Dewata Moza', 'single' => '16 K', 'double' => '20 K'],
 ['nama' => 'Nasi Ayam Brongot Dewata Ori', 'single' => '17 K', 'double' => '23 K'],
 ['nama' => 'Nasi Ayam Brongot Dewata Keju', 'single' => '19 K', 'double' => '24 K'],
 ['nama' => 'Nasi Ayam Brongot Dewata Moza', 'single' => '21 K', 'double' => '26 K'],
 ['nama' => 'Nasi Jamur Brongot Dewata Ori', 'single' => '14 K', 'double' => '18 K'],
 ['nama' => 'Nasi Jamur Brongot Dewata Keju', 'single' => '16 K', 'double' => '20 K'],
 ['nama' => 'Nasi Jamur Brongot Dewata Moza', 'single' => '18 K', 'double' => '22 K'],
 ['nama' => 'Nasi Mix Geprek Dewata Ori', 'single' => '14 K', 'double' => '19 K'],
 ['nama' => 'Nasi Mix Geprek Dewata Keju', 'single' => '15 K', 'double' => '20 K'],
 ['nama' => 'Nasi Mix Geprek Dewata Moza', 'single' => '17 K', 'double' => '23 K'],
 ['nama' => 'Nasi Mix Brongot Dewata Ori', 'single' => '16 K', 'double' => '21 K'],
 ['nama' => 'Nasi Mix Brongot Dewata Keju', 'single' => '18 K', 'double' => '23 K'],
 ['nama' => 'Nasi Mix Brongot Dewata Moza', 'single' => '20 K', 'double' => '25 K'],
];
$menu_brongot = [
 ['nama' => 'Nasi Ayam Brongot Ori', 'single' => '15 K', 'double' => '20 K'],
 ['nama' => 'Nasi Ayam Brongot Keju', 'single' => '17 K', 'double' => '22 K'],
 ['nama' => 'Nasi Ayam Brongot Moza', 'single' => '19 K', 'double' => '24 K'],
 ['nama' => 'Nasi Jamur Brongot Ori', 'single' => '12 K', 'double' => '17 K'],
 ['nama' => 'Nasi Jamur Brongot Keju', 'single' => '14 K', 'double' => '19 K'],
 ['nama' => 'Nasi Jamur Brongot Moza', 'single' => '16 K', 'double' => '21 K'],
 ['nama' => 'Nasi Telur Brongot Ori', 'single' => '11 K', 'double' => '17 K'],
 ['nama' => 'Nasi Telur Brongot Keju', 'single' => '13 K', 'double' => '19 K'],
 ['nama' => 'Nasi Telur Brongot Moza', 'single' => '15 K', 'double' => '21 K'],
 ['nama' => 'Nasi Ayam+Jamur Brongot Ori', 'single' => '15 K', 'double' => '20 K'],
 ['nama' => 'Nasi Ayam+Jamur Brongot Keju', 'single' => '17 K', 'double' => '22 K'],
 ['nama' => 'Nasi Ayam+Jamur Brongot Moza', 'single' => '19 K', 'double' => '24 K'],
];
$menu_rongot = [
 ['nama' => 'Rongot Freeze Coklat', 'harga' => '11 K'],
 ['nama' => 'Rongot Freeze Keju', 'harga' => '12 K'],
 ['nama' => 'Rongot Freeze Coklat Keju', 'harga' => '14 K'],
 ['nama' => 'Rongot Freeze Coklat Keju Moza', 'harga' => '20 K'],
 ['nama' => 'Rongot Freeze Chocomalt', 'harga' => '13 K'],
 ['nama' => 'Rongot Freeze Chocomalt Keju', 'harga' => '16 K'],
 ['nama' => 'Rongot Freeze Chocomalt Moza', 'harga' => '18 K'],
 ['nama' => 'Rongot Freeze Chocomalt Keju Moza', 'harga' => '21 K'],
 ['nama' => 'Rongot Coklat', 'harga' => '8 K'],
 ['nama' => 'Rongot Keju', 'harga' => '9 K'],
 ['nama' => 'Rongot Coklat Keju', 'harga' => '11 K'],
 ['nama' => 'Rongot Coklat Keju Moza', 'harga' => '16 K'],
];
$menu_frozen = [
 ['nama' => 'Ayam Brongot Frozen', 'single' => '29 K', 'single_label' => '1/4 Kg', 'double' => '49 K', 'double_label' => '1/2 Kg'],
 ['nama' => 'Jamur Brongot Frozen', 'single' => '24 K', 'single_label' => '1/4 Kg', 'double' => '42 K', 'double_label' => '1/2 Kg'],
 ['nama' => 'Bakso Brongot Frozen', 'single' => '27 K', 'single_label' => '15 Pcs', 'double' => '37 K', 'double_label' => '25 Pcs'],
 ['nama' => 'Sambal Numan (Bawang/Dewata)', 'harga' => '33 K'],
];
$menu_drink = [
 ['nama' => 'Lyche Float', 'harga' => '12 K'], ['nama' => 'Strawberry Float', 'harga' => '12 K'], ['nama' => 'Mango Float', 'harga' => '12 K'], ['nama' => 'Lemon Float', 'harga' => '13 K'], ['nama' => 'Choco Float', 'harga' => '13 K'], ['nama' => 'Teh Tarik Float', 'harga' => '13 K'], ['nama' => 'Choco Malt Float', 'harga' => '13 K'], ['nama' => 'Cappucino Float', 'harga' => '14 K'], ['nama' => 'Lyche Squash', 'harga' => '9 K'], ['nama' => 'Strawberry Squash', 'harga' => '9 K'], ['nama' => 'Mango Squash', 'harga' => '9 K'], ['nama' => 'Lemon Squash', 'harga' => '9 K'], ['nama' => 'Es Teh', 'harga' => '4 K'], ['nama' => 'Strawberry Tea', 'harga' => '7 K'], ['nama' => 'Lychee Tea', 'harga' => '7 K'], ['nama' => 'Lemon Tea', 'harga' => '7 K'], ['nama' => 'Mango Tea', 'harga' => '7 K'], ['nama' => 'Es Coklat', 'harga' => '7 K'], ['nama' => 'Es Teh Tarik', 'harga' => '7 K'], ['nama' => 'Es Choco Malt', 'harga' => '7 K'], ['nama' => 'Es Cappucino', 'harga' => '8 K'], ['nama' => 'Es Batu', 'harga' => '1 K'], ['nama' => 'Air Es / Biasa / Hangat', 'harga' => '2 K'], ['nama' => 'Air Mineral Botol', 'harga' => '5 K'], ['nama' => 'Es Mango', 'harga' => '5 K'], ['nama' => 'Es Lemon', 'harga' => '5 K'], ['nama' => 'Es Strawberry', 'harga' => '5 K'], ['nama' => 'Es Lychee', 'harga' => '5 K'],
];

// 2. MENGGABUNGKAN MENU & MENGKONVERSI HARGA ASLI MENJADI DICTIONARY UNTUK PENCOCOKAN
$semua_kategori = [$menu_geprek, $menu_dewata, $menu_brongot, $menu_rongot, $menu_frozen, $menu_drink];
$harga_asli_server = [];

foreach($semua_kategori as $kategori) {
    foreach($kategori as $item) {
        if (isset($item['single'])) {
            $hargaS = (int)preg_replace('/[^0-9]/', '', $item['single']) * 1000;
            $hargaD = (int)preg_replace('/[^0-9]/', '', $item['double']) * 1000;
            $labelS = isset($item['single_label']) ? $item['single_label'] : 'Single (1 Lauk)';
            $labelD = isset($item['double_label']) ? $item['double_label'] : 'Double (2 Lauk)';
            
            // Nama di-mapping persis sama seperti format di keranjang JS
            $harga_asli_server[$item['nama'] . ' (' . $labelS . ')'] = $hargaS;
            $harga_asli_server[$item['nama'] . ' (' . $labelD . ')'] = $hargaD;
            $harga_asli_server[$item['nama'] . ' (Single)'] = $hargaS;
            $harga_asli_server[$item['nama'] . ' (Double)'] = $hargaD;
        } else {
            $hargaAngka = (int)preg_replace('/[^0-9]/', '', $item['harga']) * 1000;
            $harga_asli_server[$item['nama']] = $hargaAngka;
        }
    }
}

// 3. TANGKAP DATA DARI FORM
$nama = htmlspecialchars($_POST['nama'] ?? '');
$nomorWa = htmlspecialchars($_POST['nomorWa'] ?? '');
$tipePesanan = $_POST['tipePesanan'] ?? '';
$metodeBayar = $_POST['metodeBayar'] ?? '';
$alamat = htmlspecialchars($_POST['alamat'] ?? '');
$link_gps = htmlspecialchars($_POST['link_gps'] ?? '');
$jarak = floatval($_POST['jarak'] ?? 0);
$cart_data = json_decode($_POST['cart_data'], true);

// 4. HITUNG ULANG SUBTOTAL (BERDASARKAN HARGA SERVER, BUKAN DATA DARI BROWSER)
$subtotal = 0;
$rincian_pesanan = "";

if (is_array($cart_data)) {
    foreach ($cart_data as $item) {
        $nama_item = $item['nama']; // Contoh: "Nasi Ayam Geprek Ori (Single (1 Lauk))"
        $qty = (int)$item['qty'];
        
        // Verifikasi keaslian barang
        if (array_key_exists($nama_item, $harga_asli_server)) {
            $harga_real = $harga_asli_server[$nama_item];
            $total_harga_item = $harga_real * $qty;
            $subtotal += $total_harga_item;
            
            $rincian_pesanan .= "- {$qty}x {$nama_item} (Rp " . number_format($total_harga_item, 0, ',', '.') . ")\n";
        } else {
            // Jika seseorang mengedit nama barang lewat Inspect Element
            $rincian_pesanan .= "- {$qty}x {$nama_item} [NAMA ITEM DIMANIPULASI / TIDAK VALID]\n";
        }
    }
}

// 5. HITUNG ULANG ONGKOS KIRIM (RAHASIA DI SERVER)
$ongkir = 0;
if ($tipePesanan === 'Diantar') {
    if ($jarak <= 5) {
        $ongkir = 5000;
    } else {
        $lebihKm = $jarak - 5;
        // Hitung kelipatan 200 meter (0.2 km). Menggunakan ceil() bawaan PHP
        $tambahOngkir = ceil($lebihKm / 0.2) * 500;
        $ongkir = 5000 + $tambahOngkir;
    }
}

// 6. TAMBAHKAN KODE UNIK PEMBAYARAN (Strategi Keamanan Lanjutan)
$kode_unik = rand(11, 99);
$total_bayar = $subtotal + $ongkir + $kode_unik;

// 7. SUSUN TEKS WHATSAPP
$teks_wa = "Halo Admin Numanke! 🍗🔥\n\nSaya ingin memesan dengan rincian berikut:\n\n";
$teks_wa .= "*DATA PEMESAN:*\n";
$teks_wa .= "- Nama: {$nama}\n";
$teks_wa .= "- No. WA: {$nomorWa}\n";
$teks_wa .= "- Tipe: {$tipePesanan}\n";

if ($tipePesanan === 'Diantar') {
    $teks_wa .= "- Alamat: {$alamat}\n";
    if (!empty($link_gps)) {
        $teks_wa .= "- Link GPS: {$link_gps}\n";
    }
    $teks_wa .= "- Jarak: " . number_format($jarak, 2) . " km\n";
}

$teks_wa .= "- Pembayaran: {$metodeBayar}\n\n";
$teks_wa .= "*RINCIAN PESANAN:*\n";
$teks_wa .= $rincian_pesanan;

if ($tipePesanan === 'Diantar' && $ongkir > 0) {
    $teks_wa .= "- Ongkos Kirim: Rp " . number_format($ongkir, 0, ',', '.') . "\n";
}

$teks_wa .= "- Kode Unik Keamanan: Rp {$kode_unik}\n";
$teks_wa .= "\n*TOTAL BAYAR: Rp " . number_format($total_bayar, 0, ',', '.') . "*\n\n";
$teks_wa .= "Mohon diproses ya min!";

$nomorAdmin = "6288802732001"; // Nomor Admin Asli
$link_whatsapp = "https://wa.me/{$nomorAdmin}?text=" . urlencode($teks_wa);

// 8. TAMPILKAN HALAMAN REDIRECT (Untuk menghapus keranjang lama di browser lalu pindah ke WA)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memproses Pesanan... - Numanke</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            background: #ffffff; 
            color: #18181b; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            text-align: center;
            padding: 2rem;
        }
        .redirect-box {
            background: #ffffff;
            border: 1px solid #e4e4e7;
            border-radius: 24px;
            box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.08);
            padding: 3rem 2.25rem;
            max-width: 440px;
            width: 100%;
        }
        .logo-bounce {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            border: 2px solid #c92a2a;
            box-shadow: 0 8px 20px rgba(201, 42, 42, 0.25);
            animation: pulse 1.4s infinite ease-in-out;
            margin-bottom: 1.5rem;
            object-fit: cover;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(0.96); }
            50% { transform: scale(1.05); }
        }
        h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.85rem;
            font-weight: 800;
            color: #c92a2a;
            margin-bottom: 0.5rem;
        }
        p {
            font-size: 0.95rem;
            color: #52525b;
            font-weight: 500;
            line-height: 1.6;
        }
        .spinner-bar {
            width: 100%;
            height: 6px;
            background: #f4f4f6;
            border-radius: 999px;
            overflow: hidden;
            margin-top: 1.75rem;
        }
        .spinner-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #c92a2a 0%, #f59f00 100%);
            animation: loadProgress 1.4s ease forwards;
        }
        @keyframes loadProgress {
            0% { width: 0%; }
            100% { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="redirect-box">
        <img src="assets/images/logo numanke.png" alt="Numanke Logo" class="logo-bounce" onerror="this.style.display='none'">
        <h2>Mengamankan Pesanan...</h2>
        <p>Pesanan Anda sedang dirangkum dan Anda akan segera dialihkan ke WhatsApp resmi Numanke.</p>
        <div class="spinner-bar">
            <div class="spinner-fill"></div>
        </div>
    </div>
    
    <script>
        localStorage.removeItem('numanke_cart');
        setTimeout(function() {
            window.location.href = "<?php echo $link_whatsapp; ?>";
        }, 1400);
    </script>
</body>
</html>