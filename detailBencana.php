<?php
session_start();
include 'config.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM bencana WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: index.php");
    exit();
}

$target = $data['target_donasi'];
$terkumpul = isset($data['terkumpul']) ? $data['terkumpul'] : 0;
$persen = ($target > 0) ? ($terkumpul / $target) * 100 : 0;
if ($persen > 100) $persen = 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['judul']); ?> - BantuBencana</title>
    <link rel="icon" href="assets/profile.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .detail-main { max-width: 900px; margin: 120px auto 50px; padding: 0 20px; }
        .detail-card { background: var(--surface); border-radius: 30px; border: 2px solid var(--border); overflow: hidden; padding: 40px; }
        .detail-img { width: 100%; height: 400px; object-fit: cover; border-radius: 20px; margin-bottom: 30px; }
        .detail-header h1 { font-size: 32px; color: var(--text-header); margin-bottom: 10px; }
        .detail-meta { display: flex; gap: 20px; margin-bottom: 20px; color: var(--muted); font-size: 14px; font-weight: 600; }
        .detail-meta i { color: var(--primary); }
        
        .target-box { background: var(--soft); padding: 20px; border-radius: 15px; margin: 25px 0; border: 1px solid var(--border); }
        .progress-bg { background: #e9ecef; height: 10px; border-radius: 10px; margin-top: 10px; overflow: hidden; }
        .progress-fill { background: var(--primary); height: 100%; transition: 1.5s ease-in-out; }
        
        .description-text { line-height: 1.8; color: var(--text-body); font-size: 16px; white-space: pre-line; margin-bottom: 40px; }
        .donation-choice { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px; }
        .choice-card { padding: 25px; border-radius: 20px; text-align: center; cursor: pointer; transition: 0.3s; display: flex; flex-direction: column; align-items: center; gap: 10px; border: 2px solid var(--border); background: var(--surface); }
        .choice-money { border-color: var(--primary); }
        .choice-money:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .choice-items { border-style: dashed; }
        .choice-items:hover { background: var(--soft); }
        
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(5px); }
        .modal-content { background: var(--surface); padding: 35px; border-radius: 25px; width: 90%; max-width: 400px; text-align: center; border: 1px solid var(--border); }
        .modal-input { width: 100%; padding: 15px; margin: 20px 0; border: 2px solid var(--border); border-radius: 12px; font-size: 18px; text-align: center; font-weight: 700; background: var(--bg); color: var(--text-header); }
    </style>
</head>
<body class="<?php echo isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark' ? 'dark-mode' : ''; ?>">

<nav>
    <div class="logo">
        <img src="assets/profile.png" class="logo-img" alt="">
        <span>BantuBencana</span>
    </div>
    <div class="menu">
        <a href="index.php">Kembali</a>
    </div>
</nav>

<main class="detail-main">
    <div class="detail-card">
        <img src="assets/<?php echo $data['gambar']; ?>" class="detail-img">
        
        <div class="detail-header">
            <div class="detail-meta">
                <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($data['lokasi']); ?></span>
                <span><i class="fas fa-calendar-alt"></i> <?php echo date('d M Y', strtotime($data['tanggal'])); ?></span>
            </div>
            <h1><?php echo htmlspecialchars($data['judul']); ?></h1>
        </div>

        <div class="target-box">
            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                <span style="color: var(--muted);">Terkumpul: <strong>Rp <?php echo number_format($terkumpul, 0, ',', '.'); ?></strong></span>
                <span style="font-weight: 700; color: var(--primary);">Target: Rp <?php echo number_format($target, 0, ',', '.'); ?></span>
            </div>
            <div class="progress-bg">
                <div class="progress-fill" style="width: <?php echo $persen; ?>%;"></div>
            </div>
            <p style="font-size: 12px; margin-top: 8px; color: var(--muted); text-align: right;"><?php echo round($persen, 1); ?>% Tercapai</p>
        </div>

        <div class="description-text">
            <?php echo htmlspecialchars($data['deskripsi']); ?>
        </div>

        <hr style="border: 0; border-top: 1px solid var(--border); margin: 40px 0;">

        <h3 style="text-align: center; margin-bottom: 20px; color: var(--text-header);">Pilih Bentuk Donasi</h3>
        <div class="donation-choice">
            <div class="choice-card choice-money" onclick="openModal()">
                <i class="fas fa-hand-holding-usd" style="font-size: 40px; color: var(--primary);"></i>
                <h4 style="color: var(--primary);">Donasi Uang</h4>
                <p style="font-size: 12px; color: var(--muted);">Transfer Instan / Simulasi</p>
            </div>

            <div class="choice-card choice-items" onclick="alert('Fitur Donasi Barang akan tersedia segera!')">
                <i class="fas fa-box-open" style="font-size: 40px; color: #6c757d;"></i>
                <h4 style="color: var(--text-header);">Donasi Barang</h4>
                <p style="font-size: 12px; color: var(--muted);">Pakaian, Makanan, dsb.</p>
            </div>
        </div>
    </div>
</main>

<div id="donasiModal" class="modal-overlay">
    <div class="modal-content">
        <i class="fas fa-heart" style="font-size: 50px; color: var(--primary); margin-bottom: 15px;"></i>
        <h3 style="color: var(--text-header);">Bantu Sesama</h3>
        <p style="font-size: 14px; color: var(--muted);">Masukkan nominal donasi untuk <strong><?php echo htmlspecialchars($data['judul']); ?></strong></p>
        
        <input type="number" id="nominalInput" class="modal-input" placeholder="Rp 0">
        
        <div style="display: flex; gap: 10px;">
            <button onclick="closeModal()" style="flex: 1; padding: 14px; border-radius: 12px; border: none; background: var(--soft); cursor: pointer; color: var(--text-header);">Batal</button>
            <button onclick="submitDonasi()" class="donation-btn" style="flex: 2; margin: 0;">Lanjutkan</button>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('donasiModal');
    const input = document.getElementById('nominalInput');

    function openModal() {
        modal.style.display = 'flex';
        input.focus();
    }

    function closeModal() {
        modal.style.display = 'none';
        input.value = '';
    }

    function submitDonasi() {
    let nominal = input.value;
    let idBencana = "<?php echo $id; ?>";

    if (nominal === "" || nominal <= 0) {
        alert("Harap masukkan nominal yang valid!");
        return;
    }

    let formData = new FormData();
    formData.append('id', idBencana);
    formData.append('nominal', nominal);

    fetch('updateDonasi.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            alert("Terima kasih! Donasi sebesar Rp " + parseInt(nominal).toLocaleString('id-ID') + " berhasil dikirim.");
            location.reload();
        } else {
            alert("Gagal memproses donasi.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Terjadi kesalahan koneksi.");
    });
}

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

</body>
</html>