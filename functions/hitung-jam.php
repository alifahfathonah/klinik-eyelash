<?php 

// include database connection file
include ("../model/db.php");

$start_jam = $_POST['start_jam'];
$hasil = $start_jam;


echo '<input type="date" name="tgl_retouch" class="form-control" id="tgl_retouch" placeholder="Title" required="" value="'.$retouch.'">';
// while ($hasil = mysqli_fetch_array($query)) {
// 	echo '<option value="'.$hasil['id_produk'].'">'.$hasil['waktu_pemasangan'].'</option>';
// }


	
