<?php
  // periksa apakah user sudah login, cek kehadiran session name 
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }
  
  // buka koneksi dengan MySQL
  include("connection.php");
  
  // cek apakah form telah di submit
  if (isset($_POST["submit"])) {
    // form telah disubmit, proses data
    
    // ambil semua nilai form
    $id_produk = htmlentities(strip_tags(trim($_POST["id_produk"])));
    $nama_produk = htmlentities(strip_tags(trim($_POST["nama_produk"])));
    $quantity = htmlentities(strip_tags(trim($_POST["quantity"])));
    
    // siapkan variabel untuk menampung pesan error
    $pesan_error="";
    
    // cek apakah "id_produk" sudah diisi atau tidak
    if (empty($id_produk)) {
      $pesan_error .= "ID Produk belum diisi <br>";
    }
    // id_produk harus angka dengan 6 digit
    elseif (!preg_match("/^[0-9]{6}$/",$id_produk) ) {
      $pesan_error .= "ID Produk harus berupa 6 digit angka <br>";
    }
    
    // cek ke database, apakah sudah ada nomor id_produk yang sama    
    // filter data $id_produk
    $id_produk = mysqli_real_escape_string($link,$id_produk);
    $query = "SELECT * FROM produk WHERE id_produk='$id_produk'";
    $hasil_query = mysqli_query($link, $query);
  
    // cek jumlah record (baris), jika ada, $id_produk tidak bisa diproses
    $jumlah_data = mysqli_num_rows($hasil_query);
     if ($jumlah_data >= 1 ) {
       $pesan_error .= "id_produk yang sama sudah digunakan <br>";  
    }

    // cek apakah "nama" sudah diisi atau tidak
    if (empty($nama_produk)) {
      $pesan_error .= "Nama Produk belum diisi <br>";
    }
    
    // cek apakah "tempat lahir" sudah diisi atau tidak
    if (empty($quantity)) {
      $pesan_error .= "Jumlah belum diisi <br>";
    }
    
    // jika tidak ada error, input ke database
    if ($pesan_error === "") {
      
      // filter semua data
      $id_produk = mysqli_real_escape_string($link,$id_produk);
      $nama_produk = mysqli_real_escape_string($link,$nama_produk );
      $quantity = mysqli_real_escape_string($link,$quantity);
      
      
      //buat dan jalankan query INSERT
      $query = "INSERT INTO produk VALUES ";
      $query .= "('$id_produk', '$nama_produk', '$quantity') ";

      $result = mysqli_query($link, $query);
      
      //periksa hasil query
      if($result) {
      // INSERT berhasil, redirect ke tampil_produk.php + pesan
        $pesan = "Produk dengan nama = \"<b>$nama_produk</b>\" sudah berhasil di tambah";
        $pesan = urlencode($pesan);
        header("Location: tampil_produk.php?pesan={$pesan}");
      } 
      else { 
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
      }    
    }
  }
  else {
    // form belum disubmit atau halaman ini tampil untuk pertama kali 
    // berikan nilai awal untuk semua isian form
    $pesan_error = "";
    $id_produk = "";
    $nama_produk = "";
    $quantity = "";
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
<h2>Tambah Data Produk</h2>
<?php
  // tampilkan error jika ada
  if ($pesan_error !== "") {
      echo "<div class=\"error\">$pesan_error</div>";
  }
?>
<form id="form_produk" action="tambah_produk.php" method="post">
<fieldset>
<legend>Produk Baru</legend>
  <p>
    <label for="id_produk">ID Produk : </label> 
    <input type="text" name="id_produk" id="id_produk" value="<?php echo $id_produk ?>"
    placeholder="Contoh: 123456">
    (6 digit angka)
  </p>
  <p>
    <label for="nama">Nama : </label> 
    <input type="text" name="nama_produk" id="nama_produk" value="<?php echo $nama_produk ?>">
  </p>
  <p>
    <label for="quantity">Jumlah : </label> 
    <input type="text" name="quantity" id="quantity" 
    value="<?php echo $quantity ?>">
  </p>
  
</fieldset>
  <br>
  <p>
    <input type="submit" name="submit" value="Tambah Data">
  </p>
</form> 
  
</div>

</body>
</html>
<?php
  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>