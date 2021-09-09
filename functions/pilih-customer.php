<?php
$kode_customer = $_POST['nama'];
$query = mysqli_query($link, "SELECT * FROM tbl_customer WHERE kode_customer = '$kode_customer'");
$data = mysqli_fetch_array($query);
?>


<div class="col-sm-4">
	<div class="form-group">
		<label>Nomor Whatsapp</label>
		<input type="number" name="no_telp" class="form-control" id="no_telp" required="" value="<?= $data['no_telp'] ?>">
	</div>
</div>
<div class="col-sm-4">
	<div class="form-group">
		<label>Tanggal Lahir</label>
		<input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" value="<?= $data['tgl_lahir'] ?>">
	</div>
</div>