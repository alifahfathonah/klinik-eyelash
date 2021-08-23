<?php 

// include database connection file
require_once("../model/db.php");
session_start();

if (isset($_POST['id_produk'])) {
	$id_produk = $_POST['id_produk'];

	$result = mysqli_query($link, "DELETE FROM tbl_produk WHERE id_produk = $id_produk");

	if($result){
		header("location: ../produk"); 
	}else{
		header("location: ../produk"); 
	}
}

if (isset($_POST['id_tipe'])) {
	$id_tipe = $_POST['id_tipe'];

	$result = mysqli_query($link, "DELETE FROM tbl_tipe WHERE id_tipe = $id_tipe");

	if($result){
		header("location: ../produk"); 
	}else{
		header("location: ../produk"); 
	}
}

if (isset($_POST['id_cabang'])) {
	$id_cabang = $_POST['id_cabang'];

	$result = mysqli_query($link, "DELETE FROM tbl_cabang WHERE id_cabang = $id_cabang");

	if($result){
		header("location: ../cabang"); 
	}else{
		header("location: ../cabang"); 
	}
}

if (isset($_POST['id_booking'])) {
	$id_booking = $_POST['id_booking'];

	$result = mysqli_query($link, "DELETE FROM events WHERE id = $id_booking");

	if($result){
		header("location: ../dashboard"); 
	}else{
		header("location: ../dashboard"); 
	}
}

if (isset($_POST['id_users'])) {
	$id_users = $_POST['id_users'];

	$result = mysqli_query($link, "DELETE FROM users WHERE id_users = $id_users");

	if($result){
		header("location: ../users"); 
	}else{
		header("location: ../users"); 
	}
}