<?php
require_once "functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    hapusBarang($koneksi, $id);
}

header("Location: daftar.php?status=hapus");
exit;
