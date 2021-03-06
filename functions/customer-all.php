<?php 
include ("../model/db.php");

$jenis_data = $_POST['jenis_data_customer'];

if ($jenis_data == 'semua') { ?>
	<div class="dt-responsive table-responsive mt-5">
		<table id="user-list-table" class="table nowrap dataTable" role="grid" aria-describedby="user-list-table_info">
			<thead>
				<tr>
					<th>No</th>
					<th>Lokasi</th>
					<th>Pemasang</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Nama</th>
					<th>Jenis</th>
					<th>Tanggal Retouch</th>
					<th>Sumber</th>
					<th>Harga</th>
					<th>Transfer</th>
					<th>Cash</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$no = 1;
				$tgl = date('Y-m-d');
				$query = mysqli_query($link,"SELECT a.*, c.nama_cabang, b.username, e.nama_tipe, d.harga, f.*
					FROM events a 
					LEFT JOIN users b ON a.id_users = b.id_users
					LEFT JOIN tbl_cabang c ON a.id_cabang = c.id_cabang
					LEFT JOIN tbl_produk d ON a.id_produk = d.id_produk
					LEFT JOIN tbl_tipe e ON a.id_tipe = e.id_tipe
					LEFT JOIN tbl_customer f ON f.kode_customer = a.kode_customer
					ORDER BY f.kode_customer ASC");
				foreach ($query as $data) { 

					$daftar_hari = array(
						'Sunday' => 'Minggu',
						'Monday' => 'Senin',
						'Tuesday' => 'Selasa',
						'Wednesday' => 'Rabu',
						'Thursday' => 'Kamis',
						'Friday' => 'Jumat',
						'Saturday' => 'Sabtu'
					);

					$hari = date('l', strtotime($data['start']));
					$tanggal = date('d F Y', strtotime($data['start']));
					$tanggal_retouch = date('d F Y', strtotime($data['tgl_retouch']));
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['nama_cabang'] ?></td>
						<td><?php echo $data['username'] ?></td>
						<td><?php echo $daftar_hari[$hari] ?></td>
						<td><?php echo $tanggal ?></td>
						<td><?php echo $data['start_jam'] ?> - <?php echo $data['ends_jam'] ?></td>
						<td><?php echo $data['nama_customer'] ?></td>
						<td><?php echo $data['nama_tipe'] ?></td>
						<td><?php echo $tanggal_retouch ?></td>
						<td><?php echo $data['sumber'] ?></td>
						<td style="background: #4680ff;color: #fff;">Rp. <?php echo number_format( $data['harga'] ); ?></td>
						<td style="background: #9ccc65;color: #fff;">
							<?php if ($data['transfer'] == true) { ?>
								Rp. <?php echo number_format( $data['transfer'] ); ?>
							<?php }else{
								echo "-";
							} ?>
						</td>
						<td style="background: #9ccc65;color: #fff;">
							<?php if ($data['cash'] == true) { ?>
								Rp. <?php echo number_format( $data['cash'] ); ?>
							<?php }else{
								echo "-";
							} ?>
						</td>
						<td><?php echo $data['keterangan'] ?></td>
					</tr>

					<div class="modal fade" id="modal-edit-<?php echo $data['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Produk</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="functions/proses-produk" method="post">
										<div class="row">
											<div class="col-12 mb-3">
												<h5>Informasi Produk</h5>
											</div>
											<input type="hidden" name="id_produk" value="<?php echo $data['id_produk'] ?>">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="floating-label" for="Name">Nama Produk</label>
													<input type="text" name="nama_produk" value="<?php echo $data['nama_produk'] ?>" class="form-control" id="Name" placeholder="">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group fill">
													<label class="floating-label" for="Email">Harga Produk</label>
													<input type="number" name="harga" value="<?php echo $data['harga'] ?>" class="form-control" id="Harga" placeholder="">
												</div>
											</div>
											<div class="col-sm-12">
												<button type="submit" name="edit" class="btn btn-primary">Edit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Lokasi</th>
					<th>Pemasang</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Nama</th>
					<th>Jenis</th>
					<th>Tanggal Retouch</th>
					<th>Sumber</th>
					<th>Harga</th>
					<th>Transfer</th>
					<th>Cash</th>
					<th>Keterangan</th>
				</tr>
			</tfoot>
		</table>
	</div>
<?php } else if ($jenis_data == 'lunas') {  ?>
	<div class="dt-responsive table-responsive mt-5">
		<table id="user-list-table" class="table nowrap">
			<thead>
				<tr>
					<th>No</th>
					<th>Lokasi</th>
					<th>Pemasang</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Nama</th>
					<th>Jenis</th>
					<th>Tanggal Retouch</th>
					<th>Sumber</th>
					<th>Harga</th>
					<th>Transfer</th>
					<th>Cash</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$no = 1;
				$tgl = date('Y-m-d');
				$query = mysqli_query($link,"SELECT a.*, c.nama_cabang, b.username, e.nama_tipe, d.harga, f.*
					FROM events a 
					LEFT JOIN users b ON a.id_users = b.id_users
					LEFT JOIN tbl_cabang c ON a.id_cabang = c.id_cabang
					LEFT JOIN tbl_produk d ON a.id_produk = d.id_produk
					LEFT JOIN tbl_tipe e ON a.id_tipe = e.id_tipe
					LEFT JOIN tbl_customer f ON f.kode_customer = a.kode_customer
					WHERE a.harga - a.transfer - a.cash = 0
					AND a.start = '$tgl'
					AND f.status = 1
					ORDER BY a.start ASC");
				foreach ($query as $data) { 

					$daftar_hari = array(
						'Sunday' => 'Minggu',
						'Monday' => 'Senin',
						'Tuesday' => 'Selasa',
						'Wednesday' => 'Rabu',
						'Thursday' => 'Kamis',
						'Friday' => 'Jumat',
						'Saturday' => 'Sabtu'
					);

					$hari = date('l', strtotime($data['start']));
					$tanggal = date('d F Y', strtotime($data['start']));
					$tanggal_retouch = date('d F Y', strtotime($data['tgl_retouch']));
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['nama_cabang'] ?></td>
						<td><?php echo $data['username'] ?></td>
						<td><?php echo $daftar_hari[$hari] ?></td>
						<td><?php echo $tanggal ?></td>
						<td><?php echo $data['start_jam'] ?> - <?php echo $data['ends_jam'] ?></td>
						<td><?php echo $data['nama_customer'] ?></td>
						<td><?php echo $data['nama_tipe'] ?></td>
						<td><?php echo $tanggal_retouch ?></td>
						<td><?php echo $data['sumber'] ?></td>
						<td style="background: #4680ff;color: #fff;">Rp. <?php echo number_format( $data['harga'] ); ?></td>
						<td style="background: #9ccc65;color: #fff;">
							<?php if ($data['transfer'] == true) { ?>
								Rp. <?php echo number_format( $data['transfer'] ); ?>
							<?php }else{
								echo "-";
							} ?>
						</td>
						<td style="background: #9ccc65;color: #fff;">
							<?php if ($data['cash'] == true) { ?>
								Rp. <?php echo number_format( $data['cash'] ); ?>
							<?php }else{
								echo "-";
							} ?>
						</td>
						<td><?php echo $data['keterangan'] ?></td>
					</tr>

					<div class="modal fade" id="modal-edit-<?php echo $data['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Produk</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="functions/proses-produk" method="post">
										<div class="row">
											<div class="col-12 mb-3">
												<h5>Informasi Produk</h5>
											</div>
											<input type="hidden" name="id_produk" value="<?php echo $data['id_produk'] ?>">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="floating-label" for="Name">Nama Produk</label>
													<input type="text" name="nama_produk" value="<?php echo $data['nama_produk'] ?>" class="form-control" id="Name" placeholder="">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group fill">
													<label class="floating-label" for="Email">Harga Produk</label>
													<input type="number" name="harga" value="<?php echo $data['harga'] ?>" class="form-control" id="Harga" placeholder="">
												</div>
											</div>
											<div class="col-sm-12">
												<button type="submit" name="edit" class="btn btn-primary">Edit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Lokasi</th>
					<th>Pemasang</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Nama</th>
					<th>Jenis</th>
					<th>Tanggal Retouch</th>
					<th>Sumber</th>
					<th>Harga</th>
					<th>Transfer</th>
					<th>Cash</th>
					<th>Keterangan</th>
				</tr>
			</tfoot>
		</table>
	</div>
<?php } else if ($jenis_data == 'belum_lunas') {  ?>
	<div class="dt-responsive table-responsive">
		<table id="user-list-tablee" class="table nowrap">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Transfer</th>
					<th>Cash</th>
					<th>Yang Harus Di Bayar</th>
					<th>Metode Pembayaran</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$no = 1;
				$tgl = date('Y-m-d');
				$query = mysqli_query($link,"SELECT a.*, (a.harga - a.transfer - a.cash) as kurang, c.nama_cabang, b.username, e.nama_tipe, d.harga, f.*
					FROM events a 
					LEFT JOIN users b ON a.id_users = b.id_users
					LEFT JOIN tbl_cabang c ON a.id_cabang = c.id_cabang
					LEFT JOIN tbl_produk d ON a.id_produk = d.id_produk
					LEFT JOIN tbl_tipe e ON a.id_tipe = e.id_tipe
					LEFT JOIN tbl_customer f ON f.kode_customer = a.kode_customer
					WHERE a.harga - a.transfer - a.cash != 0
					AND a.start = '$tgl'
					AND f.status = 1
					ORDER BY a.start ASC");
				foreach ($query as $data) { 
					$daftar_hari = array(
						'Sunday' => 'Minggu',
						'Monday' => 'Senin',
						'Tuesday' => 'Selasa',
						'Wednesday' => 'Rabu',
						'Thursday' => 'Kamis',
						'Friday' => 'Jumat',
						'Saturday' => 'Sabtu'
					);

					$hari = date('l', strtotime($data['start']));
					$tanggal = date('d F Y', strtotime($data['start']));
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['nama_customer'] ?></td>
						<td>Rp. <?php echo number_format( $data['harga'] ); ?></td>
						<td>
							<?php if ($data['transfer'] == true) { ?>
								Rp. <?php echo number_format( $data['transfer'] ); ?>
							<?php }else{
								echo "-";
							} ?>
						</td>
						<td>
							<?php if ($data['cash'] == true) { ?>
								Rp. <?php echo number_format( $data['cash'] ); ?>
							<?php }else{
								echo "-";
							} ?>
						</td>
						<td style="background: #ff5252;color: #fff;">Rp. <?php echo number_format( $data['kurang'] ); ?></td>
						<td>
							<span class="badge badge-light-success"></span>
							<div class="overlay-edit">
								<button class="btn btn-success btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-transfer-<?php echo $data['kurang'] ?>">Transfer<span class="ripple ripple-animate"></span></button>

								<button class="btn btn-primary btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-cash-<?php echo $data['kurang'] ?>">Cash<span class="ripple ripple-animate"></span></button>
							</div>
						</td>
					</tr>

					<div class="modal fade" id="modal-transfer-<?php echo $data['kurang'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Pelunasan</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="functions/proses-pelunasan" method="post">
										<div class="row">
											<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
											<div class="col-sm-12">
												<div class="form-group">
													<label>Jumlah Pembayaran</label>
													<input type="text" name="transfer" value="<?php echo $data['kurang'] ?>" class="form-control" id="Name" placeholder="" readonly>
												</div>
											</div>
											<div class="col-sm-12">
												<button type="submit" name="bayar_trans" class="btn btn-primary">Bayar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="modal-cash-<?php echo $data['kurang'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Pelunasan</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="functions/proses-pelunasan" method="post">
										<div class="row">
											<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
											<div class="col-sm-12">
												<div class="form-group">
													<label>Jumlah Pembayaran</label>
													<input type="text" name="cash" value="<?php echo $data['kurang'] ?>" class="form-control" id="Name" placeholder="" readonly>
												</div>
											</div>
											<div class="col-sm-12">
												<button type="submit" name="bayar_cash" class="btn btn-primary">Bayar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Transfer</th>
					<th>Cash</th>
					<th>Yang Harus Di Bayar</th>
					<th>Metode Pembayaran</th>
				</tr>
			</tfoot>
		</table>
	</div>
<?php } else if ($jenis_data == 'retouch') {  ?>
	<div class="dt-responsive table-responsive">
		<table id="user-list-table-ret" class="table nowrap">
			<thead>
				<tr>
					<th>No</th>
					<th>Lokasi</th>
					<th>Pemasang</th>
					<th>Nama</th>
					<th>Tanggal Retouch</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$no = 1;
				$query = mysqli_query($link,"SELECT a.*, c.nama_cabang, b.username, e.nama_tipe, d.harga, f.*
					FROM events a 
					LEFT JOIN users b ON a.id_users = b.id_users
					LEFT JOIN tbl_cabang c ON a.id_cabang = c.id_cabang
					LEFT JOIN tbl_produk d ON a.id_produk = d.id_produk
					LEFT JOIN tbl_tipe e ON a.id_tipe = e.id_tipe
					LEFT JOIN tbl_customer f ON f.kode_customer = a.kode_customer
					ORDER BY a.start ASC");
				foreach ($query as $data) {
					$tanggal_retouch = date('d F Y', strtotime($data['tgl_retouch']));
					$date = date('Y-m-d');
					$retouch = date('Y-m-d', strtotime('-3 days', strtotime($data['tgl_retouch'])));

					?>
					<?php if ($date == $retouch) { ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['nama_cabang'] ?></td>
							<td><?php echo $data['username'] ?></td>
							<td><?php echo $data['nama_customer'] ?></td>
							<td><?php echo $tanggal_retouch ?></td>
							<td>
								<span class="badge badge-light-success"></span>
								<div class="overlay-edit">
									<button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_produk'] ?>"><i class="fab fa-whatsapp"></i></button>
								</div>
							</td>
						</tr>
					<?php }else{
						echo "";
					} ?>

				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Lokasi</th>
					<th>Pemasang</th>
					<th>Nama</th>
					<th>Tanggal Retouch</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
<?php } else if ($jenis_data == 'tanya') {  ?>
	<div class="dt-responsive table-responsive">
		<table id="user-list-table-ret" class="table nowrap">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>No Whatsapp</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$no = 1;
				$query = mysqli_query($link,"SELECT a.* FROM tbl_customer a WHERE a.status = 2 ORDER BY a.id ASC");
				foreach ($query as $data) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['nama_customer'] ?></td>
						<td><?php echo $data['no_telp'] ?></td>
						<td>
							<span class="badge badge-light-success"></span>
							<div class="overlay-edit">
								<button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#modal-tanya-<?php echo $data['id'] ?>"><i class="feather icon-edit"></i></button>

								<button type="button" class="btn btn-icon btn-danger" onclick="deleteproduk(<?php echo $data['id_produk'] ?>)"><i class="feather icon-trash-2"></i></button>
							</div>
						</td>
					</tr>

					<!-- Modal Edit Customer -->
					<div class="modal fade" id="modal-tanya-<?php echo $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Masih Tanya Tanya</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="functions/proses-booking" method="post">
										<div class="row mt-3">
											<div class="col-12 mb-3">
												<h5>Informasi Booking</h5>
											</div>

											<div class="col-sm-4">
												<div class="form-group">
													<label>Nama Customer</label>
													<input type="hidden" name="kode_customer" value="<?= $data['kode_customer'] ?>">
													<input type="text" name="nama" class="form-control" id="title" required="" value="<?= $data['nama_customer']?>">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Nomor Whatsapp</label>
													<input type="number" name="no_telp" class="form-control" id="no_telp" required="" value="<?= $data['no_telp'] ?>">
												</div>
											</div>
											<div class="col">
												<div class="form-group">
													<label>Sumber</label>
													<select name="sumber" class="form-control" id="sumber">
														<option value=""></option>
														<option value="IG" <?php if ($data['sumber'] == 'IG') { echo 'selected'; } ?> > Instagram </option>
														<option value="Teman"<?php if ($data['sumber'] == 'Teman') { echo 'selected'; } ?> > Teman </option>
														<option value="Iklan"<?php if ($data['sumber'] == 'Iklan') { echo 'selected'; } ?> > Iklan </option>
													</select>
												</div>
											</div>
											<div class="col-sm-12">
												<button type="submit" name="edit_tanya" class="btn btn-primary">Simpan</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End of Modal Edit -->
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>No Whatsapp</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
	<?php } ?>