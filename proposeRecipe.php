<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();

$proposal = json_decode($_POST["data"],true)[0];

$qry = "insert into proposed_recipes values(?,?,?,?,?,?,?,?)";
$exec = $conn->prepare($qry);
$exec->execute(
    [$proposal['Name'],
    $_SESSION['current_user'],
    $proposal['Time'],
    $proposal['Morals'],
    $proposal['Desc'],
    $proposal['Ing'],
    $proposal['Image'],
    $proposal['Gallery']]);
    
?>