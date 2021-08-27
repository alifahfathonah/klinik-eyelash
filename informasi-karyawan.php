<?php  
require_once 'core/init.php';

if(!isset($_SESSION['id'])){
	header('Location: login');
}

$query = mysqli_query($link,"SELECT a.* FROM tbl_status_kerja a");
$data = mysqli_fetch_array($query);

$tanggal_sekarang = date('Y-m-d');
$tgl_set = $data['tanggal'];
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
$namahari = date('l', strtotime($date));

//    echo $daftar_hari[$namahari];
// $jangka_waktu = strtotime('+7 days', strtotime($tgl_set));
// $jangka_waktu = date('Y-m-d', strtotime('+7 days', strtotime($tgl_set)));
// $tgl_exp=date('Y-m-d',strtotime($jangka_waktu));

// $libur = 2;
// $masuk = 1;

// if ($tgl_exp == $tanggal_sekarang) {
// 	$sql = "UPDATE tbl_status_kerja SET status_kerja='$libur', tanggal = '$tgl_exp' WHERE tanggal = '$tgl_set'";
// 	$result = mysqli_query($link, $sql);
// }else{
// 	$sql = "UPDATE tbl_status_kerja SET status_kerja='$masuk' WHERE tanggal = '$tgl_set'";
// 	$result = mysqli_query($link, $sql);
// }

include 'views/header.php';
?>
<body class="">

	<?php  
	include 'views/navbar.php';
	include 'views/notifications.php';
	?>

	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-content">
			<!-- [ breadcrumb ] start -->
			<div class="page-header">
				<div class="page-block">
					<div class="row align-items-center">
						<div class="col-md-12">
							<div class="page-header-title">
								<h5>Data Informasi Karyawan</h5>
							</div>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
								<li class="breadcrumb-item"><a href="#">Data Karyawan</a></li>
								<li class="breadcrumb-item"><a href="#">List Karyawan</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- [ breadcrumb ] end -->
			<!-- [ Main Content ] start -->

			<div class="row">
				<div class="col-lg-12">
					<div class="card user-profile-list">
						<div class="card-body">
							<div class="row align-items-center m-l-0">
								<div class="col-sm-6">
								</div>
								<div class="col-sm-6 text-right mb-4">
									<!-- <button class="btn btn-primary btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i> Tambah Users<span class="ripple ripple-animate"></span></button> -->
								</div>
							</div>
							<div class="dt-responsive table-responsive">
								<table id="user-list-table" class="table nowrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Hari Libur</th>
											<th>Cabang</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php  
										$no = 1;
										$query = mysqli_query($link,"SELECT a.*, b.username, b.level, c.*
											FROM tbl_status_kerja a 
											LEFT JOIN users b ON a.id_users = b.id_users LEFT JOIN tbl_cabang c ON a.cabang = c.id_cabang 
											WHERE b.level = '2' ORDER BY id_kerja ASC");
									// $data_cabang = mysqli_fetch_array($query_cabang); 
										foreach ($query as $data) { 
											?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $data['username'] ?></td>
												<td>
													<?php if ($data['hari_libur'] != $daftar_hari[$namahari]) { ?>
														<button class="btn btn-success btn-sm"> Masuk </button>
													<?php }else{ ?>
														<button class="btn btn-danger btn-sm"> Libur </button>
													<?php } ?>
												</td>
												<td>
													<?= $data['nama_cabang']; ?>
												</td>

												<td>
													<span class="badge badge-light-success"></span>
													<div class="overlay-edit">
														<button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_users'] ?>"><i class="feather icon-edit"></i></button>
													</div>
												</td>
											</tr>

											<div class="modal fade" id="modal-edit-<?php echo $data['id_users'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-xl">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Users</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form action="functions/proses-users" method="post">
																<div class="row">
																	<div class="col-12 mb-3">
																		<h5>Informasi Users</h5>
																	</div>
																	<input type="hidden" name="id_users" value="<?php echo $data['id_users'] ?>">
																	<div class="col">
																		<div class="form-group">
																			<label class="floating-label" for="Name">Nama</label>
																			<input type="text" name="username" value="<?php echo $data['username'] ?>" class="form-control" id="Name" readonly="">
																		</div>
																	</div>
																	<div class="col">
																		<div class="form-group">
																			<label class="floating-label" for="hari_libur">Hari Libur</label>
																			<select name="hari_libur" class="form-control" id="hari_libur" placeholder="Hari Libur">
																				<option value=""></option>
																				<option value="Senin" <?php if ($data['hari_libur'] === "Senin") { echo "selected"; } ?>>Senin</option>
																				<option value="Selasa" <?php if ($data['hari_libur'] === "Selasa") { echo "selected"; } ?>>Selasa</option>
																				<option value="Rabu" <?php if ($data['hari_libur'] === "Rabu") { echo "selected"; } ?>>Rabu</option>
																				<option value="Kamis" <?php if ($data['hari_libur'] === "Kamis") { echo "selected"; } ?>>Kamis</option>
																				<option value="Jumat" <?php if ($data['hari_libur'] === "Jumat") { echo "selected"; } ?>>Jum'at</option>
																				<option value="Sabtu" <?php if ($data['hari_libur'] === "Sabtu") { echo "selected"; } ?>>Sabtu</option>
																				<option value="Minggu" <?php if ($data['hari_libur'] === "Minggu") { echo "selected"; } ?>>Minggu</option>
																			</select>
																		</div>
																	</div>
																	<div class="col">
																		<div class="form-group">
																			<label class="floating-label" for="id_cabang">Cabang</label>
																			<select name="id_cabang" class="form-control" id="id_cabang" placeholder="Pilihan Cabang">
																				<option value=""></option>
																				<?php $query_cabang = mysqli_query($link, "SELECT * FROM tbl_cabang");
																				foreach ($query_cabang as $cabang) { ?>
																					<option value="<?= $cabang['id_cabang']; ?>" <?php if ($data['nama_cabang'] == $cabang['nama_cabang']) { echo 'selected'; } ?>><?= $cabang['nama_cabang']; ?></option>
																				<?php } ?>
																			</select>
																			<!-- <input type="date" name="tanggal" value="<?php //echo $data['tanggal'] ?>" class="form-control" id="Name"> -->
																		</div>
																	</div>       
																	<div class="col-sm-12">
																		<button type="submit" name="info_karyawan" class="btn btn-primary">Edit</button>
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
											<th>Username</th>
											<th>Hari Libur</th>
											<th>Cabang</th>
											<th></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- [ Main Content ] end -->
		</div>
	</div>


	<!-- MODAL TAMBAH PRODUK -->
	<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Users</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="functions/proses-users" method="post">
						<div class="row">
							<div class="col-12 mb-3">
								<h5>Informasi Users</h5>
							</div>
							<div class="col">
								<div class="form-group">
									<label class="floating-label" for="Name">Username</label>
									<input type="text" name="username" class="form-control" id="Name" placeholder="">
								</div>
							</div>
							<div class="col">
								<div class="form-group fill">
									<label class="floating-label" for="Email">Password</label>
									<input type="password" name="password" class="form-control" id="password" placeholder="">
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									<label class="floating-label" for="Sex">Level</label>
									<select name="level" class="form-control" id="Sex">
										<option value=""></option>
										<option value="1">Admin</option>
										<option value="2">Pemasang</option>
									</select>
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									<label class="floating-label" for="hari_libur">Hari Libur</label>
									<select name="hari_libur" class="form-control" id="hari_libur" placeholder="Hari Libur">
										<option value=""></option>
										<option value="Senin">Senin</option>
										<option value="Selasa">Selasa</option>
										<option value="Rabu">Rabu</option>
										<option value="Kamis">Kamis</option>
										<option value="Jumat">Jum'at</option>
										<option value="Sabtu">Sabtu</option>
										<option value="Minggu">Minggu</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label class="floating-label" for="id_cabang">Cabang</label>
									<select name="id_cabang" class="form-control" id="id_cabang" placeholder="Pilihan Cabang">
										<option value=""></option>
										<?php $query_cabang = mysqli_query($link, "SELECT * FROM tbl_cabang");
										foreach ($query_cabang as $cabang) { ?>
											<option value="<?= $cabang['id_cabang']; ?>"><?= $cabang['nama_cabang']; ?></option>
										<?php } ?>
									</select>
									<!-- <input type="date" name="tanggal" value="<?php //echo $data['tanggal'] ?>" class="form-control" id="Name"> -->
								</div>
							</div>

							<div class="col-sm-12">
								<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php 
	include 'views/footer.php';
	?>