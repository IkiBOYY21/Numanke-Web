<!-- checkout.php -->
<?php 
require_once 'includes/db.php';
require_once 'includes/header.php'; 

// Pastikan file ini hanya bisa diakses jika ada data yang dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Ambil & bersihkan data pelanggan (Mencegah SQL Injection)
    $nama     = $conn->real_escape_string($_POST['customer_name']);
    $whatsapp = $conn->real_escape_string($_POST['customer_phone']);
    $alamat   = $conn->real_escape_string($_POST['customer_address']);
    
    // 2. Ambil data JSON keranjang dan ubah kembali menjadi Array PHP
    $cart_json  = $_POST['cart_data'];
    $cart_items = json_decode($cart_json, true);

    // Cek jika tiba-tiba keranjang kosong
    if (empty($cart_items)) {
        echo "<div style='text-align:center; padding: 100px 20px;'>
                <h2>Keranjang Anda kosong!</h2>
                <p>Silakan pilih menu terlebih dahulu.</p>
                <br>
                <a href='order.php' class='btn btn-primary'>Kembali ke Menu</a>
              </div>";
    } else {
        // 3. Hitung total harga (Dihitung ulang di server agar lebih aman)
        $total_price = 0;
        foreach ($cart_items as $item) {
            $total_price += ($item['harga'] * $item['qty']);
        }

        // --- MULAI PROSES PENYIMPANAN DATABASE ---
        $conn->begin_transaction();

        try {
            // A. Simpan data utama ke tabel 'orders'
            $sql_order = "INSERT INTO orders (customer_name, customer_phone, customer_address, total_price, status) 
                          VALUES ('$nama', '$whatsapp', '$alamat', '$total_price', 'pending')";
            $conn->query($sql_order);
            
            // Ambil ID (Nomor Order) yang baru saja otomatis dibuat oleh database
            $order_id = $conn->insert_id;

            // B. Simpan rincian menu ke tabel 'order_items'
            foreach ($cart_items as $item) {
                $menu_id  = $item['id'];
                $qty      = $item['qty'];
                $subtotal = $item['harga'] * $item['qty'];

                $sql_items = "INSERT INTO order_items (order_id, menu_id, quantity, subtotal) 
                              VALUES ('$order_id', '$menu_id', '$qty', '$subtotal')";
                $conn->query($sql_items);
            }

            // Jika A dan B berhasil, simpan permanen (Commit)
            $conn->commit();

            // TAMPILAN JIKA PESANAN BERHASIL
            ?>
            <div style="text-align: center; padding: 80px 5%; min-height: 60vh;">
                <h1 style="color: #27ae60; font-size: 3rem; margin-bottom: 10px;">🎉 Pesanan Berhasil!</h1>
                <h2>Terima kasih, <?php echo htmlspecialchars($nama); ?>!</h2>
                <p style="color: var(--text-muted); margin-top: 15px; font-size: 1.1rem;">
                    Pesanan Ayam Brongot Anda telah kami terima dan akan segera diproses.<br>
                    Tim kami mungkin akan menghubungi Anda di nomor <strong><?php echo htmlspecialchars($whatsapp); ?></strong> jika diperlukan.
                </p>
                
                <div style="background-color: var(--white); padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: inline-block; margin: 30px 0; text-align: left; min-width: 300px;">
                    <p style="margin-bottom: 5px;">Nomor Order: <strong style="float: right;">#ORD-<?php echo $order_id; ?></strong></p>
                    <p style="margin-bottom: 5px;">Total Bayar: <strong style="float: right; color: var(--primary-red);">Rp <?php echo number_format($total_price, 0, ',', '.'); ?></strong></p>
                    <p style="margin-bottom: 5px;">Status: <strong style="float: right; color: #f39c12;">Menunggu Konfirmasi</strong></p>
                </div>
                
                <br>
                <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
            </div>

            <!-- Skrip untuk mereset keranjang di browser setelah sukses pesanan -->
            <script>
                // Karena data keranjang tadi tersimpan di variabel JS 'keranjang' halaman order, 
                // jika menggunakan localStorage, hapus datanya di sini.
            </script>
            <?php

        } catch (Exception $e) {
            // Jika terjadi kegagalan (misal database mati di tengah jalan), batalkan semua inputan (Rollback)
            $conn->rollback();
            
            echo "<div style='text-align:center; padding: 100px 20px;'>
                    <h2 style='color: red;'>Mohon Maaf, Terjadi Kesalahan Sistem</h2>
                    <p>Error: " . $e->getMessage() . "</p>
                    <br>
                    <a href='order.php' class='btn btn-primary'>Coba Pesan Lagi</a>
                  </div>";
        }
    }
} else {
    // Jika ada pengunjung iseng yang mengetik 'checkout.php' langsung di URL, tendang kembali ke home
    header("Location: index.php");
    exit();
}

require_once 'includes/footer.php'; 
?>