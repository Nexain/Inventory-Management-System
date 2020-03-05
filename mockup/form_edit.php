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
    // form telah disubmit, cek apakah berasal dari edit_produk.php 
    // atau update data dari form_edit.php
    
    if ($_POST["submit"]=="Edit") {
      //nilai form berasal dari halaman edit_produk.php
    
      // ambil nilai nim 
      $id_produk = htmlentities(strip_tags(trim($_POST["id_produk"])));
      // filter data
      $id_produk = mysqli_real_escape_string($link,$id_produk);
    
      // ambil semua data dari database untuk menjadi nilai awal form
      $query = "SELECT * FROM produk WHERE id_produk='$id_produk'";
      $result = mysqli_query($link, $query);
    
      if(!$result){
        die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
      }
    
      // tidak perlu pakai perulangan while, karena hanya ada 1 record
      $data = mysqli_fetch_assoc($result);    
       
      $nama_produk = $data["nama_produk"];
      $quantity = $data["quantity"];
    
    // bebaskan memory 
    mysqli_free_result($result);
    }
    
    else if ($_POST["submit"]=="Update Data") {
      // nilai form berasal dari halaman form_edit.php    
      // ambil nilai form 
      $id_produk = htmlentities(strip_tags(trim($_POST["id_produk"])));
      $nama_produk = htmlentities(strip_tags(trim($_POST["nama_produk"])));
      $quantity = htmlentities(strip_tags(trim($_POST["quantity"])));
    }

    // proses validasi form
    // siapkan variabel untuk menampung pesan error
    $pesan_error="";
    
    // cek apakah "nim" sudah diisi atau tidak
    if (empty($id_produk)) {
      $pesan_error .= "ID Produk belum diisi <br>";
    }
   // NIM harus angka dengan 6 digit
    elseif (!preg_match("/^[0-9]{6}$/",$id_produk) ) {
      $pesan_error .= "ID Produk harus berupa 6 digit angka <br>";
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
    if (($pesan_error === "") AND ($_POST["submit"]=="Update Data")) {
      
      // buka koneksi dengan MySQL
      include("connection.php");
      
      // filter semua data
      $id_produk = mysqli_real_escape_string($link,$id_produk);
      $nama_produk = mysqli_real_escape_string($link,$nama_produk );
      $quantity = mysqli_real_escape_string($link,$quantity);
      
      //buat dan jalankan query UPDATE
      $query  = "UPDATE produk SET ";
      $query .= "nama_produk = '$nama_produk', quantity = '$quantity' ";
      $query .= "WHERE id_produk = '$id_produk'";
      
      $result = mysqli_query($link, $query);

      //periksa hasil query
      if($result) {
      // INSERT berhasil, redirect ke tampil_produk.php + pesan
        $pesan = "Produk dengan nama = \"<b>$nama_produk</b>\" sudah berhasil di update";
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
    // form diakses secara langsung! 
    // redirect ke edit_produk.php
    header("Location: edit_produk.php");
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
  // tampilkan error jika ada
  if ($pesan_error !== "") {
      echo "<div class=\"error\">$pesan_error</div>";
  }
?>
<form id="form_produk" action="form_edit.php" method="post">
<fieldset>
<legend>Produk Baru</legend>
  <p>
    <label for="id_produk">ID Produk : </label> 
    <input type="text" name="id_produk" id="id_produk" value="<?php echo $id_produk ?>" readonly>
    (tidak bisa diubah di menu edit)
  </p>
  <p>
    <label for="nama_produk">Nama : </label> 
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
    <input type="submit" name="submit" value="Update Data">
  </p>
</form> 

</div>

</body>
</html>
<?php
  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>