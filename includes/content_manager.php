<?php
// includes/content_manager.php
// Central Content & Settings Manager for Numanke Website

$content_file = __DIR__ . '/../data/content.json';

function get_content_data() {
    global $content_file;
    if (!file_exists($content_file)) {
        return ['settings' => [], 'stories' => []];
    }
    $raw = file_get_contents($content_file);
    $data = json_decode($raw, true);
    return is_array($data) ? $data : ['settings' => [], 'stories' => []];
}

function save_content_data($data) {
    global $content_file;
    $dir = dirname($content_file);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    return file_put_contents($content_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function get_site_settings() {
    $data = get_content_data();
    return $data['settings'] ?? [];
}

function update_site_settings($new_settings) {
    $data = get_content_data();
    $current = $data['settings'] ?? [];
    $data['settings'] = array_merge($current, $new_settings);
    return save_content_data($data);
}

function get_site_stories($only_active = true) {
    $data = get_content_data();
    $stories = $data['stories'] ?? [];
    
    // Sort by order ASC
    usort($stories, function($a, $b) {
        $ordA = isset($a['order']) ? (int)$a['order'] : 999;
        $ordB = isset($b['order']) ? (int)$b['order'] : 999;
        return $ordA <=> $ordB;
    });

    if ($only_active) {
        $stories = array_filter($stories, function($item) {
            return ($item['status'] ?? 'aktif') === 'aktif';
        });
    }

    return array_values($stories);
}

function get_story_by_id($id) {
    $data = get_content_data();
    $stories = $data['stories'] ?? [];
    foreach ($stories as $s) {
        if ($s['id'] === $id) {
            return $s;
        }
    }
    return null;
}

function save_story($story_data) {
    $data = get_content_data();
    $stories = $data['stories'] ?? [];
    
    $is_update = false;
    if (!empty($story_data['id'])) {
        foreach ($stories as $idx => $s) {
            if ($s['id'] === $story_data['id']) {
                $stories[$idx] = array_merge($s, $story_data);
                $is_update = true;
                break;
            }
        }
    }
    
    if (!$is_update) {
        if (empty($story_data['id'])) {
            $story_data['id'] = 'story_' . time() . '_' . rand(100, 999);
        }
        if (!isset($story_data['order'])) {
            $story_data['order'] = count($stories) + 1;
        }
        if (!isset($story_data['date'])) {
            $story_data['date'] = date('d F Y');
        }
        $stories[] = $story_data;
    }

    $data['stories'] = $stories;
    save_content_data($data);
    return $story_data['id'] ?? true;
}

function delete_story($id) {
    $data = get_content_data();
    $stories = $data['stories'] ?? [];
    $filtered = array_filter($stories, function($s) use ($id) {
        return $s['id'] !== $id;
    });
    $data['stories'] = array_values($filtered);
    return save_content_data($data);
}

function check_resto_open_status($settings = null) {
    if ($settings === null) {
        $settings = get_site_settings();
    }
    date_default_timezone_set('Asia/Jakarta');
    
    $mode = $settings['resto_status_mode'] ?? 'auto';
    $start = !empty($settings['open_start']) ? $settings['open_start'] : '10:00';
    $end = !empty($settings['open_end']) ? $settings['open_end'] : '21:00';
    
    // Auto-parse if open_hours string is present but start/end not explicitly defined
    if ((empty($settings['open_start']) || empty($settings['open_end'])) && !empty($settings['open_hours'])) {
        if (preg_match('/(\d{1,2})[:.](\d{2})\s*(?:–|-|s\/d|to)\s*(\d{1,2})[:.](\d{2})/i', $settings['open_hours'], $m)) {
            $start = sprintf('%02d:%02d', (int)$m[1], (int)$m[2]);
            $end = sprintf('%02d:%02d', (int)$m[3], (int)$m[4]);
        }
    }
    
    if ($mode === 'force_open') {
        $is_open = true;
    } elseif ($mode === 'force_closed') {
        $is_open = false;
    } else {
        $now = date('H:i');
        $is_open = ($now >= $start && $now < $end);
    }
    
    return [
        'is_open' => $is_open,
        'status_text' => $is_open ? 'Buka' : 'Tutup',
        'status_label' => $is_open ? '(Buka)' : '(Tutup)',
        'class' => $is_open ? 'is-open' : 'is-closed',
        'color' => $is_open ? '#22c55e' : '#ef4444',
        'start' => $start,
        'end' => $end,
        'mode' => $mode
    ];
}
?>
