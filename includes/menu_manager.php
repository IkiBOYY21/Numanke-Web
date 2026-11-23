<?php
// includes/menu_manager.php
// Central Menu Provider for Numanke Website & Admin Sync

require_once __DIR__ . '/db.php';

/**
 * Mendapatkan seluruh katalog menu dari database (dengan fallback aman jika DB offline)
 * Mengelompokkan varian [Single] dan [Double] menjadi satu produk interaktif
 */
function get_menu_catalog() {
    global $conn;

    $catalog = [];
    $use_db = false;

    if (isset($conn) && !$conn->connect_error) {
        $res = $conn->query("SELECT * FROM menu ORDER BY kategori ASC, id ASC");
        if ($res && $res->num_rows > 0) {
            $use_db = true;
            while ($row = $res->fetch_assoc()) {
                $kat = trim($row['kategori']) ?: 'Geprek Series';
                $rawName = trim($row['name']);
                
                // Cek varian [Single] atau [Double]
                $portionType = 'Normal';
                $baseName = $rawName;
                if (preg_match('/^(.*?)\s*\[(Single|Double)\]$/i', $rawName, $m)) {
                    $baseName = trim($m[1]);
                    $portionType = ucfirst(strtolower($m[2]));
                }

                if (!isset($catalog[$kat][$baseName])) {
                    // Tentukan ikon & kepedasan berdasarkan kategori / nama
                    $icon = 'fa-utensils';
                    $hasSpicy = true;
                    if (stripos($kat, 'brongot') !== false || stripos($baseName, 'brongot') !== false) {
                        $icon = 'fa-fire';
                    } elseif (stripos($kat, 'dewata') !== false || stripos($baseName, 'dewata') !== false) {
                        $icon = 'fa-leaf';
                    } elseif (stripos($kat, 'rongot') !== false || stripos($baseName, 'rongot') !== false) {
                        $icon = 'fa-ice-cream';
                        $hasSpicy = false;
                    } elseif (stripos($kat, 'frozen') !== false) {
                        $icon = 'fa-snowflake';
                        $hasSpicy = (stripos($baseName, 'sambal') !== false || stripos($baseName, 'brongot') !== false);
                    } elseif (stripos($kat, 'drink') !== false || stripos($baseName, 'teh') !== false || stripos($baseName, 'es ') !== false) {
                        $icon = 'fa-glass-water';
                        $hasSpicy = false;
                    }

                    // Tentukan gambar awal (utamakan upload admin jika ada)
                    $img = 'assets/images/bg-headingweb.png';
                    if (!empty($row['image_url']) && $row['image_url'] !== 'default.png') {
                        $img = 'assets/images/menu/' . $row['image_url'];
                    } elseif (stripos($baseName, 'brongot') !== false) {
                        $img = 'assets/images/fotoslide1.png';
                    } elseif (stripos($baseName, 'dewata') !== false) {
                        $img = 'assets/images/fotoslide2.JPG';
                    } elseif (stripos($baseName, 'teh') !== false || stripos($kat, 'drink') !== false) {
                        $img = 'assets/images/fotoslide3.JPG';
                    } elseif (stripos($baseName, 'geprek') !== false) {
                        $img = 'assets/images/menu/1794255715_NasiAyamGeprekKejuSingle.png';
                    }

                    // Deskripsi bawaan jika admin belum mengisi
                    $desc = trim($row['description'] ?? '');
                    if (empty($desc)) {
                        if (stripos($kat, 'geprek') !== false) {
                            $desc = 'Ayam crispy gurih berpadu dengan ulekan cabai rawit pedas mantap khas Numanke.';
                        } elseif (stripos($kat, 'brongot') !== false) {
                            $desc = 'Dimarinasi 12 jam, dibakar arang batok dengan bumbu manis pedas gurih karamel meresap.';
                        } elseif (stripos($kat, 'dewata') !== false) {
                            $desc = 'Khas rempah Bali wangi serai daun jeruk yang segar dan menggugah selera.';
                        } elseif (stripos($kat, 'rongot') !== false) {
                            $desc = 'Roti panggang aneka topping manis lumer, penyejuk nikmat sehabis santap pedas.';
                        } elseif (stripos($kat, 'frozen') !== false) {
                            $desc = 'Menu praktis siap masak di rumah kapan saja dengan rasa otentik Numanke.';
                        } elseif (stripos($kat, 'drink') !== false) {
                            $desc = 'Minuman segar pelepas dahaga sempurna pendamping sajian ayam.';
                        } else {
                            $desc = 'Hidangan lezat spesial disiapkan hangat saat pesanan diterima.';
                        }
                    }

                    $catalog[$kat][$baseName] = [
                        'id' => $row['id'],
                        'nama' => $baseName,
                        'kategori' => $kat,
                        'desc' => $desc,
                        'img' => $img,
                        'icon' => $icon,
                        'has_spicy' => $hasSpicy,
                        'has_portions' => false,
                        'prices' => []
                    ];
                }

                // Jika varian ini memiliki foto kustom yang diupload admin, gunakan untuk produk utama
                if (!empty($row['image_url']) && $row['image_url'] !== 'default.png') {
                    $catalog[$kat][$baseName]['img'] = 'assets/images/menu/' . $row['image_url'];
                }

                // Jika deskripsi diisi pada varian ini, perbarui
                if (!empty(trim($row['description'] ?? ''))) {
                    $catalog[$kat][$baseName]['desc'] = trim($row['description']);
                }

                $catalog[$kat][$baseName]['prices'][$portionType] = (int)$row['price'];
            }
        }
    }

    // Fallback data statis jika database belum terhubung
    if (!$use_db) {
        $catalog = get_default_static_catalog();
    }

    // Format porsi single / double untuk setiap item
    foreach ($catalog as $kat => &$items) {
        foreach ($items as $name => &$item) {
            if (isset($item['prices']['Single']) && isset($item['prices']['Double'])) {
                $item['has_portions'] = true;
                $item['single'] = 'Rp. ' . number_format($item['prices']['Single'], 0, ',', '.');
                $item['double'] = 'Rp. ' . number_format($item['prices']['Double'], 0, ',', '.');
                $item['single_price'] = $item['prices']['Single'];
                $item['double_price'] = $item['prices']['Double'];
                if (stripos($kat, 'frozen') !== false && stripos($name, 'sambal') === false) {
                    if (stripos($name, 'bakso') !== false) {
                        $item['single_label'] = '15 Pcs';
                        $item['double_label'] = '25 Pcs';
                    } else {
                        $item['single_label'] = '1/4 Kg';
                        $item['double_label'] = '1/2 Kg';
                    }
                } else {
                    $item['single_label'] = 'Single';
                    $item['double_label'] = 'Double';
                }
            } else {
                $item['has_portions'] = false;
                $firstPrice = !empty($item['prices']) ? reset($item['prices']) : ($item['price'] ?? 10000);
                $item['harga'] = 'Rp. ' . number_format($firstPrice, 0, ',', '.');
                $item['price'] = $firstPrice;
            }
        }
    }

    // Urutkan kategori sesuai urutan baku restoran
    $kat_priority = [
        'Geprek Series' => 1,
        'Brongot Series' => 2,
        'Dewata Series' => 3,
        'Rongot Series' => 4,
        'Frozen Series' => 5,
        'Drink' => 6,
    ];

    uksort($catalog, function($a, $b) use ($kat_priority) {
        $pA = $kat_priority[$a] ?? 99;
        $pB = $kat_priority[$b] ?? 99;
        if ($pA === $pB) return strcmp($a, $b);
        return $pA <=> $pB;
    });

    return $catalog;
}

/**
 * Data menu bawaan lengkap sebagai fallback aman jika database offline
 */
function get_default_static_catalog() {
    $static = [
        'Geprek Series' => [
            'Nasi Ayam Geprek Ori' => ['prices' => ['Single' => 13000, 'Double' => 18000], 'icon' => 'fa-utensils', 'img' => 'assets/images/menu/1794255715_NasiAyamGeprekKejuSingle.png', 'desc' => 'Ayam crispy gurih berpadu dengan ulekan cabai rawit pedas mantap khas Numanke.', 'has_spicy' => true],
            'Nasi Ayam Geprek Keju' => ['prices' => ['Single' => 15000, 'Double' => 20000], 'icon' => 'fa-utensils', 'img' => 'assets/images/menu/1794255367_NasiAyamGeprekKejuDouble.png', 'desc' => 'Ayam krispi gurih dengan taburan parutan keju cheddar melimpah di atas cabai rawit.', 'has_spicy' => true],
            'Nasi Ayam Geprek Moza' => ['prices' => ['Single' => 17000, 'Double' => 22000], 'icon' => 'fa-utensils', 'img' => 'assets/images/menu/1794255715_NasiAyamGeprekKejuSingle.png', 'desc' => 'Keju mozzarella premium yang dibakar lumer mulur di atas ayam geprek pedas.', 'has_spicy' => true],
            'Nasi Jamur Geprek Ori' => ['prices' => ['Single' => 10000, 'Double' => 14000], 'icon' => 'fa-utensils', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Jamur tiram krispi renyah digeprek dengan sambal bawang segar.', 'has_spicy' => true],
            'Nasi Jamur Geprek Keju' => ['prices' => ['Single' => 12000, 'Double' => 16000], 'icon' => 'fa-utensils', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Jamur krispi renyah dengan taburan keju gurih melimpah.', 'has_spicy' => true],
            'Nasi Jamur Geprek Moza' => ['prices' => ['Single' => 14000, 'Double' => 18000], 'icon' => 'fa-utensils', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Jamur krispi bertabur lelehan keju mozzarella lembut.', 'has_spicy' => true],
            'Nasi Telur Geprek Ori' => ['prices' => ['Single' => 11000, 'Double' => 16000], 'icon' => 'fa-utensils', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Telur dadar tebal krispi digeprek pedas gurih mantap.', 'has_spicy' => true],
            'Nasi Telur Geprek Keju' => ['prices' => ['Single' => 13000, 'Double' => 18000], 'icon' => 'fa-utensils', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Telur dadar krispi pedas dengan keju cheddar gurih.', 'has_spicy' => true],
            'Nasi Telur Geprek Moza' => ['prices' => ['Single' => 15000, 'Double' => 20000], 'icon' => 'fa-utensils', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Telur dadar krispi berpadu keju mozzarella panggang mulur.', 'has_spicy' => true],
            'Nasi Ayam+Jamur Geprek Ori' => ['prices' => ['Single' => 13000, 'Double' => 18000], 'icon' => 'fa-utensils', 'img' => 'assets/images/menu/1794255715_NasiAyamGeprekKejuSingle.png', 'desc' => 'Kombinasi komplit ayam dan jamur krispi dalam satu piring.', 'has_spicy' => true],
            'Nasi Ayam+Jamur Geprek Keju' => ['prices' => ['Single' => 15000, 'Double' => 20000], 'icon' => 'fa-utensils', 'img' => 'assets/images/menu/1794255367_NasiAyamGeprekKejuDouble.png', 'desc' => 'Paket komplit ayam dan jamur krispi bertabur keju parut.', 'has_spicy' => true],
            'Nasi Ayam+Jamur Geprek Moza' => ['prices' => ['Single' => 17000, 'Double' => 22000], 'icon' => 'fa-utensils', 'img' => 'assets/images/menu/1794255715_NasiAyamGeprekKejuSingle.png', 'desc' => 'Paket komplit ayam dan jamur krispi dengan selimut mozzarella lumer.', 'has_spicy' => true],
        ],
        'Dewata Series' => [
            'Nasi Ayam Geprek Dewata Ori' => ['prices' => ['Single' => 15000, 'Double' => 19000], 'icon' => 'fa-leaf', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Ayam krispi dengan racikan bumbu khas Dewata rempah serai wangi.', 'has_spicy' => true],
            'Nasi Ayam Geprek Dewata Keju' => ['prices' => ['Single' => 17000, 'Double' => 21000], 'icon' => 'fa-leaf', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Ayam krispi bumbu Dewata Bali bertabur keju gurih melimpah.', 'has_spicy' => true],
            'Nasi Ayam Geprek Dewata Moza' => ['prices' => ['Single' => 19000, 'Double' => 23000], 'icon' => 'fa-leaf', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Ayam krispi rempah Dewata berbalut keju mozzarella lumer.', 'has_spicy' => true],
            'Nasi Jamur Geprek Dewata Ori' => ['prices' => ['Single' => 12000, 'Double' => 16000], 'icon' => 'fa-leaf', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Jamur krispi renyah berpadu sambal rempah Dewata wangi.', 'has_spicy' => true],
            'Nasi Jamur Geprek Dewata Keju' => ['prices' => ['Single' => 14000, 'Double' => 18000], 'icon' => 'fa-leaf', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Jamur krispi sambal Dewata dengan taburan keju cheddar.', 'has_spicy' => true],
            'Nasi Jamur Geprek Dewata Moza' => ['prices' => ['Single' => 16000, 'Double' => 20000], 'icon' => 'fa-leaf', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Jamur krispi sambal Dewata berselimut mozzarella lumer.', 'has_spicy' => true],
            'Nasi Ayam Brongot Dewata Ori' => ['prices' => ['Single' => 17000, 'Double' => 23000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Ayam bakar brongot arang batok dengan sentuhan bumbu rempah Dewata.', 'has_spicy' => true],
            'Nasi Ayam Brongot Dewata Keju' => ['prices' => ['Single' => 19000, 'Double' => 24000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Ayam bakar brongot Dewata dengan keju gurih lezat.', 'has_spicy' => true],
            'Nasi Ayam Brongot Dewata Moza' => ['prices' => ['Single' => 21000, 'Double' => 26000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Ayam bakar brongot Dewata dengan lelehan keju mozzarella spesial.', 'has_spicy' => true],
        ],
        'Brongot Series' => [
            'Nasi Ayam Brongot Ori' => ['prices' => ['Single' => 15000, 'Double' => 20000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Menu signature Numanke: ayam bakar marinasi 12 jam berkaramel gurih manis meresap hingga tulang.', 'has_spicy' => true],
            'Nasi Ayam Brongot Keju' => ['prices' => ['Single' => 17000, 'Double' => 22000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Ayam bakar brongot arang dengan taburan keju cheddar gurih melimpah.', 'has_spicy' => true],
            'Nasi Ayam Brongot Moza' => ['prices' => ['Single' => 19000, 'Double' => 24000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Ayam bakar brongot arang diselimuti mozzarella panggang mulur.', 'has_spicy' => true],
            'Nasi Jamur Brongot Ori' => ['prices' => ['Single' => 12000, 'Double' => 17000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Jamur tiram bakar bumbu brongot karamel gurih lezat.', 'has_spicy' => true],
            'Nasi Jamur Brongot Keju' => ['prices' => ['Single' => 14000, 'Double' => 19000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Jamur bakar brongot dengan taburan keju gurih mantap.', 'has_spicy' => true],
            'Nasi Jamur Brongot Moza' => ['prices' => ['Single' => 16000, 'Double' => 21000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Jamur bakar brongot dengan keju mozzarella panggang lembut.', 'has_spicy' => true],
            'Nasi Telur Brongot Ori' => ['prices' => ['Single' => 11000, 'Double' => 17000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Telur dadar bakar saus brongot karamel khas Numanke.', 'has_spicy' => true],
            'Nasi Telur Brongot Keju' => ['prices' => ['Single' => 13000, 'Double' => 19000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Telur bakar brongot bertabur keju cheddar gurih.', 'has_spicy' => true],
            'Nasi Telur Brongot Moza' => ['prices' => ['Single' => 15000, 'Double' => 21000], 'icon' => 'fa-fire', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Telur bakar brongot dengan mozzarella lumer menggoda.', 'has_spicy' => true],
        ],
        'Rongot Series' => [
            'Rongot Freeze Coklat' => ['prices' => ['Normal' => 11000], 'icon' => 'fa-ice-cream', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Roti panggang dingin isi coklat lumer lezat.', 'has_spicy' => false],
            'Rongot Freeze Keju' => ['prices' => ['Normal' => 12000], 'icon' => 'fa-ice-cream', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Roti panggang dingin isi keju gurih creamy.', 'has_spicy' => false],
            'Rongot Freeze Coklat Keju' => ['prices' => ['Normal' => 14000], 'icon' => 'fa-ice-cream', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Perpaduan sempurna coklat lumer dan keju gurih.', 'has_spicy' => false],
            'Rongot Freeze Coklat Keju Moza' => ['prices' => ['Normal' => 20000], 'icon' => 'fa-ice-cream', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Komplit coklat, keju cheddar, dan mozzarella leleh.', 'has_spicy' => false],
            'Rongot Coklat' => ['prices' => ['Normal' => 8000], 'icon' => 'fa-bread-slice', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Roti bakar hangat isi coklat manis.', 'has_spicy' => false],
            'Rongot Keju' => ['prices' => ['Normal' => 9000], 'icon' => 'fa-bread-slice', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Roti bakar hangat isi keju gurih.', 'has_spicy' => false],
        ],
        'Frozen Series' => [
            'Ayam Brongot Frozen' => ['prices' => ['Single' => 29000, 'Double' => 49000], 'icon' => 'fa-snowflake', 'img' => 'assets/images/fotoslide1.png', 'desc' => 'Ayam marinasi brongot beku siap bakar / goreng praktis di rumah.', 'has_spicy' => true],
            'Jamur Brongot Frozen' => ['prices' => ['Single' => 24000, 'Double' => 42000], 'icon' => 'fa-snowflake', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Jamur bumbu brongot siap masak kualitas resto.', 'has_spicy' => true],
            'Bakso Brongot Frozen' => ['prices' => ['Single' => 27000, 'Double' => 37000], 'icon' => 'fa-snowflake', 'img' => 'assets/images/bg-headingweb.png', 'desc' => 'Bakso sapi bumbu brongot gurih pedas.', 'has_spicy' => true],
            'Sambal Numan (Bawang/Dewata)' => ['prices' => ['Normal' => 33000], 'icon' => 'fa-pepper-hot', 'img' => 'assets/images/fotoslide2.JPG', 'desc' => 'Sambal botol khas Numanke resep otentik tahan simpan.', 'has_spicy' => true],
        ],
        'Drink' => [
            'Es Teh' => ['prices' => ['Normal' => 4000], 'icon' => 'fa-glass-water', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Es teh manis seduh melati segar wangi alami.', 'has_spicy' => false],
            'Lyche Float' => ['prices' => ['Normal' => 12000], 'icon' => 'fa-glass-water', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Minuman rasa leci segar dengan topping es krim lembut.', 'has_spicy' => false],
            'Strawberry Float' => ['prices' => ['Normal' => 12000], 'icon' => 'fa-glass-water', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Minuman stroberi asam manis dengan float es krim.', 'has_spicy' => false],
            'Mango Float' => ['prices' => ['Normal' => 12000], 'icon' => 'fa-glass-water', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Minuman mangga manis segar berpadu es krim dingin.', 'has_spicy' => false],
            'Lemon Float' => ['prices' => ['Normal' => 13000], 'icon' => 'fa-glass-water', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Kesegaran sari lemon dipadu es krim lembut.', 'has_spicy' => false],
            'Choco Float' => ['prices' => ['Normal' => 13000], 'icon' => 'fa-mug-hot', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Coklat pekat nikmat dengan topping float es krim.', 'has_spicy' => false],
            'Teh Tarik Float' => ['prices' => ['Normal' => 13000], 'icon' => 'fa-mug-hot', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Teh tarik creamy berbuih lembut berpadu es krim.', 'has_spicy' => false],
            'Choco Malt Float' => ['prices' => ['Normal' => 13000], 'icon' => 'fa-mug-hot', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Rasa malt coklat gurih manis berpadu es krim float.', 'has_spicy' => false],
            'Cappucino Float' => ['prices' => ['Normal' => 14000], 'icon' => 'fa-mug-hot', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Kopi cappucino beraroma harum dengan topping float.', 'has_spicy' => false],
            'Lyche Squash' => ['prices' => ['Normal' => 9000], 'icon' => 'fa-martini-glass-citrus', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Soda leci menyegarkan pelepas dahaga seketika.', 'has_spicy' => false],
            'Strawberry Squash' => ['prices' => ['Normal' => 9000], 'icon' => 'fa-martini-glass-citrus', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Soda stroberi manis segar dengan sensasi sparkling.', 'has_spicy' => false],
            'Mango Squash' => ['prices' => ['Normal' => 9000], 'icon' => 'fa-martini-glass-citrus', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Soda rasa mangga nikmat kaya kesegaran tropis.', 'has_spicy' => false],
            'Lemon Squash' => ['prices' => ['Normal' => 9000], 'icon' => 'fa-martini-glass-citrus', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Soda lemon asam segar pembersih lidah setelah makan pedas.', 'has_spicy' => false],
            'Es Coklat' => ['prices' => ['Normal' => 7000], 'icon' => 'fa-mug-hot', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Coklat dingin nikmat khas Numanke.', 'has_spicy' => false],
            'Air Mineral Botol' => ['prices' => ['Normal' => 5000], 'icon' => 'fa-bottle-water', 'img' => 'assets/images/fotoslide3.JPG', 'desc' => 'Air mineral kemasan dingin higienis.', 'has_spicy' => false],
        ]
    ];

    $formatted = [];
    foreach ($static as $kat => $items) {
        foreach ($items as $name => $it) {
            $formatted[$kat][$name] = array_merge([
                'id' => rand(100, 999),
                'nama' => $name,
                'kategori' => $kat,
            ], $it);
        }
    }
    return $formatted;
}

/**
 * Peta harga server untuk validasi pesanan di proses_wa.php
 */
function get_server_price_map() {
    $catalog = get_menu_catalog();
    $map = [];

    foreach ($catalog as $kat => $items) {
        foreach ($items as $name => $item) {
            if ($item['has_portions']) {
                $lblS = $item['single_label'] ?? 'Single';
                $lblD = $item['double_label'] ?? 'Double';
                $priceS = $item['single_price'];
                $priceD = $item['double_price'];

                $map[$name . ' (' . $lblS . ')'] = $priceS;
                $map[$name . ' (' . $lblD . ')'] = $priceD;
                $map[$name . ' (Single)'] = $priceS;
                $map[$name . ' (Double)'] = $priceD;
                $map[$name . ' [Single]'] = $priceS;
                $map[$name . ' [Double]'] = $priceD;
            } else {
                $price = $item['price'] ?? 10000;
                $map[$name] = $price;
                $map[$name . ' (Porsi)'] = $price;
            }
        }
    }

    return $map;
}
