<?php
session_start();
include '../koneksi.php';

// Validasi input
if(empty($_POST['pengirim']) || empty($_POST['isi'])) {
    $_SESSION['flash_error'] = 'Nama dan isi pesan wajib diisi!';
    header('Location: ../dashboard.php#contact');
    exit;
}

// Escape input
$pengirim = mysqli_real_escape_string($koneksi, $_POST['pengirim']);
$email = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
$judul = mysqli_real_escape_string($koneksi, $_POST['judul'] ?? 'Tidak ada judul');
$isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
$penerima = 'admin'; // Penerima default

// Query INSERT dengan semua field
$sql = "INSERT INTO pesan (pengirim, penerima, email, judul, isi, status, tanggal_kirim) 
        VALUES ('$pengirim', '$penerima', '$email', '$judul', '$isi', 'terkirim', NOW())";

if(mysqli_query($koneksi, $sql)) {
    $_SESSION['flash_sukses'] = 'Pesan berhasil dikirim!';
} else {
    $_SESSION['flash_error'] = 'Gagal mengirim pesan: ' . mysqli_error($koneksi);
}

header('Location: ../dashboard.php#contact');
exit;
?>