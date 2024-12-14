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

// Menarik data pendaftar
$query = "SELECT * FROM pendaftaran";
$results = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - Data Pendaftar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Halaman Admin - Data Pendaftar</h1>

        <!-- Tabel Daftar Pendaftar -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Foto Diri</th>
                        <th>Keahlian</th>
                        <th>Aksi</th> <!-- Kolom Aksi -->
                    </tr>
                </thead>
                <tbody>
                    <?php if ($results->num_rows > 0): ?>
                        <?php $no = 1; ?>
                        <?php while($row = $results->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['nomor_telepon']); ?></td>
                                <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                <td><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
                                <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                <td><?php echo htmlspecialchars($row['pendidikan_terakhir']); ?></td>
                                <td><img src="uploads/<?php echo htmlspecialchars($row['foto_diri']); ?>" width="100" alt="Foto Diri"></td>
                                <td><?php echo htmlspecialchars($row['keahlian']); ?></td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="edit_pendaftaran.php?id=<?php echo $row['pendaftaran_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <!-- Tombol Hapus -->
                                    <a href="hapus_pendaftaran.php?id=<?php echo $row['pendaftaran_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">Tidak ada data pendaftar.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Kembali ke halaman utama -->
        <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
