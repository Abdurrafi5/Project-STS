<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BantuBencana - Admin Panel</title>
        <link rel="icon" href="assets/profile.png" type="image/png">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <nav>
            <div class="logo">
                <img src="assets/profile.png" class="logo-img" alt="Profile">
                <span>BantuBencana <small style="font-size: 12px; color: var(--muted);">Admin</small></span>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="index.php#bencana">Data Bencana</a>
                <div class="auth-links">
                    <span style="font-weight: 700; color: var(--primary); margin-right: 10px;">
                        <i class="fas fa-user-circle"></i> <?php echo $_SESSION['username']; ?>
                    </span>
                    <a href="logout.php" class="register-btn" style="background: #dc3545; border-color: #dc3545;">Logout</a>
                </div>
                <div class="theme-toggle">
                    <button id="themeToggle" aria-label="Toggle dark mode">⏾</button>
                </div>
            </div>
        </nav>

        <div class="admin-container">
            <div class="admin-card">
                <div class="admin-header">
                    <i class="fas fa-user-shield"></i>
                    <h1>Admin <span>Panel</span></h1>
                    <p style="font-size: 1.2rem; font-weight: 600; color: #28a745; margin-bottom: 5px;">
                        Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                    </p>
                    <p>Selamat datang di pusat kendali BantuBencana. Silakan pilih menu di bawah ini.</p>
                </div>
                
                <div class="admin-menu">
                    <div class="admin-box">
                        <i class="fas fa-database"></i>
                        <h3>Kelola Data Bencana</h3>
                        <p>Tambah, edit, atau hapus data kejadian bencana terbaru.</p>
                        <a href="kelolaBencana.php" class="admin-btn" style="text-decoration: none; display: inline-block;">Buka Kelola</a>
                    </div>
                    
                    <div class="admin-box">
                        <i class="fas fa-hand-holding-heart"></i>
                        <h3>Data Donasi</h3>
                        <p>Pantau laporan donasi masuk dari para donatur.</p>
                        <button class="admin-btn" onclick="alert('Fitur Donasi sedang dikembangkan')">Lihat Donasi</button>
                    </div>
                    
                    <div class="admin-box">
                        <i class="fas fa-envelope-open-text"></i>
                        <h3>Pesan Masuk</h3>
                        <p>Baca dan balas pesan saran/kontak dari pengunjung.</p>
                        <button class="admin-btn" onclick="alert('Fitur Pesan sedang dikembangkan')">Baca Pesan</button>
                    </div>
                </div>
                
                <div class="admin-footer" style="text-align: center; margin-top: 20px; border-top: 1px solid var(--border); padding-top: 20px;">
                    <a href="index.php" class="back-btn" style="text-decoration: none; color: var(--text-body); font-weight: 600; transition: 0.3s;">
                        <i class="fas fa-arrow-left"></i> Kembali ke Beranda Utama
                    </a>
                </div>
            </div>
        </div>

        <footer>
            <div class="footer-content">
                <p>&copy; 2026 BantuBencana - Panel Admin Berbasis Komunitas.</p>
            </div>
        </footer>

        <script src="script.js"></script>
    </body>
</html>