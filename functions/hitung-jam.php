<?php 

// include database connection file
include ("../model/db.php");

$start_jam = $_POST['start_jam'];

$hasil = strtotime($start_jam) + 60*60;
$time = date('H:i', $hasil);


echo '<input type="time" name="ends_jam" class="form-control" id="ends_jam" placeholder="Sampai Jam" required="" value="'.$time.'">';
// while ($hasil = mysqli_fetch_array($query)) {
// 	echo '<option value="'.$hasil['id_produk'].'">'.$hasil['waktu_pemasangan'].'</option>';
// }