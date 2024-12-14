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

// Set header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Pendaftaran.xls");

// Membuat header kolom
echo "No\tNama Lengkap\tEmail\tNomor Telepon\tAlamat\tTanggal Lahir\tJenis Kelamin\tPendidikan Terakhir\tKeahlian\n";

if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        echo $no++ . "\t" .
            $row['nama_lengkap'] . "\t" .
            $row['email'] . "\t" .
            $row['nomor_telepon'] . "\t" .
            $row['alamat'] . "\t" .
            $row['tanggal_lahir'] . "\t" .
            $row['jenis_kelamin'] . "\t" .
            $row['pendidikan_terakhir'] . "\t" .
            $row['keahlian'] . "\n";
    }
} else {
    echo "Tidak ada data\n";
}

$conn->close();
?>
