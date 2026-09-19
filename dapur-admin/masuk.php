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
    
    // Kredensial statis untuk contoh (bisa diubah menggunakan database nanti)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = 'Admin Numanke';
        header("Location: index.php");
        exit();
    } else {
        $error = '<div class="alert alert-danger" style="color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px;">Username atau kata sandi salah!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dapur Admin Numanke</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #1e1e1e; display: flex; justify-content: center; align-items: center; height: 100vh; color: white; }
        .login-card { background: #2c2c2c; padding: 40px; border-radius: 10px; width: 100%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border-top: 4px solid #FFD700; }
        .login-card h2 { text-align: center; color: #FFD700; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; color: #ccc; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #444; border-radius: 5px; background: #1a1a1a; color: white; box-sizing: border-box; }
        .form-group input:focus { border-color: #FFD700; outline: none; }
        .btn-login { width: 100%; padding: 12px; background: #990000; color: #FFD700; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-login:hover { background: #FFD700; color: #990000; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Dapur Numanke</h2>
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
            <button type="submit" name="login" class="btn-login">Masuk Dapur</button>
        </form>
    </div>
</body>
</html>