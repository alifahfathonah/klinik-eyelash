<?php 
include "../model/db.php";
if ($_POST['jenis_customer'] == 'customer_lama') { ?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Nama Customer</label>
				<select name="nama" id="pilih_nama" class="form-control" required="">
					<option value="0" disabled selected>-- PILIH SALAH SATU -- </option>
					<optgroup label="Customer">
						<?php
						$query = mysqli_query($link, "SELECT * FROM tbl_customer WHERE status = 1");
						foreach($query as $data_customer){ ?>
							<option value="<?= $data_customer['kode_customer']; ?>"> <?= $data_customer['nama_customer']; ?></option>
						<?php } ?>
					</optgroup>
					<optgroup label="Customer Tanya">
						<?php
						$query = mysqli_query($link, "SELECT * FROM tbl_customer WHERE status = 2");
						foreach($query as $data_customer){ ?>
							<option value="<?= $data_customer['kode_customer']; ?>"> <?= $data_customer['nama_customer']; ?></option>
						<?php } ?>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div id="customer"></div>
		</div>
	</div>
<?php } else if($_POST['jenis_customer'] == 'customer_baru') {?>
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