<?php  
// dapur-admin/manage_orders.php
session_start();  
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {  
    header("Location: masuk.php");  
    exit();  
}  
require_once '../includes/db.php';  
  
$pesan = '';

// 1. KOSONGKAN SEMUA PESANAN
if (isset($_POST['kosongkan_pesanan'])) {  
    $conn->query("SET FOREIGN_KEY_CHECKS = 0"); 
    $conn->query("TRUNCATE TABLE order_items"); 
    $conn->query("TRUNCATE TABLE orders");
    $conn->query("SET FOREIGN_KEY_CHECKS = 1"); 
    header("Location: manage_orders.php?sukses=reset");  
    exit();  
}  

// 2. HAPUS PESANAN TUNGGAL
if (isset($_GET['hapus_order'])) {
    $del_id = (int)$_GET['hapus_order'];
    $conn->query("DELETE FROM order_items WHERE order_id = '$del_id'");
    $conn->query("DELETE FROM orders WHERE id = '$del_id'");
    header("Location: manage_orders.php?sukses=hapus");
    exit();
}
  
// 3. UPDATE STATUS PESANAN
if (isset($_POST['update_status'])) {  
    $order_id = (int)$_POST['order_id'];  
    $new_status = $conn->real_escape_string($_POST['status']);  
    $conn->query("UPDATE orders SET status = '$new_status' WHERE id = '$order_id'");  
    header("Location: manage_orders.php?sukses=update");  
    exit();  
}  

if (isset($_GET['sukses'])) {
    if ($_GET['sukses'] == 'update') {
        $pesan = "<div class='toast-notice' style='border-left-color:#10b981;'><i class='fa-solid fa-circle-check text-success fs-5'></i> <div>Status pesanan berhasil diperbarui!</div></div>";
    } elseif ($_GET['sukses'] == 'hapus') {
        $pesan = "<div class='toast-notice' style='border-left-color:#ef4444;'><i class='fa-solid fa-trash-can text-danger fs-5'></i> <div>Pesanan telah berhasil dihapus.</div></div>";
    } elseif ($_GET['sukses'] == 'reset') {
        $pesan = "<div class='toast-notice' style='border-left-color:#ef4444;'><i class='fa-solid fa-broom text-danger fs-5'></i> <div>Semua riwayat pesanan telah dikosongkan.</div></div>";
    }
}

// 4. QUERY RINGKASAN STATISTIK PESANAN
$stat_total = 0;
$stat_pending = 0;
$stat_processing = 0;
$stat_completed = 0;
$stat_total_revenue = 0;

$q_order_stats = $conn->query("SELECT 
    COUNT(*) as total,
    COUNT(CASE WHEN status IN ('Menunggu', 'pending') THEN 1 END) as pending,
    COUNT(CASE WHEN status IN ('Diproses', 'processing') THEN 1 END) as processing,
    COUNT(CASE WHEN status IN ('Selesai', 'completed') THEN 1 END) as completed,
    SUM(CASE WHEN status IN ('Selesai', 'completed') THEN total_price ELSE 0 END) as omset
FROM orders");

if ($q_order_stats && $s_row = $q_order_stats->fetch_assoc()) {
    $stat_total = (int)$s_row['total'];
    $stat_pending = (int)$s_row['pending'];
    $stat_processing = (int)$s_row['processing'];
    $stat_completed = (int)$s_row['completed'];
    $stat_total_revenue = (float)($s_row['omset'] ?? 0);
}

// 5. QUERY SELURUH DATA PESANAN & RINCIAN ITEM
$query = "SELECT * FROM orders ORDER BY order_date DESC";  
$result = $conn->query($query);
$orders_list = [];
$order_ids = [];
if ($result) {
    while($r = $result->fetch_assoc()) {
        $orders_list[] = $r;
        $order_ids[] = (int)$r['id'];
    }
}

$items_by_order = [];
if (!empty($order_ids)) {
    $ids_str = implode(',', $order_ids);
    $q_items = $conn->query("SELECT * FROM order_items WHERE order_id IN ($ids_str) ORDER BY id ASC");
    if ($q_items) {
        while($it = $q_items->fetch_assoc()) {
            $items_by_order[$it['order_id']][] = $it;
        }
    }
}
?>  
<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Kelola Pesanan - Admin Numanke</title>  
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>  
<body>  
  
<!-- SIDEBAR -->
<div class="sidebar">  
    <a href="index.php" class="sidebar-brand">
        <img src="../assets/images/logo numanke.png" alt="Numanke">
        <div class="sidebar-brand-text">
            <h2>Numanke<span>.</span></h2>
            <small>Dapur Admin</small>
        </div>
    </a>

    <div class="sidebar-nav">
        <span class="nav-category">Navigasi Utama</span>
        <a href="index.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
        <a href="manage_stories.php"><i class="fa-solid fa-newspaper"></i> Cerita & Berita</a>
        <a href="manage_settings.php"><i class="fa-solid fa-sliders"></i> Pengaturan Web</a>
        
        <span class="nav-category">Pesanan & Menu</span>
        <a href="manage_orders.php" class="active"><i class="fa-solid fa-cart-shopping"></i> Kelola Pesanan</a>
        <a href="manage_menu.php"><i class="fa-solid fa-bowl-food"></i> Kelola Menu</a>
    </div>

    <div class="sidebar-bottom">
        <a href="../order.php" target="_blank" class="btn-view-site">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Halaman Order
        </a>
        <a href="keluar.php" class="logout-link">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
        </a>
    </div>
</div>  
  
<!-- MAIN CONTENT -->
<div class="main-content">  
    
    <!-- Top Header -->
    <div class="admin-header-flex" data-aos="fade-down">  
        <div class="admin-header-title">  
            <h1>Daftar Pesanan Masuk</h1>  
            <p>Pantau aliran pesanan pelanggan, ubah status dapur, dan hubungi pelanggan langsung via WhatsApp.</p>  
        </div>  
        <div class="admin-header-actions">
            <span class="live-status-pill">
                <span class="live-dot"></span>
                <span>Auto-Sync Aktif</span>
            </span>
            <form method="POST" onsubmit="return confirm('Peringatan: Yakin ingin MENGHAPUS SEMUA data pesanan secara permanen? Data tidak dapat dipulihkan.');" style="margin:0;">  
                <button type="submit" name="kosongkan_pesanan" class="admin-btn admin-btn-danger" style="padding: 10px 18px; font-size: 0.85rem;">
                    <i class="fa-solid fa-trash-can"></i> Kosongkan Riwayat
                </button>  
            </form>  
        </div>
    </div>  
  
    <?php echo $pesan; ?>

    <!-- STAT CARDS (4 Ringkasan Pesanan) -->
    <div class="stat-card-container" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card gold">
            <div class="stat-card-header">
                <h4>Menunggu Konfirmasi</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-clock"></i></div>
            </div>
            <h2><?php echo $stat_pending; ?> <small style="font-size: 1rem; font-weight: 600; color: var(--admin-text-muted);">Pesanan</small></h2>
            <div class="stat-card-trend" style="color: var(--admin-gold);">
                <i class="fa-solid fa-bell"></i> Perlu diproses kasir
            </div>
        </div>

        <div class="stat-card purple">
            <div class="stat-card-header">
                <h4>Sedang Diproses</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-fire-burner"></i></div>
            </div>
            <h2><?php echo $stat_processing; ?> <small style="font-size: 1rem; font-weight: 600; color: var(--admin-text-muted);">Pesanan</small></h2>
            <div class="stat-card-trend" style="color: #7c3aed;">
                <i class="fa-solid fa-kitchen-set"></i> Sedang dimasak dapur
            </div>
        </div>

        <div class="stat-card green">
            <div class="stat-card-header">
                <h4>Pesanan Selesai</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-circle-check"></i></div>
            </div>
            <h2><?php echo $stat_completed; ?> <small style="font-size: 1rem; font-weight: 600; color: var(--admin-text-muted);">Transaksi</small></h2>
            <div class="stat-card-trend" style="color: #059669;">
                <i class="fa-solid fa-thumbs-up"></i> Sukses & terkirim
            </div>
        </div>

        <div class="stat-card red">
            <div class="stat-card-header">
                <h4>Total Omset Selesai</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-wallet"></i></div>
            </div>
            <h2>Rp <?php echo number_format($stat_total_revenue, 0, ',', '.'); ?></h2>
            <div class="stat-card-trend" style="color: var(--admin-red);">
                <i class="fa-solid fa-chart-line"></i> Total penjualan tervalidasi
            </div>
        </div>
    </div>
  
    <!-- TABEL KELOLA PESANAN (CARD MODERN) -->
    <div class="admin-table-card" data-aos="fade-up" data-aos-delay="200">  
        <div class="admin-table-card-header">
            <div>
                <h3 style="font-family: 'Playfair Display', serif; font-size: 1.35rem; font-weight: 800; margin: 0; color: var(--admin-dark);">
                    <i class="fa-solid fa-receipt text-danger me-2"></i>Daftar Seluruh Pesanan
                </h3>
                <small style="color: var(--admin-text-muted); font-weight: 600;">
                    Menampilkan <span id="displayedOrdersCount" style="color:var(--admin-red); font-weight:800;"><?php echo count($orders_list); ?></span> dari <?php echo count($orders_list); ?> total pesanan.
                </small>
            </div>

            <!-- Live Search Bar -->
            <div class="admin-search-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="orderSearchInput" class="admin-search-input" placeholder="Cari nama, nomor WA, ID pesanan..." onkeyup="filterOrderTable()">
            </div>
        </div>

        <!-- Filter Status Bar -->
        <div style="padding: 16px 24px 8px 24px; border-bottom: 1px solid var(--admin-border); background: #ffffff;">
            <div class="filter-tab-bar" id="statusFilterBar">
                <button type="button" class="filter-tab-pill active" onclick="filterByStatus('all', this)">
                    Semua Pesanan <span class="pill-count"><?php echo count($orders_list); ?></span>
                </button>
                <button type="button" class="filter-tab-pill" onclick="filterByStatus('Menunggu', this)">
                    <span style="color: #d97706;">●</span> Menunggu <span class="pill-count"><?php echo $stat_pending; ?></span>
                </button>
                <button type="button" class="filter-tab-pill" onclick="filterByStatus('Diproses', this)">
                    <span style="color: #0284c7;">●</span> Diproses <span class="pill-count"><?php echo $stat_processing; ?></span>
                </button>
                <button type="button" class="filter-tab-pill" onclick="filterByStatus('Selesai', this)">
                    <span style="color: #16a34a;">●</span> Selesai <span class="pill-count"><?php echo $stat_completed; ?></span>
                </button>
                <button type="button" class="filter-tab-pill" onclick="filterByStatus('Dibatalkan', this)">
                    <span style="color: #dc2626;">●</span> Dibatalkan
                </button>
            </div>
        </div>

        <!-- Table View -->
        <div style="overflow-x: auto;">
            <table class="table-modern" id="ordersDataTable">  
                <thead>  
                    <tr>  
                        <th style="width: 130px;">Waktu & ID</th>  
                        <th>Nama Pelanggan</th>  
                        <th style="min-width: 200px;">Menu Dipesan</th>  
                        <th>Alamat / Pengiriman</th>  
                        <th>Hubungi WhatsApp</th>  
                        <th>Total Bayar</th>  
                        <th>Status</th>  
                        <th style="width: 200px; text-align: center;">Perbarui Status</th>  
                        <th style="width: 60px; text-align: center;">Hapus</th>
                    </tr>  
                </thead>  
                <tbody id="ordersTableBody">  
                    <?php if(!empty($orders_list)): ?>  
                        <?php foreach($orders_list as $row): 
                            $status_val = $row['status'];
                            
                            // Normalisasi status teks untuk badge
                            $normalized_status = 'Menunggu';
                            $badge_class = 'badge-status-pending';

                            if ($status_val == 'Diproses' || $status_val == 'processing') {
                                $normalized_status = 'Diproses';
                                $badge_class = 'badge-status-processing';
                            } elseif ($status_val == 'Selesai' || $status_val == 'completed') {
                                $normalized_status = 'Selesai';
                                $badge_class = 'badge-status-completed';
                            } elseif ($status_val == 'Dibatalkan' || $status_val == 'cancelled') {
                                $normalized_status = 'Dibatalkan';
                                $badge_class = 'badge-status-cancelled';
                            }

                            $phone_clean = preg_replace('/[^0-9]/', '', $row['customer_phone']);
                            if (substr($phone_clean, 0, 1) === '0') {
                                $phone_clean = '62' . substr($phone_clean, 1);
                            }
                            $wa_msg = urlencode("Halo Kak " . $row['customer_name'] . ", kami dari Numanke ingin mengonfirmasi pesanan #ORD-" . $row['id'] . " Anda.");
                            $wa_link = "https://wa.me/{$phone_clean}?text={$wa_msg}";
                        ?>  
                            <tr class="order-row-item" data-status="<?php echo $normalized_status; ?>">  
                                <td>
                                    <span style="display: block; font-weight: 800; color: var(--admin-dark); font-size: 0.88rem;">
                                        #ORD-<?php echo str_pad($row['id'], 3, '0', STR_PAD_LEFT); ?>
                                    </span>
                                    <small style="color: var(--admin-text-muted); font-size: 0.75rem; display: inline-flex; align-items: center; gap: 4px; margin-top: 2px;">
                                        <i class="fa-regular fa-clock"></i> <?php echo date('d M, H:i', strtotime($row['order_date'])); ?> WIB
                                    </small>
                                </td>  
                                
                                <td>
                                    <strong style="color: var(--admin-dark); font-size: 0.95rem; display: block;">
                                        <?php echo htmlspecialchars($row['customer_name']); ?>
                                    </strong>
                                </td>  
                                
                                <td>
                                    <?php 
                                    $o_items = $items_by_order[$row['id']] ?? [];
                                    if (!empty($o_items)): 
                                    ?>
                                        <div class="order-items-snippet">
                                            <?php foreach($o_items as $oit): ?>
                                                <div class="order-item-pill">
                                                    <span class="order-item-qty"><?php echo $oit['quantity']; ?>x</span>
                                                    <span class="order-item-name"><?php echo htmlspecialchars($oit['menu_name']); ?></span>
                                                    <span class="order-item-price">Rp <?php echo number_format($oit['subtotal'], 0, ',', '.'); ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <span style="color: var(--admin-text-muted); font-size: 0.8rem; font-style: italic;">
                                            <i class="fa-solid fa-receipt text-muted me-1"></i>Rincian di WA
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if(!empty($row['customer_address'])): ?>
                                        <span style="font-size: 0.82rem; color: var(--admin-text-main); display: inline-flex; align-items: flex-start; gap: 5px;">
                                            <i class="fa-solid fa-location-dot text-danger mt-1"></i>
                                            <span style="max-width: 200px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                <?php echo htmlspecialchars($row['customer_address']); ?>
                                            </span>
                                        </span>
                                    <?php else: ?>
                                        <span style="color: var(--admin-text-muted); font-size: 0.8rem; font-style: italic;">
                                            <i class="fa-solid fa-utensils text-muted"></i> Makan di tempat / Ambil
                                        </span>
                                    <?php endif; ?>
                                </td>  

                                <td>
                                    <a href="<?php echo $wa_link; ?>" target="_blank" class="btn-action-wa" title="Buka Chat WhatsApp">
                                        <i class="fa-brands fa-whatsapp fs-6"></i>
                                        <span><?php echo htmlspecialchars($row['customer_phone']); ?></span>
                                    </a>
                                </td>  
                                
                                <td>
                                    <div style="font-weight: 800; color: var(--admin-dark); font-size: 0.98rem; font-family: 'Plus Jakarta Sans', sans-serif;">
                                        Rp <?php echo number_format($row['total_price'], 0, ',', '.'); ?>
                                    </div>
                                </td>  
                                
                                <td>  
                                    <span class="badge <?php echo $badge_class; ?>">
                                        <?php if($normalized_status == 'Menunggu'): ?>
                                            <i class="fa-solid fa-hourglass-half"></i>
                                        <?php elseif($normalized_status == 'Diproses'): ?>
                                            <i class="fa-solid fa-fire"></i>
                                        <?php elseif($normalized_status == 'Selesai'): ?>
                                            <i class="fa-solid fa-check"></i>
                                        <?php else: ?>
                                            <i class="fa-solid fa-xmark"></i>
                                        <?php endif; ?>
                                        <?php echo $normalized_status; ?>
                                    </span>  
                                </td>  
                                
                                <td style="text-align: center;">  
                                    <form method="POST" style="display: inline-flex; align-items: center; gap: 6px; margin: 0;">  
                                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">  
                                        <select name="status" class="order-status-select">  
                                            <option value="Menunggu" <?php if($normalized_status == 'Menunggu') echo 'selected'; ?>>Menunggu</option>  
                                            <option value="Diproses" <?php if($normalized_status == 'Diproses') echo 'selected'; ?>>Diproses</option>  
                                            <option value="Selesai" <?php if($normalized_status == 'Selesai') echo 'selected'; ?>>Selesai</option>  
                                            <option value="Dibatalkan" <?php if($normalized_status == 'Dibatalkan') echo 'selected'; ?>>Dibatalkan</option>  
                                        </select>  
                                        <button type="submit" name="update_status" class="btn-action-update" title="Simpan Status">
                                            <i class="fa-solid fa-check"></i>
                                        </button>  
                                    </form>  
                                </td>  

                                <td style="text-align: center;">
                                    <a href="?hapus_order=<?php echo $row['id']; ?>" class="btn-action-delete" style="padding: 6px 9px;" onclick="return confirm('Hapus data pesanan #ORD-<?php echo $row['id']; ?>?');" title="Hapus Pesanan Ini">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>  
                        <?php endforeach; ?>  
                    <?php else: ?>  
                        <tr id="emptyOrderRowGlobal">
                            <td colspan="9">
                                <div class="admin-empty-state">
                                    <i class="fa-solid fa-clipboard-list"></i>
                                    <h4>Belum Ada Pesanan Masuk</h4>
                                    <p>Saat pelanggan melakukan pemesanan melalui website, data transaksi akan tampil di sini secara otomatis.</p>
                                </div>
                            </td>
                        </tr>  
                    <?php endif; ?>  

                    <!-- Empty Row saat live filter search tidak ada hasil -->
                    <tr id="noSearchOrderRow" style="display: none;">
                        <td colspan="9">
                            <div class="admin-empty-state">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <h4>Pesanan Tidak Ditemukan</h4>
                                <p>Tidak ada pesanan yang cocok dengan kata kunci atau filter status yang Anda pilih.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>  
            </table>  
        </div>
    </div>  

</div>  

<!-- JavaScript untuk Live Search, Filter Status & Auto Sync -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 700, once: true });

    let currentStatusFilter = 'all';

    // Filter berdasarkan tab status
    function filterByStatus(status, btnEl) {
        currentStatusFilter = status;

        document.querySelectorAll('#statusFilterBar .filter-tab-pill').forEach(btn => {
            btn.classList.remove('active');
        });
        if (btnEl) btnEl.classList.add('active');

        filterOrderTable();
    }

    // Instant filter tabel pesanan
    function filterOrderTable() {
        const query = (document.getElementById('orderSearchInput').value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('#ordersTableBody .order-row-item');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowStatus = (row.getAttribute('data-status') || '').trim();
            const rowText = row.innerText.toLowerCase();

            const matchStatus = (currentStatusFilter === 'all') || (rowStatus.toLowerCase() === currentStatusFilter.toLowerCase());
            const matchSearch = (query === '') || (rowText.includes(query));

            if (matchStatus && matchSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const countEl = document.getElementById('displayedOrdersCount');
        if (countEl) countEl.innerText = visibleCount;

        const noResult = document.getElementById('noSearchOrderRow');
        if (noResult) {
            noResult.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
        }
    }

    // Auto-sync berkala tanpa merusak input aktif
    setInterval(function() {
        // Jangan refresh jika admin sedang mengetik di input search
        const searchInput = document.getElementById('orderSearchInput');
        if (searchInput && document.activeElement === searchInput) return;

        fetch('manage_orders.php')
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');
            let newBody = doc.querySelector('#ordersTableBody');
            let oldBody = document.querySelector('#ordersTableBody');
            if (newBody && oldBody && newBody.innerHTML !== oldBody.innerHTML) {
                oldBody.innerHTML = newBody.innerHTML;
                filterOrderTable();
            }
        })
        .catch(err => console.log('Live sync paused:', err));
    }, 12000); 
</script>
</body>  
</html>