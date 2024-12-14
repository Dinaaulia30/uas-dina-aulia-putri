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

// Menyimpan data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$email = $_POST['email'];
$nomor_telepon = $_POST['nomor_telepon'];
$alamat = $_POST['alamat'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
$foto_diri = $_FILES['foto_diri']['name'];
$keahlian = $_POST['keahlian'];

// Menyimpan foto
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["foto_diri"]["name"]);
move_uploaded_file($_FILES["foto_diri"]["tmp_name"], $target_file);

// Query untuk memasukkan data ke tabel pendaftaran
$sql = "INSERT INTO pendaftaran (nama_lengkap, email, nomor_telepon, alamat, tanggal_lahir, jenis_kelamin, pendidikan_terakhir, foto_diri, keahlian)
VALUES ('$nama_lengkap', '$email', '$nomor_telepon', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$pendidikan_terakhir', '$foto_diri', '$keahlian')";

// Mengeksekusi query
if ($conn->query($sql) === TRUE) {
    // Tampilkan pesan berhasil
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pendaftaran Berhasil</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-success text-center" role="alert">
                <h4 class="alert-heading">Pendaftaran Berhasil!</h4>
                <p>Selamat, Anda telah berhasil terdaftar. Terima kasih telah mendaftar di platform kami.</p>
                <hr>
                <p class="mb-0">Anda akan segera diarahkan ke halaman utama atau Anda dapat kembali ke <a href="index.php" class="alert-link">halaman utama</a>.</p>
            </div>
        </div>
    </body>
    </html>';
} else {
    // Tampilkan pesan kesalahan
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pendaftaran Gagal</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-danger text-center" role="alert">
                <h4 class="alert-heading">Pendaftaran Gagal!</h4>
                <p>Terjadi kesalahan saat proses pendaftaran. Silakan coba lagi.</p>
                <hr>
                <p class="mb-0">Jika masalah berlanjut, hubungi admin atau coba kembali di <a href="index.php" class="alert-link">halaman utama</a>.</p>
            </div>
        </div>
    </body>
    </html>';
}

// Menutup koneksi
$conn->close();
?>
