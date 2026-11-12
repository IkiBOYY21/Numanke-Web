<?php
// dapur-admin/manage_stories.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: masuk.php");
    exit();
}

require_once '../includes/content_manager.php';

$message = '';
$message_type = 'success';

// Handle Form Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'save_story') {
        $id = trim($_POST['id'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $category = trim($_POST['category'] ?? 'Cerita Dapur');
        $badge = trim($_POST['badge'] ?? 'Spesial');
        $date = trim($_POST['date'] ?? date('d F Y'));
        $summary = trim($_POST['summary'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $order = (int)($_POST['order'] ?? 1);
        $status = $_POST['status'] ?? 'aktif';
        $image = trim($_POST['existing_image'] ?? 'assets/images/filosofi1.JPG');

        // Handle Image Upload if provided
        if (isset($_FILES['story_image']) && $_FILES['story_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['story_image']['tmp_name'];
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['story_image']['name']);
            $targetDir = __DIR__ . '/../assets/images/';
            $targetPath = $targetDir . $fileName;

            if (move_uploaded_file($fileTmp, $targetPath)) {
                $image = 'assets/images/' . $fileName;
            }
        } elseif (!empty($_POST['image_url'])) {
            $image = trim($_POST['image_url']);
        }

        if (!empty($title)) {
            $story_data = [
                'id' => $id,
                'title' => $title,
                'subtitle' => $subtitle,
                'category' => $category,
                'badge' => $badge,
                'date' => $date,
                'image' => $image,
                'summary' => $summary,
                'content' => $content,
                'order' => $order,
                'status' => $status
            ];

            save_story($story_data);
            $message = !empty($id) ? "Cerita / Berita berhasil diperbarui!" : "Cerita / Berita baru berhasil ditambahkan!";
        } else {
            $message = "Judul cerita tidak boleh kosong!";
            $message_type = 'error';
        }
    } elseif ($action === 'delete_story') {
        $id = $_POST['id'] ?? '';
        if (!empty($id)) {
            delete_story($id);
            $message = "Cerita berhasil dihapus!";
        }
    } elseif ($action === 'toggle_status') {
        $id = $_POST['id'] ?? '';
        $story = get_story_by_id($id);
        if ($story) {
            $story['status'] = ($story['status'] === 'aktif') ? 'draft' : 'aktif';
            save_story($story);
            $message = "Status cerita berhasil diubah menjadi: " . strtoupper($story['status']);
        }
    }
}

// Get all stories (both active and draft)
$all_stories = get_site_stories(false);
$total_stories = count($all_stories);
$active_stories = count(array_filter($all_stories, fn($s) => ($s['status'] ?? 'aktif') === 'aktif'));
$draft_stories = $total_stories - $active_stories;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Cerita & Berita - Dapur Admin Numanke</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(8px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
        }
        .modal-overlay.active { display: flex; }
        .modal-box {
            background: #ffffff;
            border-radius: 24px;
            max-width: 680px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 32px;
            box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3);
            animation: modalPop 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes modalPop {
            from { transform: scale(0.92) translateY(20px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }
    </style>
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
        <a href="manage_stories.php" class="active"><i class="fa-solid fa-newspaper"></i> Cerita & Berita <span class="nav-badge"><?php echo $total_stories; ?></span></a>
        <a href="manage_settings.php"><i class="fa-solid fa-sliders"></i> Pengaturan Web</a>
        
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
    
    <!-- HEADER -->
    <div class="admin-header-flex" data-aos="fade-down">
        <div class="admin-header-title">
            <h1>Kelola Cerita & Berita Resto</h1>
            <p>Tambah, edit, dan kelola artikel, berita, dan section dinamis "Cerita Kami" di website Numanke.</p>
        </div>
        <div class="admin-header-actions">
            <button type="button" class="admin-btn admin-btn-primary" onclick="openStoryModal()">
                <i class="fa-solid fa-plus"></i> Tambah Cerita Baru
            </button>
        </div>
    </div>

    <!-- STATS SUMMARY -->
    <div class="stat-card-container">
        <div class="stat-card red" data-aos="zoom-in" data-aos-delay="100">
            <div class="stat-card-header">
                <h4>Total Cerita & Berita</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-newspaper"></i></div>
            </div>
            <h2><?php echo $total_stories; ?> <small style="font-size: 0.9rem; font-weight: 600; color: var(--admin-text-muted);">Artikel</small></h2>
        </div>

        <div class="stat-card green" data-aos="zoom-in" data-aos-delay="150">
            <div class="stat-card-header">
                <h4>Status Aktif (Tayang)</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-circle-check"></i></div>
            </div>
            <h2><?php echo $active_stories; ?> <small style="font-size: 0.9rem; font-weight: 600; color: var(--admin-text-muted);">Tayang di Web</small></h2>
        </div>

        <div class="stat-card gold" data-aos="zoom-in" data-aos-delay="200">
            <div class="stat-card-header">
                <h4>Status Draft</h4>
                <div class="stat-card-icon"><i class="fa-solid fa-file-pen"></i></div>
            </div>
            <h2><?php echo $draft_stories; ?> <small style="font-size: 0.9rem; font-weight: 600; color: var(--admin-text-muted);">Disimpan</small></h2>
        </div>
    </div>

    <!-- STORIES GRID -->
    <div class="admin-card" data-aos="fade-up" data-aos-delay="250">
        <div class="admin-card-header">
            <div>
                <h3><i class="fa-solid fa-book-open"></i> Daftar Section Cerita & Berita Terdaftar</h3>
                <p>Setiap cerita aktif langsung tampil di halaman <strong>Cerita Kami (about.php)</strong> dan beranda website.</p>
            </div>
            <button type="button" class="admin-btn admin-btn-gold" onclick="openStoryModal()">
                <i class="fa-solid fa-circle-plus"></i> Tambah Baru
            </button>
        </div>

        <?php if (empty($all_stories)): ?>
            <div class="text-center py-5" style="text-align: center; padding: 50px 20px;">
                <i class="fa-solid fa-newspaper text-muted" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 15px;"></i>
                <h4 style="color: var(--admin-dark); margin-bottom: 8px;">Belum Ada Cerita</h4>
                <p style="color: var(--admin-text-muted); margin-bottom: 20px;">Klik tombol di bawah untuk membuat artikel cerita/berita pertama Anda.</p>
                <button type="button" class="admin-btn admin-btn-primary" onclick="openStoryModal()">
                    + Buat Cerita Sekarang
                </button>
            </div>
        <?php else: ?>
            <div class="story-admin-grid">
                <?php foreach ($all_stories as $st): ?>
                    <div class="story-admin-card" data-aos="fade-up" style="border-radius:18px; overflow:hidden; background:#fff; border:1px solid var(--admin-border); box-shadow:var(--shadow-card);">
                        <img src="../<?php echo htmlspecialchars($st['image']); ?>" alt="<?php echo htmlspecialchars($st['title']); ?>" class="story-admin-card-img" style="width:100%; height:190px; max-height:190px; object-fit:cover; display:block;" onerror="this.src='../assets/images/bg-headingweb.png'">
                        <div class="story-admin-card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                <span class="story-admin-badge"><?php echo htmlspecialchars($st['badge'] ?? 'Cerita'); ?></span>
                                <span style="font-size: 0.75rem; font-weight: 700; color: <?php echo ($st['status'] ?? 'aktif') === 'aktif' ? '#10b981' : '#f59f00'; ?>;">
                                    ● <?php echo strtoupper($st['status'] ?? 'aktif'); ?>
                                </span>
                            </div>
                            <h4 class="story-admin-card-title"><?php echo htmlspecialchars($st['title']); ?></h4>
                            <p class="story-admin-card-excerpt">
                                <?php echo htmlspecialchars($st['summary'] ?? substr($st['content'], 0, 120) . '...'); ?>
                            </p>
                            <div class="story-admin-card-footer">
                                <span><i class="fa-regular fa-calendar me-1"></i> <?php echo htmlspecialchars($st['date'] ?? '-'); ?></span>
                                <div class="story-actions-group">
                                    <!-- Toggle Status Button -->
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="toggle_status">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($st['id']); ?>">
                                        <button type="submit" class="admin-btn admin-btn-secondary" style="padding: 6px 10px; font-size: 0.8rem;" title="Ubah Aktif/Draft">
                                            <i class="fa-solid fa-power-off"></i>
                                        </button>
                                    </form>

                                    <!-- Edit Button -->
                                    <button type="button" class="admin-btn admin-btn-gold" style="padding: 6px 12px; font-size: 0.8rem;" onclick='editStory(<?php echo json_encode($st, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>)'>
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cerita ini?');" style="display: inline;">
                                        <input type="hidden" name="action" value="delete_story">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($st['id']); ?>">
                                        <button type="submit" class="admin-btn admin-btn-danger" style="padding: 6px 10px; font-size: 0.8rem;" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

</div>

<!-- MODAL FORM TAMBAH / EDIT CERITA -->
<div class="modal-overlay" id="storyModal">
    <div class="modal-box">
        <div class="d-flex justify-content-between align-items-center mb-3" style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #f1f5f9; padding-bottom:15px; margin-bottom:20px;">
            <h3 style="font-family:'Playfair Display', serif; font-size:1.4rem; color:var(--admin-dark); margin:0;" id="modalTitle">
                Tambah Cerita / Berita Baru
            </h3>
            <button type="button" onclick="closeStoryModal()" style="background:none; border:none; font-size:1.5rem; cursor:pointer; color:#94a3b8;">&times;</button>
        </div>

        <form method="POST" enctype="multipart/form-data" id="storyForm">
            <input type="hidden" name="action" value="save_story">
            <input type="hidden" name="id" id="storyId" value="">
            <input type="hidden" name="existing_image" id="storyExistingImage" value="">

            <div class="form-grid-2">
                <div class="admin-form-group">
                    <label>Judul Cerita / Berita <span class="req">*</span></label>
                    <input type="text" name="title" id="storyTitle" class="admin-input" placeholder="Contoh: Rahasia 12 Jam Marinasi" required>
                </div>

                <div class="admin-form-group">
                    <label>Subjudul / Tagline</label>
                    <input type="text" name="subtitle" id="storySubtitle" class="admin-input" placeholder="Contoh: Kisah dari Balik Dapur">
                </div>
            </div>

            <div class="form-grid-3">
                <div class="admin-form-group">
                    <label>Kategori</label>
                    <select name="category" id="storyCategory" class="admin-select">
                        <option value="Cerita Dapur">Cerita Dapur</option>
                        <option value="Tradisi Kuliner">Tradisi Kuliner</option>
                        <option value="Kebersamaan">Kebersamaan</option>
                        <option value="Berita Terbaru">Berita Terbaru</option>
                        <option value="Liputan Media">Liputan Media</option>
                        <option value="Promo & Event">Promo & Event</option>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label>Badge Teks</label>
                    <input type="text" name="badge" id="storyBadge" class="admin-input" placeholder="Contoh: Otentik 2024">
                </div>

                <div class="admin-form-group">
                    <label>Status Tayang</label>
                    <select name="status" id="storyStatus" class="admin-select">
                        <option value="aktif">Aktif (Tayang)</option>
                        <option value="draft">Draft (Simpan Saja)</option>
                    </select>
                </div>
            </div>

            <!-- Image Upload & Preview -->
            <div class="admin-form-group">
                <label>Foto / Gambar Cerita</label>
                <div class="form-grid-2">
                    <div>
                        <small style="color:var(--admin-text-muted); display:block; margin-bottom:6px;">Upload File dari Komputer/HP:</small>
                        <input type="file" name="story_image" id="storyFile" class="admin-input" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div>
                        <small style="color:var(--admin-text-muted); display:block; margin-bottom:6px;">Atau URL / Path Gambar:</small>
                        <input type="text" name="image_url" id="storyImageUrl" class="admin-input" placeholder="assets/images/filosofi1.JPG" oninput="previewUrl(this.value)">
                    </div>
                </div>
                <!-- Live Preview Image Box -->
                <div class="mt-3" style="margin-top: 12px;">
                    <img id="livePreviewImg" src="../assets/images/filosofi1.JPG" alt="Preview" style="max-height: 180px; width: 100%; object-fit: cover; border-radius: 14px; border: 1.5px solid var(--admin-border);">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Ringkasan Singkat (Muncul di kartu preview)</label>
                <textarea name="summary" id="storySummary" class="admin-textarea" style="min-height:70px;" placeholder="Tuliskan 1-2 kalimat ringkasan yang memikat pembaca..."></textarea>
            </div>

            <div class="admin-form-group">
                <label>Isi Lengkap Cerita / Berita <span class="req">*</span></label>
                <textarea name="content" id="storyContent" class="admin-textarea" style="min-height:140px;" placeholder="Tuliskan cerita lengkap, filosofi rasa, atau rincian berita secara mendalam..." required></textarea>
            </div>

            <div class="d-flex justify-content-end gap-3" style="display:flex; justify-content:flex-end; gap:12px; margin-top:24px;">
                <button type="button" class="admin-btn admin-btn-secondary" onclick="closeStoryModal()">Batal</button>
                <button type="submit" class="admin-btn admin-btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Cerita
                </button>
            </div>
        </form>
    </div>
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

<!-- SCRIPT AOS & MODAL -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true });

    function openStoryModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Cerita / Berita Baru';
        document.getElementById('storyForm').reset();
        document.getElementById('storyId').value = '';
        document.getElementById('storyExistingImage').value = 'assets/images/filosofi1.JPG';
        document.getElementById('livePreviewImg').src = '../assets/images/filosofi1.JPG';
        document.getElementById('storyModal').classList.add('active');
    }

    function closeStoryModal() {
        document.getElementById('storyModal').classList.remove('active');
    }

    function editStory(story) {
        document.getElementById('modalTitle').innerText = 'Edit Cerita: ' + story.title;
        document.getElementById('storyId').value = story.id || '';
        document.getElementById('storyTitle').value = story.title || '';
        document.getElementById('storySubtitle').value = story.subtitle || '';
        document.getElementById('storyCategory').value = story.category || 'Cerita Dapur';
        document.getElementById('storyBadge').value = story.badge || '';
        document.getElementById('storyStatus').value = story.status || 'aktif';
        document.getElementById('storySummary').value = story.summary || '';
        document.getElementById('storyContent').value = story.content || '';
        document.getElementById('storyExistingImage').value = story.image || 'assets/images/filosofi1.JPG';
        document.getElementById('storyImageUrl').value = story.image || '';
        
        let previewSrc = story.image ? '../' + story.image : '../assets/images/filosofi1.JPG';
        document.getElementById('livePreviewImg').src = previewSrc;

        document.getElementById('storyModal').classList.add('active');
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('livePreviewImg').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewUrl(url) {
        if (url) {
            document.getElementById('livePreviewImg').src = url.startsWith('http') ? url : '../' + url;
        }
    }
</script>
</body>
</html>
