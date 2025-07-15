<?php
include '../koneksi.php';

// Validasi input
if(empty($_POST['pengirim'])) {
    $_SESSION['flash_error'] = 'Nama pengirim harus diisi!';
    header('Location: ../index.php?page=dashboard');
    exit;
}

if(empty($_POST['isi'])) {
    $_SESSION['flash_error'] = 'Isi pesan tidak boleh kosong!';
    header('Location: ../index.php?page=dashboard');
    exit;
}

// Escape input untuk mencegah SQL injection
$pengirim = mysqli_real_escape_string($koneksi, $_POST['pengirim']);
$penerima = 'admin'; // Penerima default
$judul = isset($_POST['judul']) ? mysqli_real_escape_string($koneksi, $_POST['judul']) : 'Tidak ada judul';
$isi = mysqli_real_escape_string($koneksi, $_POST['isi']);

// Query untuk menyimpan pesan
$sql = "INSERT INTO pesan (pengirim, penerima, judul, isi, status) 
        VALUES ('$pengirim', '$penerima', '$judul', '$isi', 'terkirim')";

if(mysqli_query($koneksi, $sql)) {
    $_SESSION['flash_sukses'] = 'Pesan Anda berhasil dikirim!';
} else {
    $_SESSION['flash_error'] = 'Gagal mengirim pesan: ' . mysqli_error($koneksi);
}

header('Location: ../index.php?page=dashboard');
exit;
?>