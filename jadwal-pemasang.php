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
							<h5>Jadwal Pemasang Hari Ini</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#">Jadwal Pemasang</a></li>
							<li class="breadcrumb-item"><a href="#">List Pemasang</a></li>
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
					<div class="card-header">
                        <h5>Jadwal Pemasang Per Hari Ini</h5>
                    </div>
					<div class="card-body">
						<div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
                            </div>
                        </div>
						<div class="dt-responsive table-responsive">
							<table id="user-list-table" class="table nowrap">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Pemasang</th>
										<th>Tanggal</th>
										<th>Jam</th>
										<th>Sampai Jam</th>
									</tr>
								</thead>
								<tbody>
									<?php  
									$no = 1;
									$tgl = date('Y-m-d');
									$query = mysqli_query($link,"SELECT a.*, b.username
                                        FROM events a 
                                        LEFT JOIN users b ON a.id_users = b.id_users
                                        WHERE a.start = '$tgl'
                                        ORDER BY a.start_jam ASC");
                                    foreach ($query as $data) { 
                                    	$tanggal = date('d F Y', strtotime($data['start']));
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $data['username'] ?></td>
										<td><?php echo $tanggal ?></td>
										<td><?php echo $data['start_jam'] ?></td>
										<td><?php echo $data['ends_jam'] ?></td>
									</tr>

								<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Nama Pemasang</th>
										<th>Tanggal</th>
										<th>Jam</th>
										<th>Sampai Jam</th>
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Name">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" id="Name" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label class="floating-label" for="Email">Harga Produk</label>
                                <input type="number" name="harga" class="form-control" id="Harga" placeholder="">
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