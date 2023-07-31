<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();
$pass = $_POST['pword'];
$encpass = md5($pass);

$qry = "update users set users_Password = ? where users_Name = ?";
$exec = $conn->prepare($qry);
$exec->execute([$encpass,$_SESSION['current_user']]);

echo "Password updated successfully";
?>