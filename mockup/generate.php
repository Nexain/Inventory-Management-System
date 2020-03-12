<?php
  // buat koneksi dengan database mysql
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $link = mysqli_connect($dbhost,$dbuser,$dbpass);
  
  //periksa koneksi, tampilkan pesan kesalahan jika gagal
  if(!$link){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
         " - ".mysqli_connect_error());
  }
  
  //buat database evermose jika belum ada
  $query = "CREATE DATABASE IF NOT EXISTS evermose";
  $result = mysqli_query($link, $query);
  
  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Database <b>'evermose'</b> berhasil dibuat... <br>";
  }
  
  //pilih database evermose
  $result = mysqli_select_db($link, "evermose");
  
  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Database <b>'evermose'</b> berhasil dipilih... <br>";
  }
 
  // cek apakah tabel produk sudah ada. jika ada, hapus tabel
  $query = "DROP TABLE IF EXISTS produk";
  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'produk'</b> berhasil dihapus... <br>";
  }
  
  // buat query untuk CREATE tabel produk
  $query  = "CREATE TABLE produk (id_produk CHAR(8), nama_produk VARCHAR(100), "; 
  $query .= "quantity INT, PRIMARY KEY (id_produk))";

  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'produk'</b> berhasil dibuat... <br>";
  }
  
  // buat query untuk INSERT data ke tabel produk
  $query  = "INSERT INTO produk VALUES "; 
  $query .= "('000001', 'Hijab Rabbani', '100'),";
  $query .= "('000002', 'Baju Rabbani', '200'),";
  $query .= "('000003', 'Celana Rabbani', '300'),";
  $query .= "('000004', 'Rok Rabbani', '400'),";
  $query .= "('000005', 'Sendal Rabbani', '500')";

  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'produk'</b> berhasil diisi... <br>";
  }
    
  // cek apakah tabel admin sudah ada. jika ada, hapus tabel
  $query = "DROP TABLE IF EXISTS admin";
  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dihapus... <br>";
  }
  
  // buat query untuk CREATE tabel admin
  $query  = "CREATE TABLE admin (username VARCHAR(50), password CHAR(40))"; 
  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dibuat... <br>";
  }
  
  // buat username dan password untuk admin
  $username = "admin123";
  $password = sha1("rahasia");
  
  // buat query untuk INSERT data ke tabel admin
  $query  = "INSERT INTO admin VALUES ('$username','$password')"; 

  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil diisi... <br>";
  }
  
  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>