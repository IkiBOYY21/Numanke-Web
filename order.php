<!-- order.php -->
<?php 
require_once 'includes/db.php';
require_once 'includes/header.php'; 

// Mengambil semua data menu dari database
$query = "SELECT * FROM menu ORDER BY id DESC";
$result = $conn->query($query);
?>

<section class="order-layout">
    <!-- Bagian Kiri: Katalog Menu -->
    <div class="menu-section">
        <h2>Pilih Menu Favoritmu</h2>
        <div class="menu-grid">
            <?php if($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="menu-card">
                        <!-- Area Gambar -->
                        <div class="menu-img">
                            [Gambar: <?php echo htmlspecialchars($row['name']); ?>]
                        </div>
                        
                        <!-- Area Informasi Menu -->
                        <div class="menu-info">
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p class="menu-desc"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="menu-price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                            
                            <button class="btn btn-primary btn-add-cart" 
                                onclick="tambahKeKeranjang(<?php echo $row['id']; ?>, '<?php echo addslashes($row['name']); ?>', <?php echo $row['price']; ?>)">
                                Tambah ke Pesanan
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: var(--text-muted); font-size: 1.1rem;">Belum ada menu yang tersedia saat ini. Silakan cek kembali nanti.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bagian Kanan: Keranjang Belanja -->
    <div class="cart-section">
        <h2>Pesanan Anda</h2>
        
        <ul id="cart-items" class="cart-list">
            <li class="empty-cart" style="color: var(--text-muted); font-style: italic; text-align: center; padding: 20px 0;">Belum ada hidangan yang dipilih.</li>
        </ul>
        
        <div class="cart-summary">
            <h3>Total Tagihan: <br><span>Rp <span id="cart-total">0</span></span></h3>
        </div>

        <form action="checkout.php" method="POST" id="checkout-form" class="checkout-form" style="display: none;">
            <h3 style="margin-bottom: 15px; font-size: 1.2rem; color: var(--text-dark);">Detail Pengiriman</h3>
            <input type="hidden" name="cart_data" id="cart_data">
            
            <input type="text" name="customer_name" placeholder="Nama Lengkap Pemesan" required>
            <input type="number" name="customer_phone" placeholder="Nomor WhatsApp (Cth: 0812...)" required>
            <textarea name="customer_address" placeholder="Alamat Pengiriman Lengkap" required style="height: 100px; resize: vertical;"></textarea>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 10px; padding: 15px; font-size: 1.05rem;">Proses Pesanan</button>
        </form>
    </div>
</section>

<script src="assets/js/cart.js"></script>
<?php require_once 'includes/footer.php'; ?>