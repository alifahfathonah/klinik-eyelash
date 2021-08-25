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
$sql = "SELECT a.* FROM events a ORDER BY a.id ASC";
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

<body onload="<?php if ($_GET['popup'] == 1) {
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
                                <div id="calendar" class="col-centered">
                                </div>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Pasang</label>
                                    <!-- <?php
                                            // $date = date("Y-m-d");
                                            // $tgl_booking = date('d F Y', strtotime($date));
                                            ?>    -->
                                    <input type="date" name="start" class="form-control" id="start" placeholder="Title" value="<?= $_GET['tanggal'] ?>" disabled="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tgl Retouch</label>
                                    <div id="tgl_retouch"></div>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Jam</label>
                                    <input type="time" name="start_jam" class="form-control hour" id="start_jam" value="<?= $_GET['jam']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Sampai Jam</label>
                                    <!-- <input type="time" name="ends_jam" class="form-control hour" id="ends_jam"> -->
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
                                    <select name="id_cabang" class="form-control" required="">
                                        <option value=""></option>
                                        <?php
                                        $cabang = ucwords($_GET['cabang']);
                                        $query1 = mysqli_query($link, "SELECT * FROM tbl_cabang WHERE nama_cabang LIKE '%$cabang%'");
                                        foreach ($query1 as $d) {
                                        ?>

                                            <option value="<?php echo $d['id_cabang'] ?>" <?php if ($d['nama_cabang'] == "$cabang") {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                <?php echo $d['nama_cabang'] ?></option>
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
                                    <select name="id_users" class="form-control" id="id_users" required="">
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
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
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
                                    <input type="time" name="start_jam" class="form-control hour" id="start_jam" placeholder="jam">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Sampai Jam</label>
                                    <input type="time" name="ends_jam" class="form-control hour" id="ends_jam" placeholder="jam">
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
                                        $cabang = ucwords($_GET['cabang']);
                                        $query1 = mysqli_query($link, "SELECT * FROM tbl_cabang WHERE nama_cabang LIKE '%$cabang%'");
                                        foreach ($query1 as $d) {
                                        ?>
                                            <option value="<?php echo $d['id_cabang'] ?>" <?php if ($d['nama_cabang'] == "$cabang") {
                                                                                                echo "selected";
                                                                                            } ?>>
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
                                        <?php
                                        $barang = mysqli_query($link, "SELECT * FROM tbl_produk");
                                        $jsArray = "var hrg_brg = new Array();\n";

                                        if (mysqli_num_rows($barang)) { ?>
                                            <?php while ($row_brg = mysqli_fetch_array($barang)) { ?>
                                                <option value="<?php echo $row_brg["id_produk"] ?>"> <?php echo $row_brg["nama_produk"] ?> </option>
                                            <?php $jsArray .= "hrg_brg['" . $row_brg['id_produk'] . "'] = {harga:'" . addslashes($row_brg['harga']) . "'};\n";
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



    <?php
    include 'views/footer.php';
    ?>