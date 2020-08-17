<?php
    include_once("phpfunction/fileSystem.php");
    include_once("phpfunction/database.php");

    getConnect();

    if (empty($_POST)) {
        exit("data exceed post_max_size! <br>");
    }

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if ($password != $confirmPassword) {
        exit("Password not same！");
    }

    $name = $_POST['name'];
    if (empty($_POST['name'])) {
        exit("Name cannot be empty!");
    }
    $userNameSQL = "select * from user where name = '$name'";
    $userNameSQL = mysqli_real_escape_string($databaseConnection, $userNameSQL);
    $resultSet = mysqli_query($databaseConnection, $userNameSQL);
    if ($resultSet) {
        exit("User name exists");
    }

    $email = $_POST['email'];
    if (empty($_POST['email'])) {
        exit("Email cannot be empty!");
    }
    $emailSQL = "select * from user where email = '$email'";
    #$emailSQL = mysqli_real_escape_string($databaseConnection, $emailSQL);
    $resultSet = mysqli_query($databaseConnection, $emailSQL);
    if (!$resultSet) {
        exit("Eail name exists");
    }

    $address = $_POST['address'];

    $profile = $_POST['profile'];

    $maxResult = mysqli_query($databaseConnection, "select max(`uid`) from user");
    $maxuid = mysqli_fetch_array($maxResult)[0];
    $uid = $maxuid + 1;

    $insertSQL = "insert into `user`(`uid`,`name`,`password`,`email`,`address`,`profile`,`lastlogin`) values ($uid,'$name','$password','$email','$address','$profile',current_timestamp)";
    $settingSQL = "insert into `setting`(`uid`,`emailntf`,`fntf`,`nntf`,`hntf`,`bntf`) values ($uid,true,true,true,true,true)";
    if (mysqli_query($databaseConnection, $insertSQL)){
        mysqli_query($databaseConnection, $settingSQL);
        echo "success";
        echo "<br />";
        echo "<a href='login.html'><input type='button' value='login'></a>";
    } else{
        exit("fail to sign up");
    }
    closeConnect();