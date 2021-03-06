<?php
require_once 'core/init.php';

if (!isset($_SESSION['id'])) {
    header('Location: login');
}

$session_id = $_SESSION['id'];
// $session_id = implode(', ', $session);

$query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.id_users = '$session_id' ");
$data = mysqli_fetch_array($query);

$barang = mysqli_query($link, "SELECT * FROM tbl_produk");
$jsArrayy = "var hrg_brgg = new Array();\n";

require_once('db/bdd.php');
$sql = "SELECT a.*, b.kode_customer, b.nama_customer, b.no_telp, b.tgl_lahir, b.sumber FROM events a JOIN tbl_customer b ON b.kode_customer = a.kode_customer ORDER BY a.id ASC";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();

include 'views/header.php';

?>

<script>
    function loadPopup() {
        $('#ModalAdd').modal('show');
    }
</script>

<body onload="<?php if (!empty($_GET['popup'] == 1)) {
                    echo "loadPopup()";
                } ?>">

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
                                <h5 class="m-b-10">Booking</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Booking</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Booking Customer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div id="calendar" class="col-centered"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- seo end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- Button trigger modal -->

    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions/proses-booking" method="post">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h5>Informasi Produk</h5>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <select name="id_produk" class="form-control" id="produk" onchange="changeValue(this.value)" required="">
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
                                    <input type="text" name="harga" class="form-control" id="hrg" placeholder="Harga Otomatis Terisi" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                <h5>Informasi Booking</h5>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Customer</label>
                                    <select name="jenis_customer" id="jenis_customer" class="form-control">
                                        <option value="0">-- PILIH CUSTOMER --</option>
                                        <option value="customer_baru">Customer Baru</option>
                                        <option value="customer_lama">Customer Lama</option>
                                        <option value="customer_tanya">Customer Tanya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div id="data_customer"></div>
                            </div>

                            <!-- <div class="col-sm-4">
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir">
                            </div>
                        </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Pasang</label>
                                    <input type="date" name="start" class="form-control" id="start" placeholder="Title" value="<?= $_GET['tanggal']; ?>" disabled="">
                                </div>
                            </div>
                            <div class=" col-sm-6">
                                <div class="form-group">
                                    <label>Tgl Retouch</label>
                                    <div id="tgl_retouch"></div>
                                </div>
                            </div>

                            <input type="hidden" name="start" class="form-control" id="start" placeholder="Title" <?php if (empty($_GET['tanggal'])) {
                                                                                                                    } else {
                                                                                                                        echo "value=" . $_GET['tanggal'];
                                                                                                                    } ?> readonly="">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Jam</label>
                                    <input type="time" name="start_jam" class="form-control hour" id="start_jam" value="<?= $_GET['jam']; ?>">
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(window).on("load", function() {
                                    var data_start_jam = $(".hour").val();
                                    console.log(data_start_jam);

                                    $.ajax({
                                        type: 'POST',
                                        url: 'functions/hitung-jam.php',
                                        data: {
                                            'start_jam': data_start_jam,
                                        },

                                        success: function(response) {
                                            $('#jam_ends').html(response);
                                        }
                                    });
                                });
                            </script>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Sampai Jam</label>
                                    <div id="jam_ends"></div>
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
                            <div class="col">
                                <div class="form-group">
                                    <label>Pilih Cabang</label>
                                    <select name="id_cabang" id="id_cabang" class="form-control" required="">
                                        <option value=""></option>
                                        <?php
                                        $cabang = ucwords($_GET['cabang']);
                                        $query1 = mysqli_query($link, "SELECT * FROM tbl_cabang WHERE nama_cabang LIKE '%$cabang%'");
                                        foreach ($query1 as $d) { ?>
                                            <option value="<?php echo $d['id_cabang'] ?>" <?php if ($d['nama_cabang'] == "$cabang") {
                                                                                                echo "selected";
                                                                                            } ?>> <?php echo $d['nama_cabang'] ?></option>
                                        <?php } ?>
                                    </select>
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
                                    <select name="id_jabatan" class="form-control" id="id_jabatan">
                                        <option value=""></option>
                                        <option value="1" <?php if (empty(($_GET['id_jabatan']))) {
                                                            } else if ($_GET['id_jabatan'] == '1') {
                                                                echo "selected";
                                                            } ?>> Senior </option>
                                        <option value="2" <?php if (empty(($_GET['id_jabatan']))) {
                                                            } else if ($_GET['id_jabatan'] == '2') {
                                                                echo "selected";
                                                            } ?>> Junior </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Pemasang</label>
                                    <div id="pemasang"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                <h5>Informasi Pembayaran</h5>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="warna" class="form-control" id="color" required="">
                                        <option value=""></option>
                                        <option style="color:#008000;" value="#008000">&#9724; Sudah Bayar / Lunas </option>
                                        <option style="color:#0071c5;" value="#0071c5">&#9724; DP </option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Tunggu DP </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Transfer</label>
                                    <input type="text" name="transfer" class="form-control" id="transfer">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cash</label>
                                    <input type="text" name="cash" class="form-control" id="cash">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <!-- <button type="submit" id="submitData" name="submit" class="btn btn-primary">Simpan</button> -->
                                <div id="submitData"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
                                    <input type="hidden" name="kode_customer" id="kode_customer">
                                    <input type="text" name="nama" class="form-control" id="title" placeholder="Nama Customer">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nomor Whatsapp</label>
                                    <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No Whatsapp">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Pasang</label>
                                    <input type="date" name="start" class="form-control start" id="start" placeholder="Title" readonly="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Retouch</label>
                                    <input type="date" name="tgl_retouch" class="form-control tgl_retouch" id="tgl_retouch" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Jam</label>
                                    <input type="time" name="start_jam" class="form-control start_jam" id="start_jam" placeholder="jam">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Sampai Jam</label>
                                    <input type="time" name="ends_jam" class="form-control hour" id="ends_jam" placeholder="jam">
                                </div>
                            </div>
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
                                    <select name="id_cabang" id="id_cabang" class="form-control id_cabang" required="">
                                        <option value=""></option>
                                        <?php
                                        $cabang = ucwords($_GET['cabang']);
                                        $query1 = mysqli_query($link, "SELECT * FROM tbl_cabang WHERE nama_cabang LIKE '%$cabang%'");
                                        foreach ($query1 as $d) { ?>
                                            <option value="<?php echo $d['id_cabang'] ?>" <?php if ($d['nama_cabang'] == "$cabang") {
                                                                                                echo "selected";
                                                                                            } ?>> <?php echo $d['nama_cabang'] ?></option>
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
                                    <select name="id_produk" id="id_produk" class="form-control id_harga" onchange="changeValueEdit(this.value)" placeholder="Nama Produk">
                                        <option value=""></option>
                                        <?php
                                        $q_produk = mysqli_query($link, "SELECT * FROM tbl_produk");
                                        foreach ($q_produk as $produk) {
                                        ?>
                                            <option value="<?php echo $produk['id_produk'] ?>"> <?php echo $produk['nama_produk'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Produk</label>
                                    <input type="text" name="harga" class="form-control hrg" id="hrg" placeholder="Harga Otomatis Terisi">
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
                                    <!-- <select name="id_jabatan" class="form-control" id="id_jabatan">
                                        <option value=""></option>
                                        <option value="1"> Senior </option>
                                        <option value="2"> Junior </option>
                                    </select> -->
                                    <select name="id_jabatan" class="form-control id_jabatan" id="id_jabatan">
                                        <option value=""></option>
                                        <option value="1" <?php if (empty(($_GET['id_jabatan']))) {
                                                            } else if ($_GET['id_jabatan'] == '1') {
                                                                echo "selected";
                                                            } ?>> Senior </option>
                                        <option value="2" <?php if (empty(($_GET['id_jabatan']))) {
                                                            } else if ($_GET['id_jabatan'] == '2') {
                                                                echo "selected";
                                                            } ?>> Junior </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <!-- <div class="form-group">
                                    <label>Nama Pemasang</label>
                                    <select name="id_users" class="form-control" id="id_users" placeholder="Nama Pemasang">
                                        <option value=""></option>
                                        <?php
                                        $query = mysqli_query($link, "SELECT * FROM tbl_status_kerja a JOIN users b ON b.id_users = a.id_users WHERE b.level = '2'");
                                        foreach ($query as $d) { ?>
                                            <option value="<?php echo $d['id_users'] ?>"> <?php echo $d['username'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label>Nama Pemasang</label>
                                    <!-- <select name="id_users" class="form-control id_users" id="id_users" required="">
                                        <option value=""></option>
                                        <?php
                                        $query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.level = 2");
                                        foreach ($query as $d) { ?>
                                            <option value="<?php echo $d['id_users'] ?>">
                                                <?php echo $d['username'] ?></option>
                                        <?php } ?>

                                    </select> -->
                                    <div id="karyawannya" class="karyawannya"></div>
                                    <script type="text/javascript">
                                        $(window).on("load", function() {
                                            var id_cabang = $(".id_cabang").val();
                                            var tanggal = $(".start").val();
                                            var id_jabatan = $(".id_jabatan").val();

                                            $.ajax({
                                                type: 'POST',
                                                url: 'functions/pilih-pemasang-edit.php',
                                                data: {
                                                    'id_cabang': id_cabang,
                                                    'tanggal': tanggal,
                                                    'id_jabatan': id_jabatan,
                                                },

                                                success: function(response) {
                                                    $('#karyawannya').html(response);
                                                }
                                            });
                                        });
                                    </script>
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
                                <button type="submit" name="edit" class="btn btn-primary" onclick="return confirm('Anda yakin data sudah benar ?')">Simpan</button>
                                <button type="button" class="btn btn-danger" onclick="deletebooking()">Hapus Data</button>
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