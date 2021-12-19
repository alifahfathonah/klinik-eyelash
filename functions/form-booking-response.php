	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
			$(".select2").select2({});
		});
	</script>
	<style type="text/css">
		.select2-container {
			z-index: 99999;
		}
	</style>
	<?php
	include "../model/db.php";

	if ($_POST['jenis_customer'] == 'customer_lama') { ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Nama Customer</label>
					<select name="nama" id="pilih_nama" class="form-control select2" required="">
						<optgroup label="Customer">
							<option value="0" disabled selected>-- Pilih Salah Satu --</option>
							<?php
							$query = mysqli_query($link, "SELECT * FROM tbl_customer WHERE status = 1");
							foreach ($query as $data_customer) { ?>
								<option value="<?= $data_customer['kode_customer']; ?>"> <?= $data_customer['nama_customer'] . ' - ' . $data_customer['no_telp']; ?></option>
							<?php } ?>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div id="customer"></div>
			</div>
		</div>

	<?php } else if ($_POST['jenis_customer'] == 'customer_tanya') { ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Nama Customer</label>
					<select name="nama" id="pilih_nama" class="form-control select2" required="">
						<optgroup label="Customer Tanya">
							<option value="0" disabled selected>-- Pilih Salah Satu --</option>
							<?php
							$query = mysqli_query($link, "SELECT * FROM tbl_customer WHERE status = 2");
							foreach ($query as $data_customer) { ?>
								<option value="<?= $data_customer['kode_customer']; ?>"> <?= $data_customer['nama_customer'].' - '.$data_customer['no_telp']; ?></option>
							<?php } ?>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div id="customer"></div>
			</div>
		</div>
	<?php } else if ($_POST['jenis_customer'] == 'customer_baru') { ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label>Nama Customer</label>
					<input type="text" name="nama" class="form-control" id="title" required="">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Nomor Whatsapp</label>
					<input type="text" name="no_telp" class="form-control" id="no_telp" required="">
					<div id="user-availability-status"></div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir">
				</div>
			</div>
		</div>
	<?php } ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#no_telp').change(function() {
				var no_telp = document.getElementById("no_telp").value;
				console.log(no_telp);

				$.ajax({
					type: 'POST',
					url: 'functions/check_nohp.php',
					data: {
						'no_telp': no_telp,
					},

					success: function(response) {
						// console.log(response);
						if (response == "true") {
							var hasil = '<span class="status-not-available" style="color: #ff4757"> No HP Sudah Digunakan</span>';
							$('#user-availability-status').html(hasil);
							$('#submitData').html('<button type="submit" name="submit" class="btn btn-primary" disabled>Simpan</button>');
						} else if (response == "false") {
							var alert = "'Anda yakin data sudah benar?'";
							var hasil2 = '<span class="status-available" style="color: #23ad5c"> No HP Bisa Dipakai </span>';
							$('#user-availability-status').html(hasil2);
							$('#submitData').html('<button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('+alert+')">Simpan</button>');
						} else {

						}
					}
				});
			})
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#pilih_nama').change(function() {
				var pilih_nama = document.getElementById("pilih_nama").value;
				// console.log(id_cabang);

				$.ajax({
					type: 'POST',
					url: 'functions/pilih-customer.php',
					data: {
						'pilih_nama': pilih_nama,
					},

					success: function(response) {
						$('#customer').html(response);
					}
				});
			})
		});
	</script>