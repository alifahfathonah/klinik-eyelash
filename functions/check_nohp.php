<?php
include "../model/db.php";
$no_telp = $_POST['no_telp'];
$query = mysqli_query($link, "SELECT * FROM tbl_customer WHERE no_telp = '$no_telp'");
$data = mysqli_fetch_array($query);

$count = mysqli_num_rows($query);
  if($count>0) {
      echo '<span class="status-not-available" style="color: #ff4757"> No HP Sudah Digunakan</span>';
  }else{
      echo '<span class="status-available" style="color: #23ad5c"> No HP Bisa Dipakai </span>';
  }
?>

