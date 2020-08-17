<?php
    include_once("phpfunction/database.php");
    session_start();

    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    getConnect();
    $loginSQL = "select uid from user where email='$email' and password='$password'";
    $resultLogin = mysqli_query($databaseConnection, $loginSQL);
    if (mysqli_num_rows($resultLogin) > 0) {
        $uid = mysqli_fetch_array($resultLogin)[0];
        $_SESSION["uid"]=$uid;
        $timeSQL = "update user set lastlogin=current_timestamp where uid=$uid";
        mysqli_query($databaseConnection, $timeSQL);
        Header("Location:home.php");
    } else {
        echo "login fail";
    }
    closeConnect();
?>