<section class="admin-section">
    <div class="dashboard-card">
        <div class="form-header">
            <h2 style="color: var(--primary); display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-plus-circle"></i> Tambah Data Bencana
            </h2>
            <p style="color: var(--muted); font-size: 14px; margin-top: 5px;">Input kejadian bencana baru untuk ditampilkan di beranda dan halaman detail.</p>
        </div>

        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Judul Bencana</label>
                    <input type="text" name="judul" class="form-control" placeholder="Contoh: Banjir Bandang" required>
                </div>
                
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Bogor, Jawa Barat" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Kejadian</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Target Donasi (Rp)</label>
                    <input type="number" name="target_donasi" class="form-control" placeholder="Contoh: 50000000" required>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label>Deskripsi Singkat (Muncul di Beranda - Max 100 Kata)</label>
                <textarea name="deskripsi_singkat" rows="2" class="form-control" placeholder="Ringkasan singkat untuk kartu bencana..." required></textarea>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label>Info Detail Bencana (Muncul di Halaman Detail)</label>
                <textarea name="deskripsi" rows="6" class="form-control" placeholder="Tuliskan kronologi dan detail lengkap kejadian..." required></textarea>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label>Upload Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                <small style="color: var(--muted);">Format: JPG, JPEG, PNG. Pastikan gambar jelas.</small>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" name="submit" class="donation-btn" style="width: 100%; margin: 0;">
                    <i class="fas fa-save"></i> Simpan & Posting Sekarang
                </button>
            </div>
        </form>
    </div>
</section>