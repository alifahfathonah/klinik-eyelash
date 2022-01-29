<?php
require_once 'core/init.php';

if (!isset($_SESSION['id'])) {
	header('Location: login');
}

include 'views/header.php';
?>

<body class="">

	<?php
	include 'views/navbar.php';
	include 'views/notifications.php';
	$dataCabang = mysqli_query($link, "SELECT * FROM tbl_cabang");
	$dataJabatan = mysqli_query($link, "SELECT * FROM tbl_jabatan");
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
								<h5>Data Slot</h5>
							</div>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
								<li class="breadcrumb-item"><a href="#">Data Slot</a></li>
								<li class="breadcrumb-item"><a href="#">Slot</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- [ breadcrumb ] end -->
			<!-- [ Main Content ] start -->

			<div class="row">
				<?php
				foreach ($dataCabang as $cabang) { ?>
					<div class="col-lg-6">
						<div class="card user-profile-list">
							<div class="card-header">
								<h5><?= $cabang['nama_cabang']; ?></h5>
								<button class="btn btn-primary btn-sm btn-round has-ripple" id="tambahslot" data-toggle="modal" data-target="#modal-tambahslot" data-idcabang=<?= $cabang['id_cabang']; ?> style="float: right;"><i class="fa fa-plus"></i> Tambah Data</button>
							</div>
							<div class="card-body">
								<div class="row align-items-center m-l-0">
									<div class="col-sm-6">
									</div>
								</div>
								<div class="row">
									<?php foreach ($dataJabatan as $jabatan) { ?>
										<div class="col-lg-6">
											<div class="card-header">
												<h5><?= $jabatan['jabatan']; ?></h5>
											</div>
											<div class="dt-responsive table-responsive">
												<table id="user-list-tableee" class="table nowrap">
													<thead>
														<tr>
															<th>Jam</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php
														$no = 1;
														$query = mysqli_query($link, "SELECT a.*
		                                        FROM tbl_slot a 
		                                        WHERE a.id_cabang = " . $cabang['id_cabang'] . "
		                                        AND a.id_jabatan = " . $jabatan['id_jabatan'] . "
		                                        ORDER BY id_slot ASC");
														foreach ($query as $data) {
														?>
															<tr>
																<td><?php echo $data['jam'] ?></td>
																<td>
																	<span class="badge badge-light-success"></span>
																	<div class="overlay-edit">
																		<button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_produk'] ?>"><i class="feather icon-edit"></i></button>

																		<button type="button" class="btn btn-icon btn-danger" onclick="deleteproduk(<?php echo $data['id_produk'] ?>)"><i class="feather icon-trash-2"></i></button>
																	</div>
																</td>
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
												</table>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<!-- [ Main Content ] end -->
		</div>
	</div>


	<!-- MODAL TAMBAH PRODUK -->
	<div class="modal fade" id="modal-tambahslot" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Data Slot</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="functions/proses-produk" method="post">
						<div class="row">
							<div class="col-12 mb-3">
								<h5>Informasi Slot</h5>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Data Jabatan</label>
									<select name="jabatan" id="jabatan" class="form-control">
										<option value="0" selected disabled>- Pilih Jabatan -</option>
										<?php foreach ($dataJabatan as $pilihjabatan) { ?>
											<option value="<?= $pilihjabatan['id_jabatan'] ?>"><?= $pilihjabatan['jabatan'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group fill">
									<label>Jam</label>
									<input type="time" name="jam" class="form-control" id="jam" placeholder="">
								</div>
							</div>
							<input type="text" name="id_cabang" id="idcabang">
							<div class="col-sm-12">
								<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).on('click', '#tambahslot', function() {
			var idcabang = $(this).data('idcabang');
			$('#idcabang').val(idcabang);
		});
	</script>
	<?php
	if (isset($_SESSION['status']) && $_SESSION['status'] != '') { ?>
		<script>
			$(document).ready(function() {
				Swal.fire({
					icon: "<?php echo $_SESSION['status_code']; ?>",
					text: "<?php echo $_SESSION['status_text']; ?>",
					showConfirmButton: true,
					// timer: 1500
				});
			});
		</script>
	<?php
		unset($_SESSION['status']);
	}


	include 'views/footer.php';
	?>