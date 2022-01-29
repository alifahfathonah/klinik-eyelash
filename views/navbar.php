<div class="loader-bg">
	<div class="loader-track">
		<div class="loader-fill"></div>
	</div>
</div>

<nav class="pcoded-navbar menu-light ">
	<div class="navbar-wrapper  ">
		<div class="navbar-content scroll-div ">

			<div class="">
				<div class="main-menu-header">
					<img class="img-radius" src="assets/images/avatar-2.jpg" alt="User-Profile-Image">
					<div class="user-details">
						<div id="more-details">Admin</div>
					</div>
				</div>
			</div>

			<ul class="nav pcoded-inner-navbar ">
				<li class="nav-item pcoded-menu-caption">
					<label>Report</label>
				</li>
				<li class="nav-item">
					<a href="<?php if ($_SESSION['level'] == "1") {
									echo "dashboard";
								} else {
									echo "dashboard-pemasang";
								} ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
				</li>
				<li class="nav-item">
					<a href="booking" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user-plus"></i></span><span class="pcoded-mtext">Booking</span></a>
				</li>
				<li class="nav-item">
					<a href="jadwal-pemasang" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Jadwal Pemasang</span></a>
				</li>
				<li class="nav-item">
					<a href="data-customer" class="nav-link "><span class="pcoded-micon"><i class="feather icon-folder"></i></span><span class="pcoded-mtext">Data Customer</span></a>
				</li>
			</ul>

			<?php if ($_SESSION['level'] == "1") { ?>
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Kelola Data</label>
					</li>

					<li class="nav-item">
						<a href="produk" class="nav-link "><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">Data Produk</span></a>
						<!-- <ul class="pcoded-submenu">
						<li><a href="produk">List Produk</a></li>
						<li><a href="tipe-produk">Tipe Produk</a></li>
					</ul> -->
					</li>

					<li class="nav-item">
						<a href="cabang" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Data Cabang</span></a>
					</li>
					<li class="nav-item">
						<a href="users" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Data Users</span></a>
					</li>
					<li class="nav-item">
						<a href="slot" class="nav-link "><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">Data Slot</span></a>
					</li>
					<li class="nav-item">
						<a href="informasi-karyawan" class="nav-link "><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">Informasi Karyawan</span></a>
					</li>

				</ul>
			<?php } ?>

		</div>
	</div>
</nav>