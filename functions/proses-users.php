<?php

require_once("../model/db.php");
require_once("controller_user.php");
session_start();

// validasi register
if(isset($_POST['submit']) ){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hari_libur = $_POST['hari_libur'];
    $id_cabang = $_POST['id_cabang'];
    $level = $_POST['level'];
    $id_jabatan = $_POST['id_jabatan'];
    
    // trim - remove spasi
    if( !empty(trim($username)) && !empty(trim($password)) && !empty(trim($level)) ){

        if(register_cek_username($username)){

            if(register_user($username, $password, $level, $hari_libur, $id_cabang, $id_jabatan)){
                $_SESSION['status'] = "Berhasil";
                $_SESSION['status_text'] = "Users Berhasil Di Tambahkan";
                $_SESSION['status_code'] = "success";
                header("location: ../users"); 
            }
            else{
                $_SESSION['status'] = "Gagal";
                $_SESSION['status_text'] = "Users Gagal Di Tambahkan";
                $_SESSION['status_code'] = "error";
                header("location: ../users"); 
            }
        }
        else{
            $_SESSION['status'] = "Gagal";
            $_SESSION['status_text'] = "Usersname Sudah Digunakan";
            $_SESSION['status_code'] = "error";
            header("location: ../users"); 
            }
    }
    else{
            $_SESSION['status'] = "Gagal";
            $_SESSION['status_text'] = "Mohon Lengkapi Form !";
            $_SESSION['status_code'] = "error";
            header("location: ../users"); 
        }
}

if(isset($_POST['edit']) ){
    $id_users = $_POST['id_users'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hari_libur = $_POST['hari_libur'];
    $id_cabang = $_POST['id_cabang'];
    $level = $_POST['level'];
    
    // trim - remove spasi
    if( !empty(trim($username)) && !empty(trim($password)) && !empty(trim($level)) ){

        if(register_cek_username($username)){

            if(register_user_edit($id_users,$username, $password, $level, $hari_libur, $id_cabang, $id_jabatan)){
                $_SESSION['status'] = "Berhasil";
                $_SESSION['status_text'] = "Users Berhasil Di Edit";
                $_SESSION['status_code'] = "success";
                header("location: ../users"); 
            }
            else{
                $_SESSION['status'] = "Gagal";
                $_SESSION['status_text'] = "Users Gagal Di Edit";
                $_SESSION['status_code'] = "error";
                header("location: ../users"); 
            }
        }
        else{
            $_SESSION['status'] = "Gagal";
            $_SESSION['status_text'] = "Usersname Sudah Digunakan";
            $_SESSION['status_code'] = "error";
            header("location: ../users"); 
            }
    }
    else{
            $_SESSION['status'] = "Gagal";
            $_SESSION['status_text'] = "Mohon Lengkapi Form !";
            $_SESSION['status_code'] = "error";
            header("location: ../users"); 
        }
}

if (isset($_POST['info_karyawan'])) {
    $id_users = $_POST['id_users'];
    $username = $_POST['username'];
    $hari_libur = $_POST['hari_libur'];
    $id_cabang = $_POST['id_cabang'];
    $id_jabatan = $_POST['id_jabatan'];
    $tanggal = date('Y-m-d');

    $sql = "UPDATE tbl_status_kerja SET hari_libur='$hari_libur', cabang = '$id_cabang', tanggal = '$tanggal', id_jabatan='$id_jabatan' WHERE id_users = $id_users";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Informasi karyawan berhasil di rubah";
      $_SESSION['status_code'] = "success";
      header("location: ../informasi-karyawan");   

    }else{
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Informasi karyawan gagal di rubah";
      $_SESSION['status_code'] = "error";
      header("location: ../informasi-karyawan");   
    }
}