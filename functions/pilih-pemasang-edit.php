<?php 
include ("../model/db.php");

$tanggal_sekarang = date('Y-m-d');
$tanggal = $_POST['tanggal'];
// var_dump($tanggal);
$daftar_hari = array(
	'Sunday' => 'Minggu',
	'Monday' => 'Senin',
	'Tuesday' => 'Selasa',
	'Wednesday' => 'Rabu',
	'Thursday' => 'Kamis',
	'Friday' => 'Jumat',
	'Saturday' => 'Sabtu'
);
$date=date('Y/m/d');
$namahari = date('l', strtotime($tanggal));
$id_jabatan = $_POST['id_jabatan'];

// GET id_cabang
$cabang = $_POST['id_cabang'];
$query = mysqli_query($link, "SELECT a.*, b.*, c.*, FROM tbl_status_kerja a JOIN users b ON a.id_users = b.id_users JOIN tbl_cabang c ON a.cabang = c.id_cabang WHERE a.cabang = '$cabang' AND b.level = '2' AND hari_libur != '$daftar_hari[$namahari]' AND a.id_jabatan = '$id_jabatan'");

echo '<select name="id_users" class="form-control" id="id_users" required="">
		';
foreach ($query as $data) { ?>
	<option value="<?= $data['id_users'] ?>" <?php if($data['id_users'] == $data['users_e']) { echo 'selected'; }?> ><?= $data['username'] ?> </option>
<?php }
echo '</select>';
?>