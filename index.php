<?php
$halaman = "home";
require_once "functions.php";
$dataBarang  = getAllBarang($koneksi);
$totalItem   = count($dataBarang);
$totalNilai  = hitungTotalNilai($dataBarang);
$kategoriUnik = array();
$stokMenipis  = 0;

foreach ($dataBarang as $barang) {
    if (!in_array($barang['kategori'], $kategoriUnik)) {
        $kategoriUnik[] = $barang['kategori'];
    }

    if ($barang['jumlah'] <= 5) {
        $stokMenipis++;
    }
}

$totalKategori = count($kategoriUnik);

require_once "header.php";
?>

    <section class="hero">
        <h1>Sistem Inventaris Barang</h1>
        <p>Kelola data barang kantor dengan mudah: tambah, lihat, ubah, dan hapus data inventaris dalam satu tempat.</p>
    </section>

    <section class="stats">
        <div class="stat-card">
            <h3><?php echo $totalItem; ?></h3>
            <p>Jenis Barang</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $totalKategori; ?></h3>
            <p>Kategori</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $stokMenipis; ?></h3>
            <p>Stok Menipis / Habis</p>
        </div>
        <div class="stat-card">
            <h3><?php echo formatRupiah($totalNilai); ?></h3>
            <p>Total Nilai Inventaris</p>
        </div>
    </section>

    <section class="cta">
        <a href="tambah.php" class="btn btn-primary">+ Tambah Data Barang</a>
        <a href="daftar.php" class="btn btn-secondary">Lihat Semua Data</a>
    </section>

    <section class="preview">
        <h2>Barang Terbaru</h2>
        <div class="table-wrapper">
        <table class="tabel-data">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $batasTampil = 5;
                $no = 0;

                if (count($dataBarang) > 0) {
                    foreach ($dataBarang as $barang) {
                        if ($no >= $batasTampil) {
                            break;
                        }
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($barang['kode_barang']); ?></td>
                    <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($barang['kategori']); ?></td>
                    <td><?php echo $barang['jumlah'] . " " . htmlspecialchars($barang['satuan']); ?></td>
                    <td><?php echo statusStok($barang['jumlah']); ?></td>
                </tr>
                <?php
                        $no++;
                    }
                } else {
                ?>
                <tr><td colspan="5">Belum ada data barang.</td></tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </section>

<?php require_once "footer.php"; ?>
