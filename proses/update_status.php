<?php
include '../koneksi.php';

// Validasi ID pesan
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_pesan = (int)$_GET['id'];
    
    // Update status pesan
    $sql = "UPDATE pesan SET status = 'terbaca' WHERE id_pesan = $id_pesan AND penerima = 'admin'";
    if(mysqli_query($koneksi, $sql)) {
        $_SESSION['flash_sukses'] = 'Pesan telah ditandai sebagai terbaca';
    } else {
        $_SESSION['flash_error'] = 'Gagal mengupdate status pesan';
    }
} else {
    $_SESSION['flash_error'] = 'ID pesan tidak valid';
}

// Redirect kembali ke halaman pesan
header('Location: ../index.php?page=blog');
exit;
?>