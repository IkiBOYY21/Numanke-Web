<?php
// Pastikan permintaan ini adalah POST dari form checkout
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses ditolak. Harap pesan melalui halaman menu.");
}

// 1. AMBIL HARGA ASLI RESMI DARI DATABASE & KATALOG TERPUSAT
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/menu_manager.php';
$harga_asli_server = get_server_price_map();

// 3. TANGKAP DATA DARI FORM
$nama = htmlspecialchars($_POST['nama'] ?? '');
$nomorWa = htmlspecialchars($_POST['nomorWa'] ?? '');
$tipePesanan = $_POST['tipePesanan'] ?? '';
$metodeBayar = $_POST['metodeBayar'] ?? '';
$alamat = htmlspecialchars($_POST['alamat'] ?? '');
$link_gps = htmlspecialchars($_POST['link_gps'] ?? '');
$jarak = floatval($_POST['jarak'] ?? 0);
$cart_data = json_decode($_POST['cart_data'], true);

// 4. HITUNG ULANG SUBTOTAL (BERDASARKAN HARGA SERVER RESMI, BUKAN DARI CLIENT)
$subtotal = 0;
$rincian_pesanan = "";
$saved_items = [];

if (is_array($cart_data)) {
    foreach ($cart_data as $item) {
        $nama_raw = trim($item['nama'] ?? '');
        $qty = max(1, (int)($item['qty'] ?? 1));
        
        // Ambil catatan jika ada
        $catatan = trim($item['catatan'] ?? '');
        
        // Ekstrak level pedas jika ada di data item atau di dalam teks nama
        $level = isset($item['level']) ? (int)$item['level'] : 0;
        if (preg_match('/\[Level\s*(\d+)\]/i', $nama_raw, $mLvl)) {
            $level = (int)$mLvl[1];
        }
        
        // Bersihkan nama item untuk pencocokan harga asli di server map
        $lookup_name = trim(preg_replace('/\s*\[Level\s*\d+\]/i', '', $nama_raw));
        $lookup_name = trim(preg_replace('/\s*\[Catatan:.*?\]/i', '', $lookup_name));
        $display_name = $lookup_name;

        // Verifikasi keaslian barang dari server price map
        $harga_real = 0;
        $valid = false;

        if (array_key_exists($lookup_name, $harga_asli_server)) {
            $harga_real = $harga_asli_server[$lookup_name];
            $valid = true;
        } elseif (isset($item['base_nama']) && array_key_exists($item['base_nama'], $harga_asli_server)) {
            $harga_real = $harga_asli_server[$item['base_nama']];
            $valid = true;
        } else {
            // Coba tanpa tanda kurung tambahan
            $plain_name = trim(preg_replace('/\s*\(.*?\)/', '', $lookup_name));
            if (array_key_exists($plain_name, $harga_asli_server)) {
                $harga_real = $harga_asli_server[$plain_name];
                $valid = true;
            }
        }

        if ($valid) {
            $total_harga_item = $harga_real * $qty;
            $subtotal += $total_harga_item;
            
            $item_line = "- {$qty}x {$display_name}";
            $full_display = "{$display_name}";
            if ($level > 0) {
                $item_line .= " (Level Pedas: {$level})";
                $full_display .= " [Level {$level}]";
            }
            if (!empty($catatan)) {
                $item_line .= " [Catatan: {$catatan}]";
                $full_display .= " [Catatan: {$catatan}]";
            }
            $item_line .= " (Rp " . number_format($total_harga_item, 0, ',', '.') . ")\n";
            $rincian_pesanan .= $item_line;

            $saved_items[] = [
                'full_display' => $full_display,
                'lookup_name' => $lookup_name,
                'qty' => $qty,
                'harga' => $harga_real,
                'subtotal' => $total_harga_item
            ];
        } else {
            // Jika ada nama item yang tidak cocok sama sekali di katalog server
            $rincian_pesanan .= "- {$qty}x {$nama_raw} [NAMA ITEM TIDAK VALID / DIMANIPULASI]\n";
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

// 7. SIMPAN PESANAN KE DATABASE (ORDERS & ORDER_ITEMS)
$order_id_db = null;
if (isset($conn) && !$conn->connect_error) {
    try {
        $c_name = $conn->real_escape_string($nama);
        $c_phone = $conn->real_escape_string($nomorWa);
        
        $c_address_full = "[{$tipePesanan}]";
        if ($tipePesanan === 'Diantar') {
            $c_address_full .= " " . $alamat;
            if ($jarak > 0) $c_address_full .= " (Jarak: " . number_format($jarak, 1) . " km, Ongkir: Rp " . number_format($ongkir, 0, ',', '.') . ")";
            if (!empty($link_gps)) $c_address_full .= " | GPS: " . $link_gps;
        }
        $c_address_full .= " | Bayar: " . $metodeBayar;
        if ($kode_unik > 0) $c_address_full .= " (Kode: " . $kode_unik . ")";
        $c_address = $conn->real_escape_string($c_address_full);
        
        $sql_order = "INSERT INTO orders (customer_name, customer_phone, customer_address, total_price, status, order_date) 
                      VALUES ('$c_name', '$c_phone', '$c_address', '$total_bayar', 'Menunggu', NOW())";
        if ($conn->query($sql_order)) {
            $order_id_db = $conn->insert_id;
            
            // Simpan setiap item ke tabel order_items
            foreach ($saved_items as $s_item) {
                $m_name_clean = $conn->real_escape_string($s_item['full_display']);
                $m_qty = (int)$s_item['qty'];
                $m_subtotal = (float)$s_item['subtotal'];
                $m_lookup = $conn->real_escape_string($s_item['lookup_name']);
                
                // Cari ID menu di database jika ada
                $menu_id_val = "NULL";
                $res_m = $conn->query("SELECT id FROM menu WHERE name = '$m_lookup' OR name LIKE '$m_lookup%' LIMIT 1");
                if ($res_m && $r_m = $res_m->fetch_assoc()) {
                    $menu_id_val = (int)$r_m['id'];
                }
                
                $conn->query("INSERT INTO order_items (order_id, menu_id, menu_name, quantity, subtotal) 
                              VALUES ('$order_id_db', $menu_id_val, '$m_name_clean', '$m_qty', '$m_subtotal')");
            }
        }
    } catch (Exception $e) {
        // Fallback jika database sedang offline, tetap lanjut ke WhatsApp
    }
}

// 8. SUSUN TEKS WHATSAPP
$kode_ord_text = $order_id_db ? "#ORD-" . str_pad($order_id_db, 3, '0', STR_PAD_LEFT) : "";
$teks_wa = "Halo Admin Numanke! 🍗🔥\n\nSaya ingin memesan " . ($kode_ord_text ? "({$kode_ord_text}) " : "") . "dengan rincian berikut:\n\n";
$teks_wa .= "*DATA PEMESAN:*\n";
if ($kode_ord_text) {
    $teks_wa .= "- No. Pesanan: {$kode_ord_text}\n";
}
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