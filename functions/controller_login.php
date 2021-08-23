<?php

require_once("core/init.php");

// validasi register
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $pass = $_POST['password'];

    // trim - remove spasi
    if( !empty(trim($username)) && !empty(trim($pass)) ){
        
        if( login_cek_username($username) ){
            if( cek_data($username, $pass) ){

                $myquery  = "SELECT id_users FROM users WHERE username = '$username'";
                $myresult = mysqli_query($link, $myquery);
                //hasil dari fecth assoc adalah array
                $id = mysqli_fetch_assoc($myresult);

                $_SESSION['id_users'] = $id;
                $_SESSION['username'] = $username;

                $query = mysqli_query($link,"SELECT id_users,level,username FROM users WHERE username = '$username'");
                $data = mysqli_fetch_array($query);
                
                if ($data['level'] == 1) {
                    $_SESSION['id'] = $data['id_users'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['level'] = $data['level'];

                    $_SESSION['status'] = "Berhasil";
                    $_SESSION['status_text'] = "Login Berhasil, Anda ke halaman Admin";
                    $_SESSION['status_code'] = "success";
                    header('Location: dashboard');
                }else{
                    $_SESSION['id'] = $id;
                    $_SESSION['level'] = $data['level'];
                    $_SESSION['username'] = $data['username'];

                    $_SESSION['status'] = "Berhasil";
                    $_SESSION['status_text'] = "Login Berhasil, anda akan di arahkan ke halaman Pemasang";
                    $_SESSION['status_code'] = "success";
                    header('Location: dashboard-pemasang');
                }
            }
            else{
                $_SESSION['status'] = "Gagal";
                $_SESSION['status_text'] = "Login Gagal, cek username dan password anda";
                $_SESSION['status_code'] = "error";
                echo "<script>window.history.back()</script>";
            }
        }
        else{
            $_SESSION['status'] = "Gagal";
            $_SESSION['status_text'] = "Username Anda Belum Terdaftar";
            $_SESSION['status_code'] = "error";
            echo "<script>window.history.back()</script>";
        }
    }
    else{
        $_SESSION['status'] = "Gagal";
        $_SESSION['status_text'] = "Inputan Tidak Boleh Kosong";
        $_SESSION['status_code'] = "error";
        echo "<script>window.history.back()</script>";
    }
}