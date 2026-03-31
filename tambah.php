<section class="admin-section">
    <div class="admin-form">
        <h2 style="color: var(--primary); margin-bottom: 20px;">Tambah Data Bencana</h2>
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Bencana</label>
                <input type="text" name="judul" placeholder="Contoh: Banjir Bandang" required>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" placeholder="Contoh: Bogor, Jawa Barat" required>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" placeholder="Jelaskan detail kejadian..." required></textarea>
            </div>
            <div class="form-group">
                <label>Upload Gambar</label>
                <input type="file" name="gambar" accept="image/*" required>
            </div>
            <button type="submit" name="submit" class="donation-btn">Simpan Data</button>
        </form>
    </div>
</section>