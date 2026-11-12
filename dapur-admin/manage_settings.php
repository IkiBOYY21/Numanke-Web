<?php
// dapur-admin/manage_settings.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: masuk.php");
    exit();
}

require_once '../includes/content_manager.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    $marquee_raw = trim($_POST['marquee_items'] ?? '');
    $marquee_arr = array_filter(array_map('trim', explode("\n", $marquee_raw)));

    $new_settings = [
        'announcement_bar' => trim($_POST['announcement_bar'] ?? ''),
        'hero_pill' => trim($_POST['hero_pill'] ?? ''),
        'hero_title_line1' => trim($_POST['hero_title_line1'] ?? ''),
        'hero_title_highlight' => trim($_POST['hero_title_highlight'] ?? ''),
        'hero_title_line2' => trim($_POST['hero_title_line2'] ?? ''),
        'hero_subtitle' => trim($_POST['hero_subtitle'] ?? ''),
        'hero_stat_1_val' => trim($_POST['hero_stat_1_val'] ?? ''),
        'hero_stat_1_lbl' => trim($_POST['hero_stat_1_lbl'] ?? ''),
        'hero_stat_2_val' => trim($_POST['hero_stat_2_val'] ?? ''),
        'hero_stat_2_lbl' => trim($_POST['hero_stat_2_lbl'] ?? ''),
        'hero_stat_3_val' => trim($_POST['hero_stat_3_val'] ?? ''),
        'hero_stat_3_lbl' => trim($_POST['hero_stat_3_lbl'] ?? ''),
        'wa_order' => trim($_POST['wa_order'] ?? ''),
        'wa_order_display' => trim($_POST['wa_order_display'] ?? ''),
        'wa_partner' => trim($_POST['wa_partner'] ?? ''),
        'wa_partner_display' => trim($_POST['wa_partner_display'] ?? ''),
        'address_short' => trim($_POST['address_short'] ?? ''),
        'address_full' => trim($_POST['address_full'] ?? ''),
        'open_hours' => trim($_POST['open_hours'] ?? ''),
        'open_days' => trim($_POST['open_days'] ?? ''),
        'marquee_items' => !empty($marquee_arr) ? array_values($marquee_arr) : [
            "Ayam Brongot Original", "Sambal Ulek Dadakan", "Nasi Ayam Geprek Keju", 
            "Marinasi 12 Jam Meresap", "Rongot Freeze Coklat", "Es Teh Kampul Segar", "Bakar Arang Tradisional"
        ]
    ];

    update_site_settings($new_settings);
    $message = "Semua pengaturan website berhasil disimpan dan langsung aktif!";
}

$settings = get_site_settings();
$marquee_text = implode("\n", $settings['marquee_items'] ?? []);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Website - Dapur Admin Numanke</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
        <a href="index.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
        <a href="manage_stories.php"><i class="fa-solid fa-newspaper"></i> Cerita & Berita</a>
        <a href="manage_settings.php" class="active"><i class="fa-solid fa-sliders"></i> Pengaturan Web</a>
        
        <span class="nav-category">Pesanan & Menu</span>
        <a href="manage_orders.php"><i class="fa-solid fa-cart-shopping"></i> Kelola Pesanan</a>
        <a href="manage_menu.php"><i class="fa-solid fa-bowl-food"></i> Kelola Menu</a>
    </div>

    <div class="sidebar-bottom">
        <a href="../index.php" target="_blank" class="btn-view-site">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website
        </a>
        <a href="keluar.php" class="logout-link">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
        </a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    
    <div class="admin-header-flex" data-aos="fade-down">
        <div class="admin-header-title">
            <h1>Pengaturan Seluruh Website</h1>
            <p>Ubah teks banner, headline hero, kontak WhatsApp, jam buka, dan teks berjalan secara langsung.</p>
        </div>
        <div class="admin-header-actions">
            <button type="submit" form="formSettings" class="admin-btn admin-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
            </button>
        </div>
    </div>

    <form method="POST" id="formSettings">
        <input type="hidden" name="save_settings" value="1">

        <!-- 1. PENGUMUMAN ATAS & PITA BERJALAN -->
        <div class="admin-card" data-aos="fade-up" data-aos-delay="100">
            <div class="admin-card-header">
                <h3><i class="fa-solid fa-bullhorn"></i> Banner Pengumuman & Teks Berjalan (Marquee)</h3>
                <p>Atur pesan promosi di strip paling atas dan teks berjalan di bawah hero.</p>
            </div>

            <div class="admin-form-group">
                <label>Top Announcement Bar (Strip Hitam di Atas Navbar)</label>
                <input type="text" name="announcement_bar" class="admin-input" value="<?php echo htmlspecialchars($settings['announcement_bar'] ?? ''); ?>">
            </div>

            <div class="admin-form-group">
                <label>Pita Teks Berjalan (Satu item per baris)</label>
                <textarea name="marquee_items" class="admin-textarea" rows="4"><?php echo htmlspecialchars($marquee_text); ?></textarea>
                <small style="color:var(--admin-text-muted);">Setiap baris akan dipisahkan dengan tanda bintang emas (✦) secara otomatis di website.</small>
            </div>
        </div>

        <!-- 2. HERO HEADING SECTION -->
        <div class="admin-card" data-aos="fade-up" data-aos-delay="150">
            <div class="admin-card-header">
                <h3><i class="fa-solid fa-fire"></i> Konten Heading Utama (Hero Section)</h3>
                <p>Ubah judul besar, teks sorot, dan subjudul pembuka di halaman depan.</p>
            </div>

            <div class="form-grid-3">
                <div class="admin-form-group">
                    <label>Badge Pill Kecil</label>
                    <input type="text" name="hero_pill" class="admin-input" value="<?php echo htmlspecialchars($settings['hero_pill'] ?? ''); ?>">
                </div>
                <div class="admin-form-group">
                    <label>Judul Baris 1</label>
                    <input type="text" name="hero_title_line1" class="admin-input" value="<?php echo htmlspecialchars($settings['hero_title_line1'] ?? ''); ?>">
                </div>
                <div class="admin-form-group">
                    <label>Teks Sorot Merah</label>
                    <input type="text" name="hero_title_highlight" class="admin-input" value="<?php echo htmlspecialchars($settings['hero_title_highlight'] ?? ''); ?>" style="border-color: var(--admin-red);">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="admin-form-group">
                    <label>Judul Baris 2</label>
                    <input type="text" name="hero_title_line2" class="admin-input" value="<?php echo htmlspecialchars($settings['hero_title_line2'] ?? ''); ?>">
                </div>
                <div class="admin-form-group">
                    <label>Paragraf Deskripsi Hero</label>
                    <textarea name="hero_subtitle" class="admin-textarea" rows="3"><?php echo htmlspecialchars($settings['hero_subtitle'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- Hero Highlights 3 Cards -->
            <label style="font-weight:700; font-size:0.9rem; color:var(--admin-dark); margin-bottom:12px; display:block;">3 Kartu Statistik Hero</label>
            <div class="form-grid-3">
                <div style="background:#f8fafc; padding:16px; border-radius:14px; border:1px solid var(--admin-border);">
                    <small style="font-weight:700; color:var(--admin-red);">Kartu 1 (Marinasi)</small>
                    <input type="text" name="hero_stat_1_val" class="admin-input mt-2 mb-2" value="<?php echo htmlspecialchars($settings['hero_stat_1_val'] ?? '12 Jam'); ?>" placeholder="12 Jam">
                    <input type="text" name="hero_stat_1_lbl" class="admin-input" value="<?php echo htmlspecialchars($settings['hero_stat_1_lbl'] ?? 'Marinasi Rempah'); ?>" placeholder="Marinasi Rempah">
                </div>

                <div style="background:#f8fafc; padding:16px; border-radius:14px; border:1px solid var(--admin-border);">
                    <small style="font-weight:700; color:var(--admin-red);">Kartu 2 (Arang)</small>
                    <input type="text" name="hero_stat_2_val" class="admin-input mt-2 mb-2" value="<?php echo htmlspecialchars($settings['hero_stat_2_val'] ?? '100% Arang'); ?>" placeholder="100% Arang">
                    <input type="text" name="hero_stat_2_lbl" class="admin-input" value="<?php echo htmlspecialchars($settings['hero_stat_2_lbl'] ?? 'Batok Kelapa'); ?>" placeholder="Batok Kelapa">
                </div>

                <div style="background:#f8fafc; padding:16px; border-radius:14px; border:1px solid var(--admin-border);">
                    <small style="font-weight:700; color:var(--admin-gold);">Kartu 3 (Rating Ulasan)</small>
                    <input type="text" name="hero_stat_3_val" class="admin-input mt-2 mb-2" value="<?php echo htmlspecialchars($settings['hero_stat_3_val'] ?? '4.9 / 5.0'); ?>" placeholder="4.9 / 5.0">
                    <input type="text" name="hero_stat_3_lbl" class="admin-input" value="<?php echo htmlspecialchars($settings['hero_stat_3_lbl'] ?? '1.500+ Ulasan'); ?>" placeholder="1.500+ Ulasan">
                </div>
            </div>
        </div>

        <!-- 3. KONTAK & JAM OPERASIONAL -->
        <div class="admin-card" data-aos="fade-up" data-aos-delay="200">
            <div class="admin-card-header">
                <h3><i class="fa-solid fa-phone"></i> Kontak WhatsApp & Jam Operasional Resto</h3>
                <p>Nomor tujuan pemesanan WhatsApp, jam buka, dan alamat restoran.</p>
            </div>

            <div class="form-grid-2">
                <div class="admin-form-group">
                    <label>No. WA Pemesanan & Antar (Format Internasional: 628...)</label>
                    <input type="text" name="wa_order" class="admin-input" value="<?php echo htmlspecialchars($settings['wa_order'] ?? '62882006236802'); ?>">
                </div>
                <div class="admin-form-group">
                    <label>Teks Tampilan No. WA Pemesanan</label>
                    <input type="text" name="wa_order_display" class="admin-input" value="<?php echo htmlspecialchars($settings['wa_order_display'] ?? '+62 882-0062-36802'); ?>">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="admin-form-group">
                    <label>No. WA Kemitraan & Manajemen (Format: 628...)</label>
                    <input type="text" name="wa_partner" class="admin-input" value="<?php echo htmlspecialchars($settings['wa_partner'] ?? '6288802732001'); ?>">
                </div>
                <div class="admin-form-group">
                    <label>Teks Tampilan No. WA Kemitraan</label>
                    <input type="text" name="wa_partner_display" class="admin-input" value="<?php echo htmlspecialchars($settings['wa_partner_display'] ?? '+62 888-0273-2001'); ?>">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="admin-form-group">
                    <label>Jam Buka Operasional</label>
                    <input type="text" name="open_hours" class="admin-input" value="<?php echo htmlspecialchars($settings['open_hours'] ?? '10:00 – 21:00 WIB'); ?>">
                </div>
                <div class="admin-form-group">
                    <label>Hari Buka</label>
                    <input type="text" name="open_days" class="admin-input" value="<?php echo htmlspecialchars($settings['open_days'] ?? 'Senin – Minggu (Setiap Hari Tanpa Libur)'); ?>">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Alamat Lengkap Restoran</label>
                <input type="text" name="address_full" class="admin-input" value="<?php echo htmlspecialchars($settings['address_full'] ?? 'Jl. Pete Sel. No.18, Sekaran, Kec. Gunungpati, Kota Semarang, Jawa Tengah 50229'); ?>">
            </div>

            <div class="d-flex justify-content-end" style="display:flex; justify-content:flex-end; margin-top:20px;">
                <button type="submit" name="save_settings" class="admin-btn admin-btn-primary" style="padding:14px 32px; font-size:1rem;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan Website
                </button>
            </div>
        </div>
    </form>

</div>

<!-- TOAST ALERT -->
<?php if (!empty($message)): ?>
<div class="toast-notice" id="adminToast">
    <i class="fa-solid fa-circle-check" style="color:#10b981; font-size:1.3rem;"></i>
    <div>
        <div style="font-weight:700; font-size:0.9rem; color:var(--admin-dark);">Berhasil!</div>
        <div style="color:var(--admin-text-muted); font-size:0.8rem;"><?php echo htmlspecialchars($message); ?></div>
    </div>
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('adminToast');
        if (toast) toast.style.display = 'none';
    }, 4000);
</script>
<?php endif; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true });
</script>
</body>
</html>
