<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pendaftarankelasonline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah ID dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan. <a href='admin.php'>Kembali</a>");
}

$id = intval($_GET['id']);

// Ambil data berdasarkan ID
$sql = "SELECT * FROM pendaftaran WHERE pendaftaran_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Data tidak ditemukan. <a href='admin.php'>Kembali</a>");
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $update_sql = "UPDATE pendaftaran SET 
                    nama_lengkap = '$nama_lengkap', 
                    email = '$email', 
                    nomor_telepon = '$nomor_telepon' 
                    WHERE pendaftaran_id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success'>Data berhasil diperbarui. <a href='admin.php'>Kembali ke Admin</a></div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendaftaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Edit Pendaftaran</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?php echo $row['nomor_telepon']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="admin.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
<?php $conn->close();
?>