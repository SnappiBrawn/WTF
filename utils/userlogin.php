<?php
    session_start();

    include "../classes/user.php";

    $username = $_POST["uname"];
    $password = $_POST["pword"];

    if($username==""){
        echo "Username is empty!";
    }
    else{
        $user = new User($username, $password);
        if(gettype($user)==="string"){
            echo "Invalid user details";
        }
        else{
            $_SESSION['current_user'] = $user->getName();
            $_SESSION["loggedin"] = "true";
        }
    }
?>