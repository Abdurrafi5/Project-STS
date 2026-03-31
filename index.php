<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BantuBencana - Peduli Sesama</title>
        <link rel="icon" href="assets/profile.png" type="image/png">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <nav>
            <div class="logo">
                <img src="assets/profile.png" class="logo-img" alt="Profile">
                <span>BantuBencana</span>
            </div>
            <div class="menu">
                <a href="#home">Home</a>
                <a href="#bencana">Data Bencana</a>
                <a href="#contributor">Contributor</a>
                <a href="#kontak">Kontak</a>
            <div class="auth-links">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <a href="admin.php" class="login-btn">Admin Panel</a>
                        <?php else: ?>
                            <span style="font-weight: 600; color: #28a745; margin-right: 10px;">
                                Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </span>
                        <?php endif; ?>
                        
                        <a href="logout.php" class="register-btn" style="background: #dc3545; border-color: #dc3545;">Logout</a>
                        
                    <?php else: ?>
                        <a href="login.php" class="login-btn">Login</a>
                        <a href="register.php" class="register-btn">Register</a>
                    <?php endif; ?>
                </div>
                <div class="theme-toggle">
                    <button id="themeToggle" aria-label="Toggle dark mode">⏾</button>
                </div>
            </div>
        </nav>

        <section id="home" class="hero">
            <div class="hero-text">
                <h1>Peduli Bencana <br><span>Bantu Sesama</span></h1>
                <p>Dapatkan informasi bencana terbaru dan bantu korban dengan donasi atau bantuan logistik secara cepat dan transparan.</p>
                <button class="hero-btn" onclick="scrollToSection('bencana')">Lihat Data Bencana</button>
            </div>
            <div class="hero-img" id="heroSlider">
                <img src="assets/bencana1.jpg" class="active" alt="Bencana 1">
                <img src="assets/bencana2.jpg" alt="Bencana 2">
                <img src="assets/bencana3.jpg" alt="Bencana 3">
                <img src="assets/bencana4.jpg" alt="Bencana 4">
                <img src="assets/bencana5.jpg" alt="Bencana 5">
                <img src="assets/bencana6.jpg" alt="Bencana 6">
            </div>
        </section>

        <section id="bencana-header" class="section">
            <div class="section-header">
                <h2>Data Bencana <span>Terkini</span></h2>
                <p>Informasi bencana alam terbaru di Indonesia</p>
            </div>
            <section id="bencana" class="bencana-section">
                    <div class="bencana-grid" id="bencanaList">
                        <?php
                        include 'config.php';

                        
                        $query = mysqli_query($conn, "SELECT * FROM bencana ORDER BY tanggal DESC");

                        if (mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)):
                        ?>
                        <div class="bencana-card">
                                <img src="assets/<?php echo $row['gambar']; ?>" alt="Bencana">
                                <div class="bencana-info">
                                    <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                                    <p class="lokasi">
                                        <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['lokasi']); ?>
                                    </p>
                                    <p class="deskripsi">
                                        <?php 
                                        $isi_deskripsi = $row['deskripsi'];
                                        $max_kata = 100; // Batas 100 kata
                                        $array_kata = explode(" ", $isi_deskripsi);
                                                                
                                        if (count($array_kata) > $max_kata) {
                                            // Ambil 100 kata pertama
                                            $potong_kata = array_slice($array_kata, 0, $max_kata);
                                            echo htmlspecialchars(implode(" ", $potong_kata)) . "...";
                                        } else {
                                            echo htmlspecialchars($isi_deskripsi);
                                        }
                                        ?>
                                    </p>
                                    <a href="detail_bencana.php?id=<?php echo $row['id']; ?>" class="donation-btn">
                                        Donasi Sekarang
                                    </a>
                                </div>
                        </div>
                        <?php 
                            endwhile; 
                        } else { 
                        ?>
                            <div class="empty-state">
                                <i class="fas fa-info-circle"></i>
                                <h3>Tidak ada data bencana untuk saat ini.</h3>
                                <p>Semoga semua wilayah tetap dalam keadaan aman dan kondusif.</p>
                            </div>
                        <?php 
                        } 
                        ?>
                    </div>
            </section>
        </section>

        <section id="contributor" class="section">
            <div class="section-header">
                <h2>Para <span>Contributor</span></h2>
                <p>Terima kasih kepada para pahlawan yang telah berkontribusi</p>
            </div>
            <div class="contributor-grid">
                <div class="contributor-card">
                    <div class="contributor-icon"><i class="fas fa-user-circle"></i></div>
                    <h3>Abdurrafi Firlan Putra</h3>
                    <p>Founder & Project Lead</p>
                    <p class="contributor-desc">Menginisiasi platform BantuBencana</p>
                </div>
                <div class="contributor-card">
                    <div class="contributor-icon"><i class="fas fa-user-circle"></i></div>
                    <h3>Muhammad Fadlan</h3>
                    <p>Founder & Project Lead</p>
                    <p class="contributor-desc">Menginisiasi platform BantuBencana</p>
                </div>
                <div class="contributor-card">
                    <div class="contributor-icon"><i class="fas fa-user-circle"></i></div>
                    <h3>Afifah Khoirunnisa</h3>
                    <p>Founder & Project Lead</p>
                    <p class="contributor-desc">Menginisiasi platform BantuBencana</p>
                </div>
            </div>
        </section>

        <section id="kontak" class="section">
            <div class="section-header">
                <h2>Kontak <span>Kami</span></h2>
                <p>Ada pertanyaan? Silakan hubungi kami</p>
            </div>
            <div class="kontak-container">
                <form id="contactForm">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" required placeholder="Masukkan nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" required placeholder="Masukkan email Anda">
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan:</label>
                        <textarea id="pesan" rows="4" required placeholder="Tulis pesan Anda"></textarea>
                    </div>
                    <button type="submit">Kirim Pesan</button>
                </form>
            </div>
        </section>

        <section class="social-share">
            <h3>Bagikan Website Ini:</h3>
            <div class="share-buttons">
                <a href="#" class="share-btn whatsapp" onclick="shareWhatsApp()"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                <a href="#" class="share-btn facebook" onclick="shareFacebook()"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#" class="share-btn twitter" onclick="shareTwitter()"><i class="fab fa-twitter"></i> Twitter</a>
            </div>
        </section>

        <footer>
            <div class="footer-content">
                <p>&copy; 2026 BantuBencana.</p>
            </div>
        </footer>

        <script src="script.js"></script>
    </body>
</html>