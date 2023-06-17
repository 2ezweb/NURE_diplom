<?php
    require_once('./functions.php');
    require_once('./connection.php');

    if(isset($_POST['login']) && isset($_POST['password'])){
        $mail = get_post($conn, 'login');
        $password = get_post($conn, 'password');
        $result = $conn -> query("SELECT mail FROM student WHERE mail='$mail'");
        $username_db = $result -> fetch_assoc()['mail'];
        $result = $conn -> query("SELECT password FROM student WHERE password='$password'");
        $password_db = $result -> fetch_assoc()['password'];
        if(($mail == $username_db) && ($password == $password_db)){
            setcookie('login_status', true, 0, '/');
            setcookie('user', $mail, 0, '/');
            echo '<script> document.location.href=\'../index.php\';</script>';
        }
        else{
            echo '<script> document.location.href=\'../login.php\';</script>';
        }
    }
?>