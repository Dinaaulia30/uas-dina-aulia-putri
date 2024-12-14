<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pendaftarankelasonline"; // ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data pendaftar sebelum menghapus
    $sql = "SELECT foto_diri FROM pendaftaran WHERE pendaftaran_id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Hapus file foto jika ada
    if ($row['foto_diri']) {
        unlink("uploads/" . $row['foto_diri']);
    }

    // Hapus data dari database
    $delete_sql = "DELETE FROM pendaftaran WHERE pendaftaran_id = $id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Data berhasil dihapus!";
        echo '<br><a href="admin.php" class="btn btn-primary">Kembali ke Admin</a>';
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}

$conn->close();
?>
