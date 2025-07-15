<?php
include '../koneksi.php';
session_start();

// Set penerima default (bisa diganti dengan $_SESSION jika sudah ada login)
$penerima = 'admin';

// Handle aksi tandai sudah dibaca
if(isset($_GET['action']) && $_GET['action'] == 'mark_as_read' && isset($_GET['id'])) {
    $id_pesan = (int)$_GET['id'];
    $sql = "UPDATE pesan SET status = 'terbaca' WHERE id_pesan = $id_pesan AND penerima = '$penerima'";
    
    if(mysqli_query($koneksi, $sql)) {
        $_SESSION['flash_sukses'] = 'Pesan telah ditandai sebagai terbaca';
    } else {
        $_SESSION['flash_error'] = 'Gagal mengupdate status pesan: ' . mysqli_error($koneksi);
    }
    
    header('Location: blog.php');
    exit;
}

// Query untuk mengambil pesan
$query = "SELECT * FROM pesan WHERE penerima = '$penerima' ORDER BY tanggal_kirim DESC";
$result = mysqli_query($koneksi, $query);

// Hitung total pesan
$total_pesan = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk - SMK MW9</title>
    
    <!-- Impor CSS yang sama dengan tema utama -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #101010;
            --bg-card: #1a1a1a;
            --text-light: #f0f0f0;
            --purple: #9b59b6;
            --pink: #e91e63;
            --font-heading: 'Poppins', sans-serif;
            --font-body: 'Lato', sans-serif;
        }
        
        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: var(--font-body);
            line-height: 1.7;
            padding: 0;
            margin: 0;
        }
        
        .pesan-container {
            max-width: 1000px;
            margin: 80px auto 40px;
            padding: 20px;
        }
        
        .pesan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .pesan-title {
            font-family: var(--font-heading);
            font-size: 2.2rem;
            color: var(--text-light);
            margin: 0;
        }
        
        .pesan-count {
            background: linear-gradient(45deg, var(--pink), var(--purple));
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .pesan-item {
            background-color: var(--bg-card);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid #2f2f2f;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        
        .pesan-item:hover {
            transform: translateY(-5px);
        }
        
        .pesan-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #444;
        }
        
        .pesan-pengirim {
            font-weight: bold;
            color: var(--purple);
        }
        
        .pesan-tanggal {
            color: #aaa;
            font-size: 0.9rem;
        }
        
        .pesan-judul {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--text-light);
        }
        
        .pesan-isi {
            margin-bottom: 15px;
            line-height: 1.8;
        }
        
        .pesan-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .pesan-status {
            font-style: italic;
            color: #777;
        }
        
        .pesan-status.terkirim {
            color: var(--pink);
        }
        
        .pesan-status.terbaca {
            color: #2ecc71;
        }
        
        .pesan-actions .btn {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-mark {
            background: linear-gradient(45deg, var(--purple), var(--pink));
            color: white;
            border: none;
        }
        
        .btn-mark:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(155, 89, 182, 0.4);
        }
        
        .no-pesan {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: #777;
        }
        
        /* Flash message styling */
        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            z-index: 1000;
            animation: slideIn 0.5s, fadeOut 0.5s 2.5s forwards;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .flash-success {
            background-color: #27ae60;
        }
        
        .flash-error {
            background-color: #e74c3c;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes fadeOut {
            to { opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Header Navigasi -->
    <header>
        <nav>
            <a href="../index.php?page=dashboard" class="logo">SMK MW9</a>
            <ul>
                <li><a href="../index.php?page=dashboard">Dashboard</a></li>
                <li><a href="../index.php?page=kontak">Kontak</a></li>
                <li><a href="blog.php" class="active">Pesan Masuk</a></li>
            </ul>
        </nav>
    </header>

    <div class="pesan-container">
        <div class="pesan-header">
            <h1 class="pesan-title">Pesan Masuk</h1>
            <span class="pesan-count"><?php echo $total_pesan; ?> Pesan</span>
        </div>
        
        <?php if(isset($_SESSION['flash_sukses'])): ?>
            <div class="flash-message flash-success">
                <?php echo $_SESSION['flash_sukses']; unset($_SESSION['flash_sukses']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['flash_error'])): ?>
            <div class="flash-message flash-error">
                <?php echo $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if($total_pesan > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="pesan-item rgb-shadow-box">
                    <div class="pesan-meta">
                        <span class="pesan-pengirim">
                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($row['pengirim']); ?>
                        </span>
                        <span class="pesan-tanggal">
                            <i class="far fa-clock"></i> <?php echo date('d M Y H:i', strtotime($row['tanggal_kirim'])); ?>
                        </span>
                    </div>
                    
                    <h3 class="pesan-judul"><?php echo htmlspecialchars($row['judul'] ?? '(Tidak ada judul)'); ?></h3>
                    
                    <div class="pesan-isi">
                        <?php echo nl2br(htmlspecialchars($row['isi'])); ?>
                    </div>
                    
                    <div class="pesan-footer">
                        <span class="pesan-status <?php echo $row['status']; ?>">
                            <i class="fas fa-<?php echo $row['status'] == 'terkirim' ? 'envelope' : 'envelope-open'; ?>"></i>
                            Status: <?php echo ucfirst($row['status']); ?>
                        </span>
                        
                        <div class="pesan-actions">
                            <?php if($row['status'] == 'terkirim'): ?>
                                <a href="?action=mark_as_read&id=<?php echo $row['id_pesan']; ?>" class="btn btn-mark">
                                    <i class="fas fa-check"></i> Tandai Sudah Dibaca
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-pesan rgb-shadow-box">
                <i class="far fa-envelope-open" style="font-size: 3rem; margin-bottom: 15px;"></i>
                <p>Belum ada pesan yang diterima</p>
                <a href="../index.php?page=kontak" class="btn btn-mark">Kirim Pesan Pertama</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Script untuk animasi flash message -->
    <script>
        // Auto close flash message setelah 3 detik
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.display = 'none';
                }, 3000);
            });
        });
    </script>
</body>
</html>