<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $tanggal = $_POST['tanggal'];
    
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $ekstensi_boleh = array('png', 'jpg', 'jpeg');
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));

    if (move_uploaded_file($tmp, "assets/" . $gambar)) {
        mysqli_query($conn, "INSERT INTO bencana (judul, lokasi, deskripsi, tanggal, gambar) VALUES ('$judul', '$lokasi', '$deskripsi', '$tanggal', '$gambar')");
        echo "<script>alert('Data Berhasil Ditambah!'); window.location='kelolaBencana.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BantuBencana - Kelola Data</title>
    <link rel="icon" href="assets/profile.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-main { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .dashboard-card { background: var(--surface); border-radius: 20px; border: 2px solid var(--border); padding: 35px; margin-bottom: 30px; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        
        .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-body); }
        .form-group input, .form-group textarea { 
            width: 100%; padding: 14px; border: 2px solid var(--border); 
            border-radius: 12px; background: var(--bg); color: var(--text-body); font-family: inherit;
        }

        .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; margin-top: 10px; }
        .custom-table th { padding: 15px 20px; text-align: left; color: var(--muted); font-size: 12px; text-transform: uppercase; }
        .custom-table td { padding: 20px; background: var(--surface); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        
        .custom-table tr td:first-child { border-left: 1px solid var(--border); border-radius: 12px 0 0 12px; }
        .custom-table tr td:last-child { border-right: 1px solid var(--border); border-radius: 0 12px 12px 0; }

        .badge-loc { background: var(--soft); color: var(--primary); padding: 6px 12px; border-radius: 30px; font-size: 11px; font-weight: 700; }
        
        .action-btns { display: flex; gap: 12px; }
        .btn-edit { background: #fff9e6; color: #ffc107; border: 1px solid #ffeeba; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px; text-decoration: none; }
        .btn-delete { background: #fff5f5; color: #dc3545; border: 1px solid #ffcccc; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px; text-decoration: none; }
        
        .back-btn { text-decoration: none; color: var(--text-body); font-weight: 600; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .back-btn:hover { color: var(--primary); }
    </style>
</head>
<body>

<div class="admin-main">
    <a href="admin.php" class="back-btn"><i class="fas fa-arrow-left"></i> Kembali ke Panel Utama</a>

    <div class="dashboard-card">
        <h2><i class="fas fa-plus-circle"></i> Tambah Kejadian Baru</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="form-grid">
            <div class="form-group">
                <label>Judul Bencana</label>
                <input type="text" name="judul" required>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" required>
            </div>
            <div class="form-group">
                <label>Tanggal Kejadian</label>
                <input type="date" name="tanggal" required>
            </div>
            <div class="form-group">
                <label>Foto Kejadian</label>
                <input type="file" name="gambar" accept="image/*" required>
            </div>
            <div class="form-group full-width">
                <label>Deskripsi Singkat (Maks 500 kata)</label>
                <textarea name="deskripsi" rows="5" oninput="checkWordCount(this)" placeholder="Ceritakan detail kejadian..." required></textarea>
            </div>
            <button type="submit" name="tambah" class="donation-btn full-width">Posting Sekarang</button>
        </form>
    </div>

    <div class="dashboard-card">
        <h2><i class="fas fa-database"></i> Database Bencana</h2>
        <div style="overflow-x: auto;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Info Bencana</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM bencana ORDER BY id DESC");
                    if(mysqli_num_rows($res) > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <img src="assets/<?php echo $row['gambar']; ?>" width="60" height="60" style="border-radius: 10px; object-fit: cover;">
                                <div>
                                    <div style="font-weight: 700; color: var(--text-body);"><?php echo htmlspecialchars($row['judul']); ?></div>
                                    <span class="badge-loc"><?php echo htmlspecialchars($row['lokasi']); ?></span>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 14px; font-weight: 600;">
                            <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="editBencana.php?id=<?php echo $row['id']; ?>" class="btn-edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                <a href="hapusBencana.php?id=<?php echo $row['id']; ?>" class="btn-delete" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='3' style='text-align:center;'>Belum ada data bencana.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function checkWordCount(field) {
        let words = field.value.trim().split(/\s+/);
        if (words.length > 500) {
            alert("Batas maksimal 500 kata tercapai!");
            field.value = words.slice(0, 500).join(" ");
        }
    }
</script>

</body>
</html>