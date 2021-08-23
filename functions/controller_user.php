<?php

function register_user($username, $password, $level){
    global $link;

    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $level = mysqli_real_escape_string($link, $level);
    
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users(username, password, level) VALUES('$username', '$password', '$level')";

    if( mysqli_query($link, $query) ) return true;
    else return false;
}

function register_user_edit($id_users,$username, $password, $level){
    global $link;

    $id_users = mysqli_real_escape_string($link, $id_users);
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $level = mysqli_real_escape_string($link, $level);
    
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "UPDATE users SET username='$username', password='$password', level='$level' WHERE id_users = $id_users";

    if( mysqli_query($link, $query) ) return true;
    else return false;
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