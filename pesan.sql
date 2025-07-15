CREATE TABLE pesan (
    id_pesan INT AUTO_INCREMENT PRIMARY KEY,
    pengirim VARCHAR(100) NOT NULL,
    penerima VARCHAR(100) NOT NULL,
    judul VARCHAR(255),
    isi TEXT NOT NULL,
    tanggal_kirim DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('terkirim', 'terbaca') DEFAULT 'terkirim'
);
