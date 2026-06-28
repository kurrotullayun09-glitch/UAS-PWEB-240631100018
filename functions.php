<?php
require_once "koneksi.php";
function getAllBarang($koneksi, $keyword = "")
{
    if ($keyword != "") {
        $keyword = mysqli_real_escape_string($koneksi, $keyword);
        $sql = "SELECT * FROM barang
                WHERE nama_barang LIKE '%$keyword%' OR kode_barang LIKE '%$keyword%'
                ORDER BY id_barang DESC";
    } else {
        $sql = "SELECT * FROM barang ORDER BY id_barang DESC";
    }

    $result = mysqli_query($koneksi, $sql);
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function getBarangById($koneksi, $id)
{
    $id = (int) $id;
    $sql = "SELECT * FROM barang WHERE id_barang = $id";
    $result = mysqli_query($koneksi, $sql);
    return mysqli_fetch_assoc($result);
}
function tambahBarang($koneksi, $kode, $nama, $kategori, $jumlah, $satuan, $harga, $tanggal)
{
    $kode     = mysqli_real_escape_string($koneksi, $kode);
    $nama     = mysqli_real_escape_string($koneksi, $nama);
    $kategori = mysqli_real_escape_string($koneksi, $kategori);
    $satuan   = mysqli_real_escape_string($koneksi, $satuan);
    $tanggal  = mysqli_real_escape_string($koneksi, $tanggal);
    $jumlah   = (int) $jumlah;
    $harga    = (int) $harga;

    $sql = "INSERT INTO barang (kode_barang, nama_barang, kategori, jumlah, satuan, harga, tanggal_masuk)
            VALUES ('$kode', '$nama', '$kategori', $jumlah, '$satuan', $harga, '$tanggal')";

    return mysqli_query($koneksi, $sql);
}
function updateBarang($koneksi, $id, $kode, $nama, $kategori, $jumlah, $satuan, $harga, $tanggal)
{
    $id       = (int) $id;
    $kode     = mysqli_real_escape_string($koneksi, $kode);
    $nama     = mysqli_real_escape_string($koneksi, $nama);
    $kategori = mysqli_real_escape_string($koneksi, $kategori);
    $satuan   = mysqli_real_escape_string($koneksi, $satuan);
    $tanggal  = mysqli_real_escape_string($koneksi, $tanggal);
    $jumlah   = (int) $jumlah;
    $harga    = (int) $harga;

    $sql = "UPDATE barang SET
                kode_barang   = '$kode',
                nama_barang   = '$nama',
                kategori      = '$kategori',
                jumlah        = $jumlah,
                satuan        = '$satuan',
                harga         = $harga,
                tanggal_masuk = '$tanggal'
            WHERE id_barang = $id";

    return mysqli_query($koneksi, $sql);
}

function hapusBarang($koneksi, $id)
{
    $id = (int) $id;
    $sql = "DELETE FROM barang WHERE id_barang = $id";
    return mysqli_query($koneksi, $sql);
}

function formatRupiah($angka)
{
    return "Rp " . number_format((float) $angka, 0, ",", ".");
}
function statusStok($jumlah)
{
    $jumlah = (int) $jumlah;

    if ($jumlah == 0) {
        $label = "Habis";
        $kelas = "badge-habis";
    } elseif ($jumlah <= 5) {
        $label = "Menipis";
        $kelas = "badge-menipis";
    } else {
        $label = "Aman";
        $kelas = "badge-aman";
    }

    return "<span class='badge $kelas'>$label</span>";
}
function hitungTotalNilai($dataBarang)
{
    $total = 0;
    foreach ($dataBarang as $barang) {
        $total += $barang['jumlah'] * $barang['harga'];
    }
    return $total;
}
