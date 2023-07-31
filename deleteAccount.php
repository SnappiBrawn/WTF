<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

$qry = "delete from users where users_Name = ?;";
$exec = $conn->prepare($qry);
$exec->execute([$_SESSION['current_user']]);
unset($_SESSION['current_user']);
unset($_SESSION['loggedin']);
echo "Membership Terminated Successfully.";
?>