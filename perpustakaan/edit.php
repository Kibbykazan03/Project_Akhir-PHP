<?php
include 'config.php';  // Pastikan config.php ada dan koneksi berhasil

// Aktifkan error reporting untuk debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ambil ID dari URL (GET parameter)
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID buku tidak valid.");
}
$id = intval($_GET['id']);

// Ambil data buku dari database
$stmt = $conn->prepare("SELECT * FROM buku WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Buku dengan ID $id tidak ditemukan.");
}
$row = $result->fetch_assoc();
$stmt->close();

// Jika form disubmit (POST), update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = trim($_POST['judul']);
    $penulis = trim($_POST['penulis']);
    $tahun = intval($_POST['tahun']);
    $genre = trim($_POST['genre']);

    // Validasi sederhana
    if (empty($judul) || empty($penulis)) {
        echo "<p style='color:red;'>Judul dan Penulis wajib diisi!</p>";
    } else {
        // Update database dengan prepared statement
        $stmt = $conn->prepare("UPDATE buku SET judul = ?, penulis = ?, tahun = ?, genre = ? WHERE id = ?");
        $stmt->bind_param("ssisi", $judul, $penulis, $tahun, $genre, $id);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>Buku berhasil diupdate!</p>";
            header("Location: index.php");  // Redirect ke halaman utama
            exit();
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="assets/css/style.css">  <!-- Pastikan file CSS ada -->
</head>
<body>
    <h1>Edit Buku</h1>
    <form id="formEdit" action="" method="POST">
        <label>Judul:</label>
        <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($row['judul']); ?>" required><br><br>
        
        <label>Penulis:</label>
        <input type="text" name="penulis" value="<?php echo htmlspecialchars($row['penulis']); ?>" required><br><br>
        
        <label>Tahun:</label>
        <input type="number" name="tahun" value="<?php echo htmlspecialchars($row['tahun']); ?>"><br><br>
        
        <label>Genre:</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($row['genre']); ?>"><br><br>
        
        <button type="submit">Update Buku</button>
        <a href="index.php">Kembali</a>
    </form>
    <script src="assets/js/script.js"></script>  <!-- Jika ada validasi JS -->
</body>
</html>