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

            <div class="row">
                <?php
                $cabang_query = mysqli_query($link, "SELECT * FROM tbl_cabang");
                foreach ($cabang_query as $cq) {
                    $id_cbg = $cq['id_cabang'];
                    $nama_cbg = $cq['nama_cabang'];

                    //echo $id_cbg . $nama_cbg;
                ?>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5><?= $nama_cbg ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="dt-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;">Senior</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $tgl = date('Y-m-d');
                                                        $query = mysqli_query($link, "SELECT distinct a.jam, b.start_jam, a.id_slot, a.id_cabang, b.id_slot as slot_event, max(b.start) as start, b.id_jabatan as jabatan_events
                                                            FROM tbl_slot a 
                                                            LEFT JOIN events b ON a.id_slot = b.id_slot
                                                            WHERE a.id_cabang = $id_cbg
                                                            AND a.id_jabatan = 1
                                                            group by a.jam
");
                                                        foreach ($query as $data) {
                                                            $id_cabang = $data['id_cabang'];
                                                            $query_cabang = mysqli_query($link, "SELECT * FROM tbl_cabang WHERE id_cabang = $id_cabang");
                                                            foreach ($query_cabang as $qc) { ?>
                                                                <?php if ($data['start'] == $tgl && $data['jabatan_events'] == 1) { ?>
                                                                    <tr>
                                                                        <td style="color:green; font-weight:900; text-align:center;"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } else { ?>
                                                                        <td style="color:red; font-weight:900; text-align:center;"><a href="booking?cabang=<?php echo $qc['nama_cabang'] ?>&jam=<?php echo $data['jam'] ?>&tanggal=<?= $tanggal_sekarang ?>&jabatan=1&popup=1" target="_blank" style="color: red;"><?php echo $data['jam'] ?></a></td>
                                                                    <?php } ?>
                                                                    </tr>
                                                            <?php }
                                                        } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="dt-responsive">
                                                <table id="user-list-tableee" class="table nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;">Junior</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
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
                                                                <?php if ($data['jam'] == $data['start_jam'] && $data['start'] == $tgl) { ?>
                                                                    <td style="color:green; font-weight:900; text-align:center;"><a href="data-customer" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red; font-weight:900; text-align:center;"><a href="booking?cabang=<?php echo $qc['nama_cabang'] ?>&jam=<?php echo $data['jam'] ?>&tanggal=<?= $tanggal_sekarang ?>&popup=1" style="color: red;"><?php echo $data['jam'] ?></a></td>
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

                <?php } ?>
            </div>

            <!-- informasi karyawan -->
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
                                            $date = date('Y/m/d');
                                            $namahari = date('l', strtotime($date));
                                            $user_query = mysqli_query($link, "SELECT * FROM users JOIN tbl_status_kerja ON tbl_status_kerja.id_users = users.id_users WHERE tbl_status_kerja.cabang = $id_cbg AND users.level = 2");
                                            foreach ($user_query as $karyawan) { ?>
                                                <li style="width: 50%; margin: 5px 0; text-align: center; padding: 10px; <?php if ($karyawan['hari_libur'] == $daftar_hari[$namahari]) {
                                                                                                                                echo 'background-color: red; color: #ffffff;';
                                                                                                                            } else {
                                                                                                                                echo 'background-color: green; color: #ffffff';
                                                                                                                            } ?>"><?= $karyawan['username'] ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div style="padding: 10px 20px;">* Keterangan : Merah = Libur, Hijau = Masuk</div>
                </div>
            </div>

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


            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- Button trigger modal -->


    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions/proses-booking" method="post">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h5>Informasi Booking</h5>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nama Customer</label>
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" name="nama" class="form-control" id="title" placeholder="Nama Customer">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nomor Whatsapp</label>
                                    <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Nama Customer">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" required="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Jam</label>
                                    <input type="text" name="start_jam" class="form-control hour" id="start_jam" placeholder="jam">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Sampai Jam</label>
                                    <input type="text" name="ends_jam" class="form-control hour" id="ends_jam" placeholder="jam">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tanggal Retouch</label>
                                    <input type="date" name="tgl_retouch" class="form-control" id="tgl_retouch" placeholder="Title">
                                </div>
                            </div>

                            <input type="hidden" name="start" class="form-control" id="start" placeholder="Title" readonly="">

                            <div class="col">
                                <div class="form-group">
                                    <label>Sumber</label>
                                    <select name="sumber" class="form-control" id="sumber" placeholder="Sumber">
                                        <option value=""></option>
                                        <option value="IG"> Instagram </option>
                                        <option value="Teman"> Teman </option>
                                        <option value="Iklan"> Iklan </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Pilih Cabang</label>
                                    <select name="id_cabang" class="form-control" id="id_cabang" placeholder="Cabang">
                                        <option value=""></option>
                                        <?php
                                        $query1 = mysqli_query($link, "SELECT a.* FROM tbl_cabang a ");
                                        foreach ($query1 as $d) { ?>
                                            <option value="<?php echo $d['id_cabang'] ?>">
                                                <?php echo $d['nama_cabang'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                <h5>Informasi Produk</h5>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <select name="id_produk" id="id_produk" class="form-control" onchange="changeValueEdit(this.value)" placeholder="Nama Produk">
                                        <option value=""></option>
                                        <?php if (mysqli_num_rows($barang)) { ?>
                                            <?php while ($row_brgg = mysqli_fetch_array($barang)) { ?>
                                                <option value="<?php echo $row_brgg["id_produk"] ?>"> <?php echo $row_brgg["nama_produk"] ?> </option>
                                            <?php $jsArrayy .= "hrg_brgg['" . $row_brgg['id_produk'] . "'] = {hrg:'" . addslashes($row_brgg['harga']) . "'};\n";
                                            } ?>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Produk</label>
                                    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Otomatis Terisi">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipe Produk</label>
                                    <select name="id_tipe" class="form-control" id="id_tipe" placeholder="Tipe Produk">
                                        <option value=""></option>
                                        <?php
                                        $query1 = mysqli_query($link, "SELECT a.* FROM tbl_tipe a ");
                                        foreach ($query1 as $d) { ?>
                                            <option value="<?php echo $d['id_tipe'] ?>">
                                                <?php echo $d['nama_tipe'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                <h5>Informasi Pemasang</h5>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Pemasang</label>
                                    <select name="id_users" class="form-control" id="id_users" placeholder="Nama Pemasang">
                                        <option value=""></option>
                                        <?php
                                        $query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.level = 2");
                                        foreach ($query as $d) { ?>
                                            <option value="<?php echo $d['id_users'] ?>">
                                                <?php echo $d['username'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                <h5>Informasi Pembayaran</h5>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Transfer</label>
                                    <input type="text" name="transfer" id="transfer" class="form-control" id="transfer" placeholder="Transfer">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cash</label>
                                    <input type="text" name="cash" class="form-control" id="cash" placeholder="Cash">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="warna" class="form-control" id="color" placeholder="Status">
                                        <option value=""></option>
                                        <option style="color:#008000;" value="#008000">&#9724; Sudah Bayar / Lunas </option>
                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Masih DP </option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Belum Bayar </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-danger" onclick="deletebooking()">Hapus Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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