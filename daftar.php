<?php
$halaman = "daftar";
require_once "functions.php";
$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";
$dataBarang = getAllBarang($koneksi, $keyword);

require_once "header.php";
?>

    <section class="list-section">
        <h1>Daftar Data Barang</h1>

        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == "tambah") {
                echo "<div class='alert alert-success'>Data barang berhasil ditambahkan!</div>";
            } elseif ($status == "update") {
                echo "<div class='alert alert-success'>Data barang berhasil diperbarui!</div>";
            } elseif ($status == "hapus") {
                echo "<div class='alert alert-success'>Data barang berhasil dihapus!</div>";
            }
        }
        ?>

        <form action="daftar.php" method="GET" class="search-form">
            <input type="text" name="cari" placeholder="Cari kode atau nama barang..." value="<?php echo htmlspecialchars($keyword); ?>">
            <button type="submit" class="btn btn-secondary">Cari</button>
            <?php if ($keyword != "") { ?>
                <a href="daftar.php" class="btn btn-outline">Reset</a>
            <?php } ?>
        </form>

        <div class="table-wrapper">
        <table class="tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total Nilai</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($dataBarang) > 0) {
                    $no = 1;
                    foreach ($dataBarang as $barang) {
                        $totalNilaiBarang = $barang['jumlah'] * $barang['harga'];
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo htmlspecialchars($barang['kode_barang']); ?></td>
                    <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($barang['kategori']); ?></td>
                    <td><?php echo $barang['jumlah'] . " " . htmlspecialchars($barang['satuan']); ?></td>
                    <td><?php echo formatRupiah($barang['harga']); ?></td>
                    <td><?php echo formatRupiah($totalNilaiBarang); ?></td>
                    <td><?php echo statusStok($barang['jumlah']); ?></td>
                    <td><?php echo date("d-m-Y", strtotime($barang['tanggal_masuk'])); ?></td>
                    <td class="aksi">
                        <a href="edit.php?id=<?php echo $barang['id_barang']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?php echo $barang['id_barang']; ?>" class="btn btn-hapus"
                           onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php
                        $no++;
                    }
                } else {
                ?>
                <tr><td colspan="10">Data tidak ditemukan.</td></tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </section>

<?php require_once "footer.php"; ?>
