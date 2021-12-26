<?php
// include database connection file
include("../model/db.php");

$tanggal_complain = $_POST['tgl_complain'];
$no = 1;

if ($tanggal_complain != "" || $tanggal_complain != null) {
    $qdata = "SELECT a.*, b.id as id_events, b.start, c.*, d.nama_cabang, e.username FROM komplain a
										LEFT JOIN events b ON a.id_pemesanan = b.id
										LEFT JOIN tbl_customer c ON a.kode_customer = c.kode_customer
										LEFT JOIN tbl_cabang d ON b.id_cabang = d.id_cabang
										LEFT JOIN users e ON b.id_users = e.id_users
                                        WHERE b.start = '$tanggal_complain'
										ORDER BY a.date_created DESC";
} else {
    $qdata = "SELECT a.*, b.id as id_events, b.start, c.*, d.nama_cabang, e.username FROM komplain a
										LEFT JOIN events b ON a.id_pemesanan = b.id
										LEFT JOIN tbl_customer c ON a.kode_customer = c.kode_customer
										LEFT JOIN tbl_cabang d ON b.id_cabang = d.id_cabang
										LEFT JOIN users e ON b.id_users = e.id_users
										ORDER BY a.date_created DESC";
}
$query = mysqli_query($link, $qdata); ?>
<div class="dt-responsive table-responsive">
    <table id="user-list-table-komplain" class="table nowrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Pemasang</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Komplain</th>
                <!-- <th></th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($query as $data) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nama_cabang'] ?></td>
                    <td><?php echo $data['username'] ?></td>
                    <td><?php echo date('d F Y', strtotime($data['start'])); ?></td>
                    <td><?php echo $data['nama_customer'] ?></td>
                    <td><?php echo $data['komplain'] ?></td>
                </tr>

            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Pemasang</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Komplain</th>
                <!-- <th></th> -->
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#user-list-table-komplain').DataTable();
    });
</script>