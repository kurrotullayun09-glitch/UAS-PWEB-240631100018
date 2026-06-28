<?php
if (!isset($halaman)) {
    $halaman = "";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <span class="barcode">
                <span></span><span></span><span></span><span></span><span></span><span></span>
            </span>
            Inventaris<span>Barang</span>
        </div>
        <nav>
            <a href="index.php" class="<?php echo ($halaman == "home") ? "active" : ""; ?>">Beranda</a>
            <a href="tambah.php" class="<?php echo ($halaman == "tambah") ? "active" : ""; ?>">Tambah Data</a>
            <a href="daftar.php" class="<?php echo ($halaman == "daftar") ? "active" : ""; ?>">Daftar Data</a>
        </nav>
    </header>

    <main class="container">
