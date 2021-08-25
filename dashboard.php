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
<style>
    .dt-responsive {
        overflow: hidden;
    }
</style>

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

            <?php
            if (isset($_GET['search'])) {
                $cari = $_GET['search'];
                $cari2 = $_GET['search'];
                $cari3 = $_GET['search'];
            ?>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Buah Batu 2</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam, a.id_slot, b.start, b.id_jabatan, b.id_cabang, b.status
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 1
                                                        AND a.id_jabatan = 1
                                                        ORDER BY a.jam ASC
                                                        ");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php
                                                                if ($data['id_jabatan'] == 1 && $data['id_cabang'] == 1) { ?>
                                                                    <?php if ($cari != $data['start']) { ?>
                                                                        <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam, a.id_slot, b.start, b.id_jabatan, b.id_cabang
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 1
                                                        AND a.id_jabatan = 1
                                                        ORDER BY a.jam ASC
                                                        ");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['id_cabang'] == 1 && $data['id_jabatan'] == 2) { ?>
                                                                    <?php if ($cari2 != $data['start']) { ?>
                                                                        <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cimbuleuit</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam, a.id_slot, b.start, b.id_jabatan, b.id_cabang
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 1
                                                        AND a.id_jabatan = 1
                                                        ORDER BY a.jam ASC
                                                        ");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['id_cabang'] == 2 && $data['id_jabatan'] == 1) { ?>
                                                                    <?php if ($cari3 != $data['start']) { ?>
                                                                        <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam, a.id_slot, b.start, b.id_jabatan, b.id_cabang
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 1
                                                        AND a.id_jabatan = 1
                                                        ORDER BY a.jam ASC
                                                        ");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['id_cabang'] == 2 && $data['id_jabatan'] == 2) { ?>
                                                                    <?php if ($cari3 != $data['start']) { ?>
                                                                        <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Ujung Berung</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam, a.id_slot, b.start, b.id_jabatan, b.id_cabang
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 1
                                                        AND a.id_jabatan = 1
                                                        ORDER BY a.jam ASC
                                                        ");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['id_cabang'] == 3 && $data['id_jabatan'] == 1) { ?>
                                                                    <?php if ($cari3 != $data['start']) { ?>
                                                                        <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam, a.id_slot, b.start, b.id_jabatan, b.id_cabang
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 1
                                                        AND a.id_jabatan = 1
                                                        ORDER BY a.jam ASC
                                                        ");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['id_cabang'] == 3 && $data['id_jabatan'] == 2) { ?>
                                                                    <?php if ($cari3 != $data['start']) { ?>
                                                                        <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="" data-toggle="modal" data-target="#ModalAdd<?php echo $data['id_slot'] ?>" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cabang Lain</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 2
                                                        AND a.id_jabatan = 2
                                                        ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                        FROM tbl_slot a 
                                                        LEFT JOIN events b ON a.id_slot = b.id_slot
                                                        WHERE a.id_cabang = 2
                                                        AND a.id_jabatan = 1
                                                        ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- seo end -->
                </div>
            <?php } else { ?>

                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Buah Batu 3</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT DISTINCT a.jam, b.start_jam, a.id_slot, a.id_cabang, b.start
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 1
                                                    AND a.id_jabatan = 1
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                            $id_cabang = $data['id_cabang'];
                                                            $query_cabang = mysqli_query($link, "SELECT * FROM tbl_cabang WHERE id_cabang = $id_cabang");
                                                            foreach ($query_cabang as $qc) {
                                                        ?>
                                                                <tr>
                                                                    <?php if ($tgl != $data['start']) { ?>
                                                                        <td style="color:red"><a href="booking?cabang=<?php echo $qc['nama_cabang'] ?>&jam=<?php echo $data['jam'] ?>&tanggal=<?= $tanggal_sekarang ?>&popup=1" target="_blank" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php }
                                                                } ?>
                                                                </tr>

                                                            <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 1
                                                    AND a.id_jabatan = 2
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cimbuleuit</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 2
                                                    AND a.id_jabatan = 2
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 2
                                                    AND a.id_jabatan = 1
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Ujung Berung</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 2
                                                    AND a.id_jabatan = 2
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 2
                                                    AND a.id_jabatan = 1
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cabang Lain</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 2
                                                    AND a.id_jabatan = 2
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Junior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT a.jam, b.start_jam
                                                    FROM tbl_slot a 
                                                    LEFT JOIN events b ON a.id_slot = b.id_slot
                                                    WHERE a.id_cabang = 2
                                                    AND a.id_jabatan = 1
                                                    ORDER BY a.jam ASC");
                                                        foreach ($query as $data) {
                                                        ?>
                                                            <tr>
                                                                <?php if ($data['jam'] == $data['start_jam']) { ?>
                                                                    <td style="color:green"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red"><a href="booking" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                <?php } ?>
                                                            </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- seo end -->
                </div>

            <?php } ?>

            <?php
            if (isset($_GET['search'])) {
                $cari = $_GET['search'];
            ?>
                <div class="card shadow mb-4">
                    <a href="#collapseCardKaryawan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardKaryawan">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Informasi Karyawan Masuk
                        </h6>
                    </a>

                    <div class="collapse show" id="collapseCardKaryawan">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card user-profile-list">
                                    <div class="card-body">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                        <div class="dt-responsive table-responsive">
                                            <table id="user-list-table-status" class="table nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($link, "SELECT a.* FROM tbl_status_kerja a");
                                                    $data_karyawan = mysqli_fetch_array($query);

                                                    $tgl_set = $data_karyawan['tanggal'];
                                                    $jangka_waktu = date('Y-m-d', strtotime('+7 days', strtotime($tgl_set)));
                                                    $tgl_exp = date('Y-m-d', strtotime($jangka_waktu));

                                                    if ($tgl_exp != $cari) {
                                                        $no = 1;
                                                        $query = mysqli_query($link, "SELECT a.*, b.username
                                                    FROM tbl_status_kerja a
                                                    LEFT JOIN users b ON a.id_users = b.id_users
                                                    WHERE b.level = 2
                                                    AND a.status_kerja = 1");
                                                        foreach ($query as $data) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $data['username'] ?></td>
                                                                <td>
                                                                    <?php if ($data['status_kerja'] == 1) { ?>
                                                                        <button class="btn btn-success btn-sm"> Masuk </button>
                                                                    <?php } else { ?>
                                                                        <button class="btn btn-danger btn-sm"> Libur </button>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                        <div class="modal fade" id="modal-edit-<?php echo $data['id_users'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Pemasang</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="functions/proses-users" method="post">
                                                                            <div class="row">
                                                                                <div class="col-12 mb-3">
                                                                                    <h5>Informasi Karyawan Masuk</h5>
                                                                                </div>
                                                                                <input type="hidden" name="id_users" value="<?php echo $data['id_users'] ?>">
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label class="floating-label" for="Name">Nama</label>
                                                                                        <input type="text" name="username" value="<?php echo $data['username'] ?>" class="form-control" id="Name" placeholder="" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label class="floating-label" for="Sex">Level</label>
                                                                                        <select name="status_kerja" class="form-control" id="level" placeholder="Status">
                                                                                            <option value=""></option>
                                                                                            <option <?php if ($data['status_kerja'] == "1") { ?> selected="selected" value="1">Masuk</option>
                                                                                        <?php } else {
                                                                                                        echo '<option value="1">Masuk</option>';
                                                                                                    } ?>
                                                                                        <option <?php if ($data['status_kerja'] == "2") { ?> selected="selected" value="2">Libur</option>
                                                                                    <?php } else {
                                                                                                    echo '<option value="2">Libur</option>';
                                                                                                } ?>
                                                                                        </select>
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
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="card shadow mb-4">
                    <a href="#collapseCardKaryawan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardKaryawan">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Informasi Karyawan Masuk semua
                        </h6>
                    </a>

                    <div class="collapse show" id="collapseCardKaryawan">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card user-profile-list">
                                    <div class="card-body">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                        <div class="dt-responsive table-responsive">
                                            <table id="user-list-table-status" class="table nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $query = mysqli_query($link, "SELECT a.*, b.username
                                                    FROM tbl_status_kerja a
                                                    LEFT JOIN users b ON a.id_users = b.id_users
                                                    WHERE b.level = 2
                                                    AND a.status_kerja = 1");
                                                    foreach ($query as $data) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $data['username'] ?></td>
                                                            <td>
                                                                <?php if ($data['status_kerja'] == 1) { ?>
                                                                    <button class="btn btn-success btn-sm"> Masuk </button>
                                                                <?php } else { ?>
                                                                    <button class="btn btn-danger btn-sm"> Libur </button>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="modal-edit-<?php echo $data['id_users'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Pemasang</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="functions/proses-users" method="post">
                                                                            <div class="row">
                                                                                <div class="col-12 mb-3">
                                                                                    <h5>Informasi Karyawan Masuk</h5>
                                                                                </div>
                                                                                <input type="hidden" name="id_users" value="<?php echo $data['id_users'] ?>">
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label class="floating-label" for="Name">Nama</label>
                                                                                        <input type="text" name="username" value="<?php echo $data['username'] ?>" class="form-control" id="Name" placeholder="" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label class="floating-label" for="Sex">Level</label>
                                                                                        <select name="status_kerja" class="form-control" id="level" placeholder="Status">
                                                                                            <option value=""></option>
                                                                                            <option <?php if ($data['status_kerja'] == "1") { ?> selected="selected" value="1">Masuk</option>
                                                                                        <?php } else {
                                                                                                        echo '<option value="1">Masuk</option>';
                                                                                                    } ?>
                                                                                        <option <?php if ($data['status_kerja'] == "2") { ?> selected="selected" value="2">Libur</option>
                                                                                    <?php } else {
                                                                                                    echo '<option value="2">Libur</option>';
                                                                                                } ?>
                                                                                        </select>
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
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Input Data Customer</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tanya">Tanya Tanya ?</button>
                            <a href="booking" class="btn btn-info">Booking Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            if (isset($_GET['search_cabang'])) {
                $jur = "";
                foreach ($_POST['cabang'] as $value) {
                    $jur .= "'$value'" . ",";
                }
                $jur = substr($jur, 0, -1);

                $sql = "SELECT * FROM tbl_slot WHERE id_cabang in ($jur) order by id_cabang asc";

                $hasil = mysqli_query($link, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                }
            ?>

                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Buah Batu 1</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5>Senior</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td><?php echo $no; ?></td>
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
                </div>
            <?php } ?>

            <!-- <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Jumlah Data Customer Perbulan</h5>
                    </div>
                    <div class="card-body">
                        <div id="chart-highchart-bar1" style="width: 100%; height: 450px;"></div>
                    </div>
                </div>
            </div>
        </div> -->


            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- Button trigger modal -->

    <div class="modal fade" id="modal-tanya" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
                                    <input type="text" name="nama" class="form-control" id="title" required="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nomor Whatsapp</label>
                                    <input type="number" name="no_telp" class="form-control" id="no_telp" required="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Sumber</label>
                                    <select name="sumber" class="form-control" id="sumber">
                                        <option value=""></option>
                                        <option value="IG"> Instagram </option>
                                        <option value="Teman"> Teman </option>
                                        <option value="Iklan"> Iklan </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" name="tanya_tanya" class="btn btn-primary">Simpan</button>
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