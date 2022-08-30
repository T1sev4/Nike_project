<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";
    //проверяем пришли ли данные
    if(
        isset($_POST["email"]) && strlen($_POST["email"]) > 0 &&
        isset($_POST["password"]) && strlen($_POST["password"]) > 0 &&
        isset($_POST["firstName"]) && strlen($_POST["firstName"]) > 0 &&
        isset($_POST["secondName"]) && strlen($_POST["secondName"]) > 0
    ){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $firstName = $_POST["firstName"];
        $secondName = $_POST["secondName"];
        //хэширование пароля
        $check_user = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($check_user) == true){
            header("Location: $BASE_URL/register.php?error=2");
            exit();
        }
        $hash = sha1($password);
        mysqli_query($con, "INSERT INTO users (email, password, first_name, last_name) VALUES ('$email', '$hash', '$firstName', '$secondName')");   
        header("Location:$BASE_URL/login.php");
    }
    else{
        header("Location:$BASE_URL/register.php?error=1");
        exit();
    }