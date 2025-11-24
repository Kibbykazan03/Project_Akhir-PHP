  <?php include 'config.php'; ?>
  <!DOCTYPE html>
  <html lang="id">
  <head>
      <meta charset="UTF-8">
      <title>Sistem Manajemen Buku</title>
      <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
      <h1>Daftar Buku</h1>
      <a href="tambah.php">Tambah Buku</a>
      <table id="bukuTable">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Tahun</th>
                  <th>Genre</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
              <?php
              $result = $conn->query("SELECT * FROM buku");
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['judul']}</td>
                          <td>{$row['penulis']}</td>
                          <td>{$row['tahun']}</td>
                          <td>{$row['genre']}</td>
                          <td>
                              <a href='edit.php?id={$row['id']}'>Edit</a> |
                              <a href='hapus.php?id={$row['id']}' onclick='return confirm(\"Hapus?\")'>Hapus</a>
                          </td>
                        </tr>";
              }
              ?>
          </tbody>
      </table>
      <script src="assets/js/script.js"></script>
  </body>
  </html>
  