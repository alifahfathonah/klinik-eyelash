<?php
require_once 'core/init.php';

if (!isset($_SESSION['id'])) {
    header('Location: login');
}
if ($_SESSION['level'] != "1") {
    header('Location: dashboard-pemasang');
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
                $cabang_query = mysqli_query($link, "SELECT * FROM tbl_cabang ");
                if (isset($_GET['search']) != null || isset($_GET['search']) != "") {
                    $tgl = $_GET['search'];
                } else {
                    $tgl =
                        date('Y-m-d');
                }
                foreach ($cabang_query as $cq) {
                    $id_cbg = $cq['id_cabang'];
                    $nama_cbg = $cq['nama_cabang']; ?>
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
                                                        $query = mysqli_query($link, "SELECT a.jam, (SELECT id FROM events WHERE start = '$tgl' AND id_slot = a.id_slot LIMIT 1) as id,
                                                            substring_index(GROUP_CONCAT(b.start ORDER BY b.start = '$tgl' DESC SEPARATOR ','), ',', 1) as tanggal
                                                            FROM tbl_slot a
                                                            LEFT JOIN events b ON b.id_slot = a.id_slot
                                                            WHERE a.id_cabang = $id_cbg AND a.id_jabatan = 1
                                                            GROUP BY a.jam;");
                                                        foreach ($query as $data) { ?>
                                                            <tr>
                                                                <?php if ($data['tanggal'] == $tgl) { ?>
                                                                    <td style="color:green; font-weight:900; text-align:center;"><a href="#" data-toggle="modal" data-target="#ModalEdit-<?= $data['id'] ?>" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red; font-weight:900; text-align:center;"><a href="booking?cabang=<?php echo $nama_cbg; ?>&jam=<?php echo $data['jam']; ?>&tanggal=<?= $tgl; ?>&id_jabatan=1&popup=1" target="_blank" style="color: red;"><?php echo $data['jam']; ?></a></td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php } ?>

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
                                                        <?php
                                                        $query = mysqli_query($link, "SELECT a.jam, (SELECT id FROM events WHERE start = '$tgl' AND id_slot = a.id_slot LIMIT 1) as id,
                                                            substring_index(GROUP_CONCAT(b.start ORDER BY b.start = '$tgl' DESC SEPARATOR ','), ',', 1) as tanggal
                                                            FROM tbl_slot a
                                                            LEFT JOIN events b ON b.id_slot = a.id_slot
                                                            WHERE a.id_cabang = $id_cbg AND a.id_jabatan = 2
                                                            GROUP BY a.jam;");
                                                        foreach ($query as $data) { ?>
                                                            <tr>
                                                                <?php if ($data['tanggal'] == $tgl) { ?>
                                                                    <td style="color:green; font-weight:900; text-align:center;"><a href="#" data-toggle="modal" data-target="#ModalEdit-<?= $data['id'] ?>" style="color: green"><?php echo $data['jam'] ?></a></td>
                                                                <?php } else { ?>
                                                                    <td style="color:red; font-weight:900; text-align:center;"><a href="booking?cabang=<?php echo $nama_cbg; ?>&jam=<?php echo $data['jam']; ?>&tanggal=<?= $tgl; ?>&id_jabatan=2&popup=1" target="_blank" style="color: red;"><?php echo $data['jam']; ?></a></td>
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
                    <?php
                    $data_popup = mysqli_query($link, "SELECT * FROM events a
                        LEFT JOIN tbl_cabang b ON a.id_cabang = b.id_cabang
                        LEFT JOIN tbl_customer c ON a.kode_customer = c.kode_customer
                        LEFT JOIN tbl_jabatan d ON a.id_jabatan = d.id_jabatan
                        LEFT JOIN tbl_produk e ON a.id_produk = e.id_produk
                        LEFT JOIN tbl_slot f ON a.id_slot = f.id_slot
                        LEFT JOIN tbl_tipe g ON a.id_tipe = g.id_tipe
                        LEFT JOIN users h ON a.id_users = h.id_users
                        WHERE a.start = '$tgl'");
                    $nomorz = 0;
                    foreach ($data_popup as $popup) {
                    ?>

                        <div class="modal fade" id="ModalEdit-<?= $popup['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel-<?= $popup['id']; ?>" aria-hidden="true">
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
                                                        <input type="hidden" name="id" id="id" value="<?= $popup['id']; ?>">
                                                        <input type="hidden" name="kode_customer" id="kode_customer" value="<?= $popup['kode_customer']; ?>">
                                                        <input type="text" name="nama" class="form-control" id="title" placeholder="Nama Customer" value="<?= $popup['nama_customer']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Nomor Whatsapp</label>
                                                        <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No Whatsapp" value="<?= $popup['no_telp']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" value="<?= $popup['tgl_lahir']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Pasang</label>
                                                        <input type="date" name="start" class="form-control start" id="start-<?= $popup['id']; ?>" placeholder="Title" value="<?= $popup['start']; ?>" readonly="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Retouch</label>
                                                        <input type="date" name="tgl_retouch" class="form-control tgl_retouch" id="tgl_retouch" placeholder="Title" value="<?= $popup['tgl_retouch']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Jam</label>
                                                        <input type="time" name="start_jam" class="form-control start_jam" id="start_jam" placeholder="jam" value="<?= str_replace(' ', '', $popup['start_jam']); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Sampai Jam</label>
                                                        <input type="time" name="ends_jam" class="form-control hour" id="ends_jam" placeholder="jam" value="<?= str_replace(' ', '', $popup['ends_jam']); ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Sumber</label>
                                                        <select name="sumber" class="form-control" id="sumber" placeholder="Sumber">
                                                            <option value=""></option>
                                                            <option value="IG" <?php if (!empty($popup['sumber'] == 'IG')) {
                                                                                    echo "selected";
                                                                                } ?>> Instagram </option>
                                                            <option value="Teman" <?php if (!empty($popup['sumber'] == 'Teman')) {
                                                                                        echo "selected";
                                                                                    } ?>> Teman </option>
                                                            <option value="Iklan" <?php if (!empty($popup['sumber'] == 'Iklan')) {
                                                                                        echo "selected";
                                                                                    } ?>> Iklan </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Pilih Cabang</label>
                                                        <select name="id_cabang" class="form-control" id="id_cabang-<?= $popup['id']; ?>" placeholder="Cabang">
                                                            <option value=""></option>
                                                            <?php
                                                            $cabang = ucwords($_GET['cabang']);
                                                            $query1 = mysqli_query($link, "SELECT * FROM tbl_cabang");
                                                            foreach ($query1 as $d) {
                                                            ?>
                                                                <option value="<?php echo $d['id_cabang']; ?>" <?php if (!empty($d['id_cabang'] == $popup['id_cabang'])) {
                                                                                                                    echo "selected";
                                                                                                                } ?>> <?php echo $d['nama_cabang']; ?></option>
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
                                                        <select name="id_produk" id="id_produk-<?= $popup['id']; ?>" class="form-control id_harga">
                                                            <option value=""></option>
                                                            <?php
                                                            $q_produk = mysqli_query($link, "SELECT * FROM tbl_produk");
                                                            foreach ($q_produk as $produk) {
                                                            ?>
                                                                <option value="<?php echo $produk['id_produk'] ?>" <?php if (!empty($produk['id_produk'] == $popup['id_produk'])) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>> <?php echo $produk['nama_produk'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Harga Produk</label>
                                                        <div id="harganya-<?= $popup['id']; ?>"></div>
                                                        <?php /** <input type="text" name="harga" class="form-control" id="harga-<?= $popup['id'] ?>" placeholder="Harga Otomatis Terisi" value="<?= $popup['harga'] ?>">
                                                        <?php $nomorz++; ?> **/ ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12 mb-3">
                                                    <h5>Informasi Pemasang</h5>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Jabatan Pemasang</label>
                                                        <select name="id_jabatan" class="form-control" id="id_jabatan-<?= $popup['id']; ?>">
                                                            <option value=""></option>
                                                            <option value="1" <?php if ($popup['id_jabatan'] == '1') {
                                                                                    echo "selected";
                                                                                } else {
                                                                                } ?>> Senior </option>
                                                            <option value="2" <?php if ($popup['id_jabatan'] == '2') {
                                                                                    echo "selected";
                                                                                } else {
                                                                                } ?>> Junior </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Nama Pemasang</label>
                                                        <div id="karyawannya-<?= $popup['id']; ?>"></div>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $('#id_jabatan-<?= $popup['id']; ?>').change(function() {
                                                            var id_cabang = document.getElementById("id_cabang-<?= $popup['id']; ?>").value;
                                                            var tanggal = document.getElementById("start-<?= $popup['id']; ?>").value;
                                                            var id_jabatan = document.getElementById("id_jabatan-<?= $popup['id']; ?>").value;

                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'functions/pilih-pemasang.php',
                                                                data: {
                                                                    'id_cabang': id_cabang,
                                                                    'tanggal': tanggal,
                                                                    'id_jabatan': id_jabatan,
                                                                },

                                                                success: function(response) {
                                                                    $('#karyawannya-<?= $popup['id']; ?>').html(response);
                                                                }
                                                            });
                                                        })
                                                    });
                                                </script>
                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $('#id_cabang-<?= $popup['id']; ?>').change(function() {
                                                            var id_cabang = document.getElementById("id_cabang-<?= $popup['id']; ?>").value;
                                                            var tanggal = document.getElementById("start-<?= $popup['id']; ?>").value;
                                                            var id_jabatan = document.getElementById("id_jabatan-<?= $popup['id']; ?>").value;

                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'functions/pilih-pemasang.php',
                                                                data: {
                                                                    'id_cabang': id_cabang,
                                                                    'tanggal': tanggal,
                                                                    'id_jabatan': id_jabatan,
                                                                },

                                                                success: function(response) {
                                                                    $('#karyawannya-<?= $popup['id']; ?>').html(response);
                                                                }
                                                            });
                                                        })
                                                    });
                                                </script>
                                                <script type="text/javascript">
                                                    $(window).on("load", function() {
                                                        var id_cabang = document.getElementById("id_cabang-<?= $popup['id']; ?>").value;
                                                        var tanggal = document.getElementById("start-<?= $popup['id']; ?>").value;
                                                        var id_jabatan = document.getElementById("id_jabatan-<?= $popup['id']; ?>").value;

                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'functions/pilih-pemasang-edit.php',
                                                            data: {
                                                                'id_cabang': id_cabang,
                                                                'tanggal': tanggal,
                                                                'id_jabatan': id_jabatan,
                                                            },

                                                            success: function(response) {
                                                                $('#karyawannya-<?= $popup['id']; ?>').html(response);
                                                            }
                                                        });
                                                    });
                                                </script>

                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $('#id_produk-<?= $popup['id']; ?>').change(function() {
                                                            var id_produk = document.getElementById("id_produk-<?= $popup['id']; ?>").value;

                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'functions/pilih-harga.php',
                                                                data: {
                                                                    'id_produk': id_produk,
                                                                },

                                                                success: function(response) {
                                                                    $('#harganya-<?= $popup['id']; ?>').html(response);
                                                                }
                                                            });
                                                        })
                                                    });
                                                </script>
                                                <script type="text/javascript">
                                                    $(window).on("load", function() {
                                                        var id_produk = document.getElementById("id_produk-<?= $popup['id']; ?>").value;

                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'functions/pilih-harga.php',
                                                            data: {
                                                                'id_produk': id_produk,
                                                            },

                                                            success: function(response) {
                                                                $('#harganya-<?= $popup['id']; ?>').html(response);
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12 mb-3">
                                                    <h5>Informasi Pembayaran</h5>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Transfer</label>
                                                        <input type="text" name="transfer" id="transfer" class="form-control" id="transfer" placeholder="Transfer" value="<?= $popup['transfer'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Cash</label>
                                                        <input type="text" name="cash" class="form-control" id="cash" placeholder="Cash" value="<?= $popup['transfer'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="warna" class="form-control" id="color" placeholder="Status">
                                                            <option value=""></option>
                                                            <option style="color:#008000;" value="#008000" <?php if ($popup['warna'] == "#008000") {
                                                                                                                echo "selected";
                                                                                                            } else {
                                                                                                            } ?>>&#9724; Sudah Bayar / Lunas </option>
                                                            <option style="color:#0071c5;" value="#0071c5" <?php if ($popup['warna'] == "#0071c5") {
                                                                                                                echo "selected";
                                                                                                            } else {
                                                                                                            } ?>>&#9724; Masih DP </option>
                                                            <option style="color:#FF0000;" value="#FF0000" <?php if ($popup['warna'] == "#FF0000") {
                                                                                                                echo "selected";
                                                                                                            } else {
                                                                                                            } ?>>&#9724; Belum Bayar </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan" value="<?= $popup['keterangan'] ?>">
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
                    <?php $nomorz++;
                    } ?>
                <?php } ?>
            </div>


            <!-- informasi karyawan -->
            <div class="row">
                <div class="col-12">
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
                                                    if (isset($_GET['search'])) {
                                                        $date = $_GET['search'];
                                                    } else {
                                                        $date = date('Y/m/d');
                                                    }
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

            <!-- Modal Tanya -->
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
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#no_telp').change(function() {
                        var no_telp = document.getElementById("no_telp").value;
                        console.log(no_telp);

                        $.ajax({
                            type: 'POST',
                            url: 'functions/check_nohp.php',
                            data: {
                                'no_telp': no_telp,
                            },

                            success: function(response) {
                                if (response == "true") {
                                    var hasil = '<span class="status-not-available" style="color: #ff4757"> No HP Sudah Digunakan</span>';
                                    $('#user-availability-status').html(hasil);
                                    $('#submitData').html('<button type="submit" name="submit" class="btn btn-primary" disabled>Simpan</button>');
                                } else if (response == "false") {
                                    var alert = "'Anda yakin data sudah benar?'";
                                    var hasil2 = '<span class="status-available" style="color: #23ad5c"> No HP Bisa Dipakai </span>';
                                    $('#user-availability-status').html(hasil2);
                                    $('#submitData').html('<button type="submit" name="submit" class="btn btn-primary" onclick="return confirm(' + alert + ')">Simpan</button>');
                                } else {

                                }
                            }
                        });
                    })
                });
            </script>
            <?php
            include 'views/footer.php';
            ?>
        </div>
    </div>