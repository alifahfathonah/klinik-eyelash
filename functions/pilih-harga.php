<?php
include "../model/db.php";
$id_produk = $_POST['id_produk'];
$query = mysqli_query($link, "SELECT * FROM tbl_produk WHERE id_produk = $id_produk");
$data = mysqli_fetch_array($query);
?>
<input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Otomatis Terisi" value="<?= $data['harga'] ?>">