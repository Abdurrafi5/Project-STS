<?php
session_start();
include 'config.php';
$error = "";

if (isset($_SESSION['user_id'])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>BantuBencana - Login</title>
        <link rel="icon" href="assets/profile.png" type="image/png">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="auth.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-card">
                <h2>Login <span>User</span></h2>
                <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <p style="color: #28a745; text-align: center;">Registrasi berhasil! Silakan login.</p>
                <?php endif; ?>
                <?php if($error): ?>
                    <p style="color: #dc3545; text-align: center;"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email Anda" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password Anda" required>
                    </div>
                    <button type="submit" class="auth-btn">Masuk</button>
                </form>
                <div class="auth-link">
                    Belum punya akun? <a href="register.php">Daftar sekarang</a>
                </div>
            </div>
        </div>
    </body>
</html>