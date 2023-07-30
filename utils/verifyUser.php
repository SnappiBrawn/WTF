<?php
    session_start();

    include "../classes/Connection.php";


    $username = $_POST['uname'];
    $code = md5($_POST['code']);
    
    $conn = Connection::getInstance();
    $qry = "select * from inactivate_users where username=? and activation_code=?";
    $exec = $conn->prepare($qry);
    $exec->execute([$username,$code]);
    if(sizeof($exec->fetchAll())==1){
        echo "User Successfully verified";
        $conn->query("delete from inactivate_users where username='$username'");
        $_SESSION['loggedin']="true";
        $_SESSION['current_user'] = $_POST['uname'];
    }
    else{
        unset($_SESSION['current_user']);
        unset($_SESSION['loggedin']);
        echo "Incorrect OTP";
    }

?>