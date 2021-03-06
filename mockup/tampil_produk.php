<?php
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
    $query  = "SELECT * FROM warehouse_log WHERE products.PRODUCT_NAME LIKE '%$nama_produk%' ";
    $query .= "ORDER BY nama_produk ASC LIMIT $mulai,$baris";

    // buat pesan
    $pesan = "Hasil pencarian untuk nama <b>\"$nama_produk\" </b>:";
  } 
  else {
  // bukan dari form pencairan
  // siapkan query untuk menampilkan seluruh data dari tabel produk
    $query = "SELECT * FROM warehouse_log ORDER BY TAG_ID LIMIT $mulai,$baris";
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
<h1>
Hello World
</h1>
</div>
  <nav>
  <ul>
    <li><a href="tampil_produk.php">Log Produk</a></li>
    <li><a href="lokasi_produk.php">Produk per Lokasi</a>
    <li><a href="all_produk.php">Semua Produk</a>
    <li><a href="new_produk.php">New Produk</a>
  </ul>
  </nav>
  <form id="search" action="tampil_produk.php" method="get">
    <p>
      <label for="id_produk">Nama : </label> 
      <input type="text" name="nama_produk" id="nama_produk" placeholder="masih tahap maintain... " >
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
  <th>Tag ID</th>
  <th>ID Produk</th>
  <th>Warehouse ID</th>
  <th>Tanggal Masuk</th>
  <th>Tanggal Keluar</th>
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
    echo "<td>$data[TAG_ID]</td>";
    echo "<td>$data[PRODUCT_ID]</td>";
    echo "<td>$data[WH_ID]</td>";
    echo "<td>$data[DATE_IN]</td>";
    echo "<td>$data[DATE_OUT]</td>";
    echo "</tr>";
  }
  
  // bebaskan memory 
  mysqli_free_result($result);
  
  // tutup koneksi dengan database mysql
  mysqli_close($link);
  ?>
</table>

<div id="paging">
  <p>Page:
  <?php for ($i=0; $i<=$pages; $i++){ ?>
  <a href="?baris=<?php echo $i+1; ?>"><?php echo $i+1; ?></a> 
  <?php } ?>
  </p>
</div>
</div>
</body>
</html>