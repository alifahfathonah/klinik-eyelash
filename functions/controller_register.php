<?php

require_once("../model/db.php");
require_once("controller_user.php");

// validasi register
if(isset($_POST['username']) ){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    
    // trim - remove spasi
    if( !empty(trim($username)) && !empty(trim($password)) && !empty(trim($level)) ){

        if(register_cek_username($username)){

            if(register_user($username, $password, $level)){
                echo "sukses";
            }
            else{
                echo "gagal";
            }
        }
        else{
            echo "usernameUse";
            }
    }
    else{
            echo "tidakbolehkosong";
        }
}