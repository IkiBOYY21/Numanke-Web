<?php
session_start();
// Jika sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: index.php");
    exit();
}

$error = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Kredensial statis untuk contoh
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = 'Admin Numanke';
        header("Location: index.php");
        exit();
    } else {
        $error = '<div class="alert-retro">Username atau kata sandi salah!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dapur Admin Numanke</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --color-white: #ffffff;
            --color-red: #c92a2a;
            --color-red-dark: #9b1c1c;
            --color-gold: #f59f00;
            --color-dark: #18181b;
            --color-text-main: #27272a;
            --color-text-muted: #71717a;
            --color-border: #e4e4e7;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #fcfcfd 0%, #f4f4f6 100%);
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            color: var(--color-text-main);
            padding: 1.5rem;
        }
        .login-card { 
            background: var(--color-white); 
            padding: 2.75rem 2.25rem; 
            border-radius: 24px; 
            width: 100%; 
            max-width: 420px; 
            border: 1px solid var(--color-border);
            box-shadow: 0 20px 45px -10px rgba(24, 24, 27, 0.12), 0 8px 20px -3px rgba(201, 42, 42, 0.08), 0 0 0 1px rgba(226, 232, 240, 0.9); 
            text-align: center;
        }
        .login-card img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: 2px solid var(--color-red);
            object-fit: cover;
            margin-bottom: 1rem;
            box-shadow: 0 6px 16px rgba(201, 42, 42, 0.2);
        }
        .login-card h2 { 
            font-family: 'Playfair Display', Georgia, serif;
            color: var(--color-dark); 
            font-size: 1.85rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }
        .login-card h2 span {
            color: var(--color-red);
        }
        .subtitle {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-text-muted);
            margin-bottom: 1.75rem;
        }
        .form-group { 
            margin-bottom: 1.25rem; 
            text-align: left;
        }
        .form-group label { 
            display: block; 
            margin-bottom: 0.4rem; 
            font-weight: 700;
            font-size: 0.82rem;
            color: var(--color-text-main); 
        }
        .form-group input { 
            width: 100%; 
            padding: 12px 16px; 
            border: 1.5px solid var(--color-border); 
            border-radius: 12px; 
            background: #ffffff; 
            color: var(--color-text-main); 
            font-family: inherit;
            font-weight: 600;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.2s ease;
        }
        .form-group input:focus { 
            border-color: var(--color-red); 
            box-shadow: 0 0 0 4px rgba(201, 42, 42, 0.12);
        }
        .btn-login { 
            width: 100%; 
            padding: 13px; 
            background: linear-gradient(135deg, var(--color-red) 0%, var(--color-red-dark) 100%); 
            color: var(--color-white); 
            border: none; 
            border-radius: 50px; 
            font-family: inherit;
            font-size: 1rem; 
            font-weight: 700; 
            cursor: pointer; 
            box-shadow: 0 10px 24px -4px rgba(201, 42, 42, 0.4);
            transition: all 0.25s ease;
            margin-top: 0.5rem;
        }
        .btn-login:hover { 
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -4px rgba(201, 42, 42, 0.5);
        }
        .alert-retro {
            background: #fef2f2;
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #b91c1c;
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }
        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: var(--color-red);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <img src="../assets/images/logo numanke.png" alt="Logo Numanke">
        <h2>Dapur Numanke<span>.</span></h2>
        <div class="subtitle">Panel Khusus Pengelola Restoran</div>
        <?php echo $error; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" required placeholder="Masukkan kata sandi">
            </div>
            <button type="submit" name="login" class="btn-login"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Masuk Dapur</button>
        </form>
        <a href="../index.php" class="back-link"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Website</a>
    </div>
</body>
</html>
