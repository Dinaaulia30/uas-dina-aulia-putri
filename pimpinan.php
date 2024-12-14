<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pendaftarankelasonline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari database
$sql = "SELECT * FROM pendaftaran";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pimpinan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Laporan Pendaftaran</h1>
        <div class="mb-3">
            <a href="download_excel.php" class="btn btn-success">Download Excel</a>
            <button class="btn btn-primary" onclick="window.print()">Cetak Laporan</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Pendidikan Terakhir</th>
                    <th>Keahlian</th>
                    <th>Foto Diri</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $no++ . "</td>
                            <td>" . $row['nama_lengkap'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['nomor_telepon'] . "</td>
                            <td>" . $row['alamat'] . "</td>
                            <td>" . $row['tanggal_lahir'] . "</td>
                            <td>" . $row['jenis_kelamin'] . "</td>
                            <td>" . $row['pendidikan_terakhir'] . "</td>
                            <td>" . $row['keahlian'] . "</td>
                            <td><img src='uploads/" . $row['foto_diri'] . "' width='100'></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
