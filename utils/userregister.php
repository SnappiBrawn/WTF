<?php
    session_start();

    include "../classes/Connection.php";
    include "../classes/user.php";

    $username = $_POST["uname"];
    $password = $_POST["pword"];
    $encpassword = md5($_POST["pword"]);
    $email = $_POST["email"];

    if($username=="" || $password=="" || $email==""){
        echo "All fields are mandatory!";
    }
    else{
        $conn = Connection::getInstance();
        $qry = "insert into users values('$email','$username','$encpassword','');";
        $conn->query($qry);
        $user = new User($username,$password);
        $_SESSION['loggedin']="true";
        $_SESSION['current_user'] = $user->getName();
    }
?>