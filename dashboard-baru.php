<?php
require_once 'core/init.php';

if (!isset($_SESSION['id'])) {
    header('Location: login');
}

$session_id = $_SESSION['id'];
// $session_id = implode(', ', $session);

$query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.id_users = '$session_id' ");
$data = mysqli_fetch_array($query);

$query_users = mysqli_query($link, "SELECT COUNT(id_users) as jumlah FROM users WHERE level =2");
$users = mysqli_fetch_array($query_users);

$query_produk = mysqli_query($link, "SELECT COUNT(id_produk) as jumlah FROM tbl_produk");
$produk = mysqli_fetch_array($query_produk);

$query_tipe = mysqli_query($link, "SELECT COUNT(id_tipe) as jumlah FROM tbl_tipe");
$tipe = mysqli_fetch_array($query_tipe);

$tahun = date('y-m-d');
$tahun = date('Y', strtotime($tahun));

$barang = mysqli_query($link, "SELECT * FROM tbl_produk");
$jsArrayy = "var hrg_brgg = new Array();\n";

require_once('db/bdd.php');
$sql = "SELECT a.* FROM events a ORDER BY a.id ASC";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();

$query = mysqli_query($link, "SELECT a.* FROM tbl_status_kerja a");
$dataa = mysqli_fetch_array($query);

$tanggal_sekarang = date('Y-m-d');
$tgl_set = $dataa['tanggal'];
// $jangka_waktu = strtotime('+7 days', strtotime($tgl_set));
$jangka_waktu = date('Y-m-d', strtotime('+7 days', strtotime($tgl_set)));
$tgl_exp = date('Y-m-d', strtotime($jangka_waktu));

$cari10 = date('Y-m-d');
$cari10 = date('d F Y', strtotime($cari10));

$libur = 2;
$masuk = 1;

if ($tgl_exp == $tanggal_sekarang) {
    $sql = "UPDATE tbl_status_kerja SET status_kerja='$libur', tanggal = '$tgl_exp' WHERE tanggal = '$tgl_set'";
    $result = mysqli_query($link, $sql);
} else {
    $sql = "UPDATE tbl_status_kerja SET status_kerja='$masuk' WHERE tanggal = '$tgl_set'";
    $result = mysqli_query($link, $sql);
}

include 'sumber.php';
include 'views/header.php';

if (isset($_GET['search'])) {
    $cari = $_GET['search'];
}

?>
<!-- <style>
    .dt-responsive {
        overflow: hidden;
    }
</style> -->

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
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Cari Berdasarkan Tanggal</h5>
                        </div>
                        <div class="card-body">
                            <form action="dashboard" method="get">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="date" name="search" id="search" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <?php
                                        if (!empty($cari)) {
                                            $cari = date('d F Y', strtotime($cari));
                                            $cari10 = date('d F Y', strtotime($cari10));
                                            ?>
                                            <strong>
                                                <p>Tanggal : <?php echo $cari ?></p>
                                            </strong>
                                        <?php } else { ?>
                                            <strong>
                                                <p>Tanggal : <?php echo $cari10 ?></p>
                                            </strong>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Cari Cabang</h5>
                        </div>
                        <div class="card-body">
                            <form action="dashboard" method="get">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <select name="cabang" class="form-control select2" multiple="multiple" id="search_cabang">
                                                <option value=""></option>
                                                <option value="1"> Buah Batu </option>
                                                <option value="2"> Cimbuleuit </option>
                                                <option value="3"> Ujung Berung </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                $cabang_query = mysqli_query($link, "SELECT * FROM tbl_cabang");
                foreach ($cabang_query as $cq) {
                    $id_cbg = $cq['id_cabang'];
                    $nama_cbg = $cq['nama_cabang'];

                    //echo $id_cbg . $nama_cbg;
                    ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><?= $nama_cbg ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="dt-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="6">Jam</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>Senior</td>
                                                            <?php
                                                            $no = 1;
                                                            $tgl = date('Y-m-d');
                                                            $query = mysqli_query($link, "SELECT DISTINCT a.jam, b.start_jam, a.id_slot, a.id_cabang, b.start
                                                                FROM tbl_slot a 
                                                                LEFT JOIN events b ON a.id_slot = b.id_slot
                                                                WHERE a.id_cabang = $id_cbg
                                                                AND a.id_jabatan = 1
                                                                ORDER BY a.jam ASC");
                                                            foreach ($query as $data) {
                                                                $id_cabang = $data['id_cabang'];
                                                                $query_cabang = mysqli_query($link, "SELECT * FROM tbl_cabang WHERE id_cabang = $id_cabang");
                                                                foreach ($query_cabang as $qc) {
                                                                    ?>
                                                                    <?php if ($tgl != $data['start']) { ?>
                                                                        <td style="color:red"><a href="booking?cabang=<?php echo $qc['nama_cabang'] ?>&jam=<?php echo $data['jam'] ?>&tanggal=<?= $tanggal_sekarang ?>&popup=1" target="_blank" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php }
                                                                } ?>

                                                            <?php } ?>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="dt-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="6">Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Junior</td>
                                                            <?php
                                                            $no = 1;
                                                            $tgl = date('Y-m-d');
                                                            $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                                FROM tbl_slot a 
                                                                LEFT JOIN events b ON a.id_slot = b.id_slot
                                                                WHERE a.id_cabang = $id_cabang
                                                                AND a.id_jabatan = 2
                                                                ORDER BY a.jam ASC");
                                                            foreach ($query as $data) {
                                                                ?>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking?cabang=<?php echo $qc['nama_cabang'] ?>&jam=<?php echo $data['jam'] ?>&tanggal=<?= $tanggal_sekarang ?>&popup=1" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
                <div class="card shadow mb-4">
                    <a href="#collapseCardKaryawan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardKaryawan">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Informasi Karyawan Masuk
                        </h6>
                    </a>

                    <div class="collapse show" id="collapseCardKaryawan">
                        <div class="row" style="padding: 25px !important;">
                            <?php
                            $cabang_query = mysqli_query($link, "SELECT * FROM tbl_cabang");
                            foreach ($cabang_query as $cq) {
                                $id_cbg = $cq['id_cabang'];
                                $nama_cbg = $cq['nama_cabang'];
                                ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong><?= $nama_cbg ?></strong>
                                        </div>
                                        <div class="card-body">
                                            <ul style="list-style: none;">
                                                <?php
                                                $tanggal_sekarang = date('Y-m-d');
                                                // $tgl_set = $data['tanggal'];
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
                                                $user_query = mysqli_query($link, "SELECT * FROM users JOIN tbl_status_kerja ON tbl_status_kerja.id_users = users.id_users WHERE tbl_status_kerja.cabang = $id_cbg");
                                                foreach ($user_query as $karyawan) { ?>
                                                    <li style="width: 50%; margin: 5px 0; padding: 10px; <?php if ($karyawan['hari_libur'] == $daftar_hari[$namahari]){ echo 'background-color: red; color: #ffffff;'; } else { echo 'background-color: green; color: #ffffff'; } ?>"><?= $karyawan['username'] ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div style="padding: 10px 0;">* Keterangan : Merah = Libur, Hijau = Masuk</div>
                </div>
                <?php include 'views/footer.php';
                ?>