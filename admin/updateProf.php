<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();
if($_POST['which']==="profile"){
    $qry = "update admin set profile=? where username=?";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['what'],$_SESSION['admin']]);
    $_SESSION['display'] = $_POST['what'];
}
if($_POST['which']==="pass"){
    $qry = "update admin set password=? where username=?";
    $exec = $conn->prepare($qry);
    $exec->execute([md5($_POST['what']),$_SESSION['admin']]);
}
?>