<?php
// Sertakan file koneksi database
include 'koneksi.php';

// Query untuk mengambil data dari tabel classes
$query = "SELECT * FROM classes ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas Online</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Kelas Online</h1>
        <p class="text-center">Pilih kelas yang tersedia dan daftar sekarang!</p>

        <!-- Tombol Akses Halaman Admin dan Pimpinan -->
        <div class="d-flex justify-content-end mb-4">
            <a href="admin.php" class="btn btn-secondary me-2">Admin</a>
            <a href="pimpinan.php" class="btn btn-secondary">Pimpinan</a>
        </div>

        <!-- Tabel Data Kelas -->
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Deskripsi</th>
                        <th>Jadwal</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1; // Nomor urut
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>{$row['class_name']}</td>";
                        echo "<td>{$row['description']}</td>";
                        echo "<td>" . date('d-m-Y H:i', strtotime($row['schedule'])) . "</td>";
                        echo "<td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>";
                        echo "<td><a href='form.php?class_id={$row['class_id']}' class='btn btn-primary'>Daftar</a></td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning mt-4" role="alert">
                Tidak ada kelas yang tersedia saat ini.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
