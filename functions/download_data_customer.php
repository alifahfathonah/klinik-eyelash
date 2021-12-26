<?php
include("../model/db.php");
$tanggal = date('d F Y');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Customer - " . $tanggal . ".xls");
?>

<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Lokasi</th>
			<th>Pemasang</th>
			<th>Hari</th>
			<th>Tanggal</th>
			<th>Jam</th>
			<th>Nama</th>
			<th>No HP</th>
			<th>Status</th>
			<th>Tanggal Retouch</th>
			<th>Sumber</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Transfer</th>
			<th>Cash</th>
			<th>Keterangan</th>
			<th>Komplain</th>
			<th>Penyebab</th>
			<th>Solusi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$tanggal_awal = $_POST['tanggal_awal'];
		$tanggal_akhir = $_POST['tanggal_akhir'];
		$no = 1;
		$tgl = date('Y-m-d');
		$query = mysqli_query($link, "SELECT a.*, a.id as id_events, c.nama_cabang, b.username, e.nama_tipe, d.harga, d.nama_produk, f.*, g.*
			FROM events a 
			LEFT JOIN users b ON a.id_users = b.id_users
			LEFT JOIN tbl_cabang c ON a.id_cabang = c.id_cabang
			LEFT JOIN tbl_produk d ON a.id_produk = d.id_produk
			LEFT JOIN tbl_tipe e ON a.id_tipe = e.id_tipe
			LEFT JOIN tbl_customer f ON f.kode_customer = a.kode_customer
			LEFT JOIN komplain g ON g.id_pemesanan = a.id
			WHERE start BETWEEN '" . $tanggal_awal . "' AND  '" . $tanggal_akhir . "'
			ORDER BY f.kode_customer ASC");
		foreach ($query as $data) {

			$daftar_hari = array(
				'Sunday' => 'Minggu',
				'Monday' => 'Senin',
				'Tuesday' => 'Selasa',
				'Wednesday' => 'Rabu',
				'Thursday' => 'Kamis',
				'Friday' => 'Jumat',
				'Saturday' => 'Sabtu'
			);

			$hari = date('l', strtotime($data['start']));
			$tanggal = date('d F Y', strtotime($data['start']));
			$tanggal_retouch = date('d F Y', strtotime($data['tgl_retouch']));
		?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $data['nama_cabang'] ?></td>
				<td><?php echo $data['username'] ?></td>
				<td><?php echo $daftar_hari[$hari] ?></td>
				<td>'<?php echo $tanggal ?></td>
				<td><?php echo $data['start_jam'] ?> - <?php echo $data['ends_jam'] ?></td>
				<td><?php echo $data['nama_customer'] ?></td>
				<td>'<?php echo $data['no_telp'] ?></td>
				<td style="background-color: <?php echo $data['warna'] ?>; color: #ffffff;">
					<?php if ($data['warna'] == "#008000") { ?>
						Sudah Bayar / Lunas
					<?php } else if ($data['warna'] == "#0071c5") { ?>
						DP
					<?php } else if ($data['warna'] == "#FF0000") { ?>
						Tunggu DP
					<?php } ?>
				</td>
				<td>'<?php echo $tanggal_retouch ?></td>
				<td><?php echo $data['sumber'] ?></td>
				<td><?php echo $data['nama_produk'] ?></td>
				<td style="background: #4680ff;color: #fff;">Rp. <?php echo number_format($data['harga']); ?></td>
				<td style="background: #9ccc65;color: #fff;">
					<?php if ($data['transfer'] == true) { ?>
						Rp. <?php echo number_format($data['transfer']); ?>
					<?php } else {
						echo "-";
					} ?>
				</td>
				<td style="background: #9ccc65;color: #fff;">
					<?php if ($data['cash'] == true) { ?>
						Rp. <?php echo number_format($data['cash']); ?>
					<?php } else {
						echo "-";
					} ?>
				</td>
				<td><?php echo $data['keterangan'] ?></td>
				<td><?php echo $data['komplain'] ?></td>
				<td><?php echo $data['penyebab'] ?></td>
				<td><?php echo $data['solusi'] ?></td>
			</tr>

		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th>No</th>
			<th>Lokasi</th>
			<th>Pemasang</th>
			<th>Hari</th>
			<th>Tanggal</th>
			<th>Jam</th>
			<th>Nama</th>
			<th>Kode Customer</th>
			<th>Status</th>
			<th>Nama Produk</th>
			<th>Jenis</th>
			<th>Tanggal Retouch</th>
			<th>Sumber</th>
			<th>Harga</th>
			<th>Transfer</th>
			<th>Cash</th>
			<th>Keterangan</th>
			<th>Komplain</th>
			<th>Penyebab</th>
			<th>Solusi</th>
		</tr>
	</tfoot>
</table>