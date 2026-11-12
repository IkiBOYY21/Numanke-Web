<?php
// dapur-admin/index.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: masuk.php");
    exit();
}

require_once '../includes/db.php';
require_once '../includes/content_manager.php';

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-7 days'));
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

$total_omset = 0;
$total_trx = 0;
$label_omset = ['Belum ada data'];
$data_omset = [0];
$label_menu = ['Ayam Brongot Ori', 'Brongot Level Dewa', 'Es Teh Kampul', 'Geprek Keju', 'Rongot Freeze'];
$data_menu = [45, 38, 52, 29, 21];

// Safely query statistics if MySQL is ready
if (isset($conn) && !$conn->connect_error) {
    try {
        $query_stats = "SELECT SUM(total_price) as total_omset, COUNT(id) as total_trx 
                        FROM orders 
                        WHERE status IN ('Selesai', 'completed') 
                        AND DATE(order_date) BETWEEN '$start_date' AND '$end_date'";
        $res_stats = $conn->query($query_stats);
        if ($res_stats && $row = $res_stats->fetch_assoc()) {
            $total_omset = (float)($row['total_omset'] ?? 0);
            $total_trx = (int)($row['total_trx'] ?? 0);
        }

        $query_chart_omset = "SELECT DATE(order_date) as tgl, SUM(total_price) as harian 
                              FROM orders 
                              WHERE status IN ('Selesai', 'completed') 
                              AND DATE(order_date) BETWEEN '$start_date' AND '$end_date' 
                              GROUP BY DATE(order_date) 
                              ORDER BY tgl ASC";
        $res_chart = $conn->query($query_chart_omset);
        if ($res_chart && $res_chart->num_rows > 0) {
            $label_omset = [];
            $data_omset = [];
            while($row = $res_chart->fetch_assoc()) {
                $label_omset[] = date('d M', strtotime($row['tgl']));
                $data_omset[] = (float)$row['harian'];
            }
        }

        $query_menu = "SELECT menu_name, SUM(quantity) as qty 
                       FROM order_items oi 
                       JOIN orders o ON oi.order_id = o.id 
                       WHERE o.status IN ('Selesai', 'completed') 
                       AND DATE(o.order_date) BETWEEN '$start_date' AND '$end_date' 
                       GROUP BY menu_name 
                       ORDER BY qty DESC LIMIT 5";
        $res_menu = $conn->query($query_menu);
        if ($res_menu && $res_menu->num_rows > 0) {
            $label_menu = [];
            $data_menu = [];
            while($r = $res_menu->fetch_assoc()) {
                $label_menu[] = $r['menu_name'];
                $data_menu[] = (int)$r['qty'];
            }
        }
    } catch (Exception $e) {
        // Fallback gracefully without breaking UI
    }
}

// Get Content Stories
$stories = get_site_stories(false);
$active_stories_count = count(array_filter($stories, fn($s) => ($s['status'] ?? 'aktif') === 'aktif'));
$settings = get_site_settings();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Numanke Dapur</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="index.php" class="sidebar-brand">
        <img src="../assets/images/logo numanke.png" alt="Numanke" style="width: 42px; height: 42px; max-width: 42px; max-height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid var(--admin-gold); flex-shrink: 0;">
        <div class="sidebar-brand-text">
            <h2>Numanke<span>.</span></h2>
            <small>Dapur Admin</small>
        </div>
    </a>

    <div class="sidebar-nav">
        <span class="nav-category">Navigasi Utama</span>
        <a href="index.php" class="active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
        <a href="manage_stories.php"><i class="fa-solid fa-newspaper"></i> Cerita & Berita <span class="nav-badge"><?php echo count($stories); ?></span></a>
        <a href="manage_settings.php"><i class="fa-solid fa-sliders"></i> Pengaturan Web</a>
        
        <span class="nav-category">Pesanan & Menu</span>
        <a href="manage_orders.php"><i class="fa-solid fa-cart-shopping"></i> Kelola Pesanan</a>
        <a href="manage_menu.php"><i class="fa-solid fa-bowl-food"></i> Kelola Menu</a>
    </div>

    <div class="sidebar-bottom">
        <a href="../index.php" target="_blank" class="btn-view-site">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Website
        </a>
        <a href="keluar.php" class="logout-link">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
        </a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    
    <!-- HEADER -->
    <div class="admin-header-flex" data-aos="fade-down">
        <div class="admin-header-title">
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin Numanke'); ?>! 🔥</h1>
            <p>Pusat kendali operasional restoran, penjualan, konten cerita, dan kustomisasi tampilan website.</p>
        </div>
        <div class="admin-header-actions">
            <div class="live-status-pill">
                <span class="live-dot"></span>
                <span>Sistem Siap Operasi</span>
            </div>
            <a href="manage_stories.php" class="admin-btn admin-btn-primary">
                <i class="fa-solid fa-circle-plus"></i> Tambah Cerita Baru
            </a>
        </div>
    </div>

    <!-- STATS SUMMARY CARDS -->
    <div class="stat-card-container">
        <!-- Card 1: Omset -->
        <div class="stat-card green" data-aos="zoom-in" data-aos-delay="100">
            <div class="stat-card-header">
                <h4>Total Pendapatan (Selesai)</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-wallet"></i></div>
            </div>
            <h2>Rp <?php echo number_format($total_omset, 0, ',', '.'); ?></h2>
            <div class="stat-card-trend">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <span>Data tervalidasi dapur</span>
            </div>
        </div>

        <!-- Card 2: Pesanan Sukses -->
        <div class="stat-card red" data-aos="zoom-in" data-aos-delay="150">
            <div class="stat-card-header">
                <h4>Total Transaksi Sukses</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-receipt"></i></div>
            </div>
            <h2><?php echo number_format($total_trx, 0, ',', '.'); ?> <small style="font-size: 0.95rem; font-weight: 600; color: var(--admin-text-muted);">Pesanan</small></h2>
            <div class="stat-card-trend" style="color: var(--admin-red);">
                <i class="fa-solid fa-fire"></i>
                <span>Penjualan aktif</span>
            </div>
        </div>

        <!-- Card 3: Cerita & Konten -->
        <div class="stat-card gold" data-aos="zoom-in" data-aos-delay="200">
            <div class="stat-card-header">
                <h4>Cerita & Berita Tayang</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-newspaper"></i></div>
            </div>
            <h2><?php echo $active_stories_count; ?> / <?php echo count($stories); ?> <small style="font-size: 0.95rem; font-weight: 600; color: var(--admin-text-muted);">Tayang</small></h2>
            <div class="stat-card-trend" style="color: var(--admin-gold);">
                <i class="fa-solid fa-check-double"></i>
                <span>Langsung sinkron di Web</span>
            </div>
        </div>

        <!-- Card 4: Status Jam Buka -->
        <div class="stat-card purple" data-aos="zoom-in" data-aos-delay="250">
            <div class="stat-card-header">
                <h4>Jam Operasional Resto</h4>
                <div class="stat-card-icon"><i class="fa-regular fa-clock"></i></div>
            </div>
            <h2 style="font-size: 1.35rem; margin-top: 6px;"><?php echo htmlspecialchars($settings['open_hours'] ?? '10:00 – 21:00 WIB'); ?></h2>
            <div class="stat-card-trend" style="color: #8b5cf6;">
                <i class="fa-solid fa-calendar-check"></i>
                <span><?php echo htmlspecialchars($settings['open_days'] ?? 'Setiap Hari'); ?></span>
            </div>
        </div>
    </div>

    <!-- FILTER TANGGAL OMSET -->
    <div class="admin-card" data-aos="fade-up" data-aos-delay="300" style="padding: 20px 24px;">
        <form method="GET" style="display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 180px;">
                <label style="display: block; font-weight: 700; font-size: 0.82rem; margin-bottom: 6px; color: var(--admin-text-muted);">
                    <i class="fa-regular fa-calendar me-1"></i> Dari Tanggal
                </label>
                <input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>" class="admin-input">
            </div>
            <div style="flex: 1; min-width: 180px;">
                <label style="display: block; font-weight: 700; font-size: 0.82rem; margin-bottom: 6px; color: var(--admin-text-muted);">
                    <i class="fa-regular fa-calendar me-1"></i> Sampai Tanggal
                </label>
                <input type="date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" class="admin-input">
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="admin-btn admin-btn-primary">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
                <a href="index.php" class="admin-btn admin-btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <!-- CHARTS GRID -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 24px; margin-bottom: 34px;">
        <!-- Chart 1: Omset Harian -->
        <div class="admin-card" data-aos="fade-up" data-aos-delay="350" style="margin-bottom: 0;">
            <div class="admin-card-header">
                <h3><i class="fa-solid fa-chart-line"></i> Grafik Pendapatan Harian</h3>
                <small style="color: var(--admin-text-muted);">Rentang: <?php echo date('d M', strtotime($start_date)) . ' - ' . date('d M Y', strtotime($end_date)); ?></small>
            </div>
            <div style="position: relative; height: 260px;">
                <canvas id="omsetChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Menu Terlaris -->
        <div class="admin-card" data-aos="fade-up" data-aos-delay="400" style="margin-bottom: 0;">
            <div class="admin-card-header">
                <h3><i class="fa-solid fa-trophy"></i> Menu Paling Diminati</h3>
                <small style="color: var(--admin-text-muted);">5 Teratas</small>
            </div>
            <div style="position: relative; height: 260px; display: flex; justify-content: center; align-items: center;">
                <canvas id="menuChart"></canvas>
            </div>
        </div>
    </div>

    <!-- QUICK SECTION MANAGER: Cerita & Berita Resto -->
    <div class="admin-card" data-aos="fade-up" data-aos-delay="450">
        <div class="admin-card-header">
            <div>
                <h3><i class="fa-solid fa-newspaper"></i> Kontrol Cepat: Cerita Kami & Berita Dapur</h3>
                <p>Kelola artikel, liputan foto, dan pesan yang tampil langsung di website Numanke.</p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="manage_stories.php" class="admin-btn admin-btn-gold">
                    <i class="fa-solid fa-list-check"></i> Kelola Semua Cerita
                </a>
                <a href="manage_settings.php" class="admin-btn admin-btn-secondary">
                    <i class="fa-solid fa-sliders"></i> Pengaturan Web
                </a>
            </div>
        </div>

        <div class="story-admin-grid">
            <?php 
            $recent_stories = array_slice($stories, 0, 3);
            foreach ($recent_stories as $st): 
            ?>
                <div class="story-admin-card" style="border-radius: 18px; overflow: hidden; background: #fff; border: 1px solid var(--admin-border); box-shadow: var(--shadow-card);">
                    <img src="../<?php echo htmlspecialchars($st['image']); ?>" alt="<?php echo htmlspecialchars($st['title']); ?>" class="story-admin-card-img" style="width: 100%; height: 180px; max-height: 180px; object-fit: cover; display: block;" onerror="this.src='../assets/images/bg-headingweb.png'">
                    <div class="story-admin-card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span class="story-admin-badge"><?php echo htmlspecialchars($st['badge'] ?? 'Cerita'); ?></span>
                            <span style="font-size: 0.75rem; font-weight: 700; color: <?php echo ($st['status'] ?? 'aktif') === 'aktif' ? '#10b981' : '#f59f00'; ?>;">
                                ● <?php echo strtoupper($st['status'] ?? 'aktif'); ?>
                            </span>
                        </div>
                        <h4 class="story-admin-card-title"><?php echo htmlspecialchars($st['title']); ?></h4>
                        <p class="story-admin-card-excerpt">
                            <?php echo htmlspecialchars($st['summary'] ?? substr($st['content'], 0, 110) . '...'); ?>
                        </p>
                        <div class="story-admin-card-footer">
                            <span><i class="fa-regular fa-calendar me-1"></i> <?php echo htmlspecialchars($st['date'] ?? '-'); ?></span>
                            <a href="manage_stories.php" class="admin-btn admin-btn-gold" style="padding: 6px 12px; font-size: 0.8rem;">
                                Edit Cerita
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<!-- SCRIPT CHARTS & ANIMASI -->
<script>
    const labelOmset = <?php echo json_encode($label_omset); ?>;
    const dataOmset = <?php echo json_encode($data_omset); ?>;
    const labelMenu = <?php echo json_encode($label_menu); ?>;
    const dataMenu = <?php echo json_encode($data_menu); ?>;

    // Omset Line Chart
    new Chart(document.getElementById('omsetChart'), {
        type: 'line',
        data: {
            labels: labelOmset,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: dataOmset,
                borderColor: '#c92a2a',
                backgroundColor: 'rgba(201, 42, 42, 0.12)',
                borderWidth: 3,
                tension: 0.35,
                fill: true,
                pointBackgroundColor: '#f59f00',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(226, 232, 240, 0.6)' },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Top Menu Doughnut Chart
    new Chart(document.getElementById('menuChart'), {
        type: 'doughnut',
        data: {
            labels: labelMenu,
            datasets: [{
                data: dataMenu,
                backgroundColor: ['#c92a2a', '#f59f00', '#10b981', '#3b82f6', '#8b5cf6'],
                borderWidth: 3,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: { size: 11, family: 'Plus Jakarta Sans' }
                    }
                }
            },
            cutout: '68%'
        }
    });
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true });
</script>
</body>
</html>
