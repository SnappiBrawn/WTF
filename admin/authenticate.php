<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

$qry = "select * from admin where username=? and password=?";
$exec = $conn->prepare($qry);

$exec->execute([$_POST['id'],md5($_POST['pword'])]);
$res = $exec->fetchAll();

if(sizeof($res)==1){
    $_SESSION['admin']=$_POST['id'];
    $_SESSION['display']=$res[0][2];
    echo "1";
    
}
else{
    echo "0";
}

?>