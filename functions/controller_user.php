<?php

function register_user($username, $password, $level, $hari_libur, $id_cabang){
    global $link;

    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $level = mysqli_real_escape_string($link, $level);
    $hari_libur = mysqli_real_escape_string($link, $hari_libur);
    $id_cabang = mysqli_real_escape_string($link, $id_cabang);
    $tanggal = date('Y-m-d');
    // var_dump(array($hari_libur,$id_cabang,$tanggal));die();
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users(username, password, level) VALUES('$username', '$password', '$level')";

    if ( mysqli_query($link, $query) ) {
        $last_id = mysqli_insert_id($link);
        $query_dua = "INSERT INTO tbl_status_kerja(id_users, hari_libur, cabang, tanggal) VALUES($last_id, '$hari_libur', $id_cabang, '$tanggal')";
        $datasquery = mysqli_query($link, $query_dua);
        // var_dump($datasquery); die();
        return true;  
    } else {
        return false;
    }
}

function register_user_edit($id_users, $username, $password, $level, $hari_libur, $id_cabang){
    global $link;

    $id_users = mysqli_real_escape_string($link, $id_users);
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $level = mysqli_real_escape_string($link, $level);
    // $hari_libur = mysqli_real_escape_string($link, $hari_libur);
    // $tanggal = date('Y-m-d');
    // $id_cabang = mysqli_real_escape_string($link, $id_cabang);
    
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "UPDATE users SET username='$username', password='$password', level='$level' WHERE id_users = $id_users";

    if( mysqli_query($link, $query) ) {
        // $query_dua = "UPDATE tbl_status_kerja SET hari_libur = '$hari_libur', cabang=$id_cabang WHERE id_users = $id_users";
        // mysqli_query($link, $query_dua);
        return true;
    } else {
        return false;
    }
}
// cegah duplikasi username
function register_cek_username($username){
    global $link;
    // mencegah sql injection
    $username = mysqli_real_escape_string($link, $username);

    $query = "SELECT * FROM users where username = '$username'";

    if($result = mysqli_query($link, $query)){
        if(mysqli_num_rows($result) == 0) return true;
        else return false;
    }

}

// cek nama terdaftar / belum
function login_cek_username($username){
    global $link;

    $username = mysqli_real_escape_string($link, $username);

    $query = "SELECT * FROM users where username = '$username'";

    if($result = mysqli_query($link, $query)){
        if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }
}

// cek password Login
function cek_data($username, $pass){
    global $link;
    // mencegah sql injection
    $username = mysqli_real_escape_string($link, $username);
    $pass = mysqli_real_escape_string($link, $pass);

    $query = "SELECT password FROM users WHERE username = '$username'";

    $result = mysqli_query($link, $query);
    $hash = mysqli_fetch_assoc($result);

    if( password_verify($pass, $hash['password']) ) return true;
    else return false;
}

// clear all session
function logout($session){
    unset($session);
    session_destroy();
}