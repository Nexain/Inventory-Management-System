<?php
  // periksa apakah user sudah login, cek kehadiran session name 
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }

  // buka koneksi dengan MySQL
     include("connection.php");
  
  // ambil pesan jika ada  
  if (isset($_GET["pesan"])) {
      $pesan = $_GET["pesan"];
  }
      
  $baris = 10;
  $page = isset($_GET["baris"]) ? (int)$_GET["baris"] : 1;
  $mulai = ($page>1) ? ($page * $baris) - $baris : 0;

  // cek apakah form telah di submit
  // berasal dari form pencairan, siapkan query 
  if (isset($_GET["submit"])) {
      
    // ambil nilai nama
    $nama_produk = htmlentities(strip_tags(trim($_GET["nama_produk"])));
    
    // filter untuk $nama untuk mencegah sql injection
    $nama_produk = mysqli_real_escape_string($link,$nama_produk);
    
    // buat query pencarian
    $query  = "SELECT * FROM produk WHERE nama_produk LIKE '%$nama_produk%' ";
    $query .= "ORDER BY nama_produk ASC LIMIT $mulai,$baris";

    // buat pesan
    $pesan = "Hasil pencarian untuk nama <b>\"$nama_produk\" </b>:";
  } 
  else {
  // bukan dari form pencairan
  // siapkan query untuk menampilkan seluruh data dari tabel produk
    $query = "SELECT * FROM produk ORDER BY nama_produk LIMIT $mulai,$baris";
    }
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
<h2>Data Produk</h2>
<?php
  // tampilkan pesan jika ada
  if (isset($pesan)) {
      echo "<div class=\"pesan\">$pesan</div>";
  }
?>
 <table border="1">
  <tr>
  <th>ID Produk</th>
  <th>Nama Produk</th>
  <th>Jumlah</th>
  </tr>
  <?php
  // jalankan query
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