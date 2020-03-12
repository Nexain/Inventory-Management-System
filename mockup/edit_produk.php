<?php
  // periksa apakah user sudah login, cek kehadiran session name 
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }
 
  // buka koneksi dengan MySQL
  include("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sistem Inventory Evermose</title>
  <link href="style.css" rel="stylesheet" >
  <link rel="icon" href="favicon.png" type="image/png" >
</head>
<body>
<div class="container">
<div id="header">
<h1>
Hello World
</h1>
</div>
  <nav>
  <ul>
    <li><a href="tampil_produk.php">Tampil</a></li>
    <li><a href="tambah_produk.php">Tambah</a>
    <li><a href="edit_produk.php">Edit</a>
    <li><a href="hapus_produk.php">Hapus</a></li>
    <li><a href="logout.php">Logout</a>
  </ul>
  </nav>
  <form id="search" action="tampil_produk.php" method="get">
    <p>
      <label for="id_produk">Nama : </label> 
      <input type="text" name="nama_produk" id="nama_produk" placeholder="search..." >
      <input type="submit" name="submit" value="Search">
    </p>
  </form>
<h2>Edit Data Produk</h2>
<?php
  // tampilkan pesan jika ada
  if ((isset($_GET["pesan"]))) {
      echo "<div class=\"pesan\">{$_GET["pesan"]}</div>";
  }
?>
 <table border="1">
  <tr>
  <th>ID Produk</th>
  <th>Nama Produk</th>
  <th>Jumlah</th>
  <th>Aksi</th>
  </tr>
  <?php
  // buat query untuk menampilkan seluruh data tabel produk
  $baris = 10;
  $page = isset($_GET["baris"]) ? (int)$_GET["baris"] : 1;
  $mulai = ($page>1) ? ($page * $baris) - $baris : 0;

  $query = "SELECT * FROM produk ORDER BY nama_produk ASC LIMIT $mulai,$baris";
  $result = mysqli_query($link, $query);
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$baris);

  if(!$result){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  
  //buat perulangan untuk element tabel dari data produk
  while($data = mysqli_fetch_assoc($result))
  {
    echo "<tr>";
    echo "<td>$data[id_produk]</td>";
    echo "<td>$data[nama_produk]</td>";
    echo "<td>$data[quantity]</td>";
    echo "<td>";
    ?>
      <form action="form_edit.php" method="post" >
      <input type="hidden" name="id_produk" value="<?php echo "$data[id_produk]"; ?>" >
      <input type="submit" name="submit" value="Edit" >
      </form>
    <?php
    echo "</td>";
    echo "</tr>";
  }
  
  // bebaskan memory 
  mysqli_free_result($result);
  
  // tutup koneksi dengan database mysql
  mysqli_close($link);
  ?>
  </table>
<div id="paging">
  <?php for ($i=1; $i<=$pages ; $i++){ ?>
  <p>Page: 
  <a href="?baris=<?php echo $i; ?>"><?php echo $i; ?></a> 
  </p>
  <?php } ?>
</div>
</div>
</body>
</html>