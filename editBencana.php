<?php
session_start();
include 'config.php';

// Proteksi Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM bencana WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika ID tidak ditemukan
if (!$data) {
    header("Location: kelolaBencana.php");
    exit();
}

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $tanggal = $_POST['tanggal'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        
        // Hapus gambar lama jika ada (opsional tapi bagus untuk kebersihan storage)
        if(file_exists("assets/" . $data['gambar'])) {
            unlink("assets/" . $data['gambar']);
        }
        
        move_uploaded_file($tmp, "assets/" . $gambar);
        $sql = "UPDATE bencana SET judul='$judul', lokasi='$lokasi', deskripsi='$deskripsi', tanggal='$tanggal', gambar='$gambar' WHERE id='$id'";
    } else {
        $sql = "UPDATE bencana SET judul='$judul', lokasi='$lokasi', deskripsi='$deskripsi', tanggal='$tanggal' WHERE id='$id'";
    }

    mysqli_query($conn, $sql);
    echo "<script>alert('Data Berhasil Diperbarui!'); window.location='kelolaBencana.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BantuBencana - Edit Data</title>
    <link rel="icon" href="assets/profile.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-main { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        .dashboard-card { 
            background: var(--surface); 
            border-radius: 20px; 
            border: 2px solid var(--border); 
            padding: 35px; 
            box-shadow: 0 8px 24px rgba(0,0,0,0.05); 
        }
        
        .form-header { margin-bottom: 25px; border-bottom: 1px solid var(--border); padding-bottom: 15px; }
        .form-header h2 { color: var(--primary); display: flex; align-items: center; gap: 10px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-body); font-size: 14px; }
        
        .form-control { 
            width: 100%; padding: 14px; border: 2px solid var(--border); 
            border-radius: 12px; background: var(--bg); color: var(--text-body); 
            font-family: inherit; font-size: 15px; transition: 0.3s;
        }
        
        .form-control:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 4px var(--soft); }

        .current-img-box { 
            display: flex; align-items: center; gap: 15px; 
            background: var(--soft); padding: 15px; border-radius: 12px; margin-bottom: 10px; 
        }

        .btn-group { display: flex; gap: 15px; margin-top: 30px; }
        .btn-save { flex: 2; }
        .btn-cancel { 
            flex: 1; background: #f8f9fa; color: #6c757d; border: 2px solid #dee2e6; 
            padding: 14px; border-radius: 12px; font-weight: 700; text-align: center; text-decoration: none; transition: 0.3s;
        }
        .btn-cancel:hover { background: #e2e6ea; color: #343a40; }

        .back-link { text-decoration: none; color: var(--muted); font-size: 14px; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 20px; transition: 0.3s; }
        .back-link:hover { color: var(--primary); }
    </style>
</head>
<body>

<main class="admin-main">
    <a href="kelolaBencana.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Bencana
    </a>

    <div class="dashboard-card">
        <div class="form-header">
            <h2><i class="fas fa-edit"></i> Edit Laporan Bencana</h2>
            <p style="color: var(--muted); font-size: 14px;">Perbarui informasi kejadian bencana yang dipilih.</p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Bencana</label>
                <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="<?php echo htmlspecialchars($data['lokasi']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Kejadian</label>
                    <input type="date" name="tanggal" class="form-control" value="<?php echo $data['tanggal']; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi (Maksimal 500 kata)</label>
                <textarea name="deskripsi" rows="6" class="form-control" oninput="checkWordCount(this)" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Foto Kejadian</label>
                <div class="current-img-box">
                    <img src="assets/<?php echo $data['gambar']; ?>" width="80" height="80" style="object-fit: cover; border-radius: 8px;">
                    <div>
                        <p style="font-size: 12px; font-weight: 600; margin-bottom: 4px;">Gambar Saat Ini:</p>
                        <p style="font-size: 13px; color: var(--muted);"><?php echo $data['gambar']; ?></p>
                    </div>
                </div>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <small style="color: var(--muted); margin-top: 5px; display: block;">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
            </div>

            <div class="btn-group">
                <a href="kelolaBencana.php" class="btn-cancel">Batal</a>
                <button type="submit" name="update" class="donation-btn btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>

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