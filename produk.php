<?php  
require_once 'core/init.php';

if(!isset($_SESSION['id'])){
	header('Location: login');
}

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
								<h5>Data Produk</h5>
							</div>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
								<li class="breadcrumb-item"><a href="#">Data Produk</a></li>
								<li class="breadcrumb-item"><a href="#">List Produk</a></li>
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
									<button class="btn btn-primary btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i> Tambah Produk<span class="ripple ripple-animate"></span></button>
								</div>
							</div>
							<div class="dt-responsive table-responsive">
								<table id="user-list-table" class="table nowrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Produk</th>
											<th>Harga</th>
											<th>Waktu Retouch</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php  
										$no = 1;
										$query = mysqli_query($link,"SELECT a.*
											FROM tbl_produk a 
											ORDER BY id_produk ASC");
										foreach ($query as $data) { 
											?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $data['nama_produk'] ?></td>
												<td>Rp. <?php echo number_format( $data['harga'] ); ?></td>
												<td><?php echo $data['waktu_retouch'].' Hari'; ?></td>
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
																	<div class="col-sm-4">
																		<div class="form-group">
																			<label class="floating-label" for="Name">Nama Produk</label>
																			<input type="text" name="nama_produk" value="<?php echo $data['nama_produk'] ?>" class="form-control" id="Name" placeholder="">
																		</div>
																	</div>
																	<div class="col-sm-4">
																		<div class="form-group fill">
																			<label class="floating-label" for="Email">Harga Produk</label>
																			<input type="number" name="harga" value="<?php echo $data['harga'] ?>" class="form-control" id="Harga" placeholder="">
																		</div>
																	</div>
																	<div class="col-sm-4">
																		<div class="form-group fill">
																			<label class="floating-label" for="Email">Waktu Retouch (Hari)</label>
																			<input type="number" name="waktu_retouch" class="form-control" id="waktu_retouch" value="<?php echo $data['waktu_retouch'] ?>" placeholder="">
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
											<th>Nama Produk</th>
											<th>Harga</th>
											<th>Waktu Retouch</th>
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
							<div class="col-sm-4">
								<div class="form-group">
									<label class="floating-label" for="Name">Nama Produk</label>
									<input type="text" name="nama_produk" class="form-control" id="Name" placeholder="">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group fill">
									<label class="floating-label" for="Email">Harga Produk</label>
									<input type="number" name="harga" class="form-control" id="Harga" placeholder="">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group fill">
									<label class="floating-label" for="Email">Waktu Retouch (Hari)</label>
									<input type="number" name="waktu_retouch" class="form-control" id="waktu_retouch" placeholder="">
								</div>
							</div>

                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Sex">Tipe Produk</label>
                                <select name="tipe_produk" class="form-control" id="Sex">
                                    <option value=""></option>
                                    <option value="Senior">Senior</option>
                                    <option value="Junior">Junior</option>
                                    <option value="Retouch">Retouch</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-sm-12">
                        	<button type="submit" name="submit" onclick="return confirm('Anda yakin data sudah benar ?')" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
if (isset($_SESSION['status']) && $_SESSION['status'] !='') { ?>
	<script>
		$(document).ready(function(){  
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