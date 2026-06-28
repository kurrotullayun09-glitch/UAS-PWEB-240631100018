<?php
$halaman = "tambah";
require_once "functions.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kode     = trim($_POST['kode_barang']);
    $nama     = trim($_POST['nama_barang']);
    $kategori = trim($_POST['kategori']);
    $jumlah   = trim($_POST['jumlah']);
    $satuan   = trim($_POST['satuan']);
    $harga    = trim($_POST['harga']);
    $tanggal  = trim($_POST['tanggal_masuk']);

    if ($kode == "" || $nama == "" || $kategori == "" || $jumlah == "" || $satuan == "" || $harga == "" || $tanggal == "") {
        $error = "Semua field wajib diisi!";
    } elseif (!is_numeric($jumlah) || !is_numeric($harga)) {
        $error = "Jumlah dan Harga harus berupa angka!";
    } elseif ($jumlah < 0 || $harga < 0) {
        $error = "Jumlah dan Harga tidak boleh bernilai negatif!";
    } else {
        $berhasil = tambahBarang($koneksi, $kode, $nama, $kategori, $jumlah, $satuan, $harga, $tanggal);

        if ($berhasil) {
            header("Location: daftar.php?status=tambah");
            exit;
        } else {
            $error = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}

require_once "header.php";
?>

    <section class="form-section">
        <h1>Tambah Data Barang</h1>

        <?php if ($error != "") { ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <form action="tambah.php" method="POST" class="form-card">

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" id="kode_barang" name="kode_barang" placeholder="BRG-008"
                       value="<?php echo isset($_POST['kode_barang']) ? htmlspecialchars($_POST['kode_barang']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" placeholder="Contoh: Monitor LED 19 inch"
                       value="<?php echo isset($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $listKategori = array("Elektronik", "ATK", "Furniture", "Peralatan", "Lainnya");
                    foreach ($listKategori as $kat) {
                        $selected = (isset($_POST['kategori']) && $_POST['kategori'] == $kat) ? "selected" : "";
                        echo "<option value='" . $kat . "' " . $selected . ">" . $kat . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" min="0"
                           value="<?php echo isset($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" id="satuan" name="satuan" placeholder="unit / pcs / box"
                           value="<?php echo isset($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : ''; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="harga">Harga Satuan (Rp)</label>
                <input type="number" id="harga" name="harga" min="0"
                       value="<?php echo isset($_POST['harga']) ? htmlspecialchars($_POST['harga']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk"
                       value="<?php echo isset($_POST['tanggal_masuk']) ? htmlspecialchars($_POST['tanggal_masuk']) : date('Y-m-d'); ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                <a href="daftar.php" class="btn btn-outline">Batal</a>
            </div>

        </form>
    </section>

<?php require_once "footer.php"; ?>
