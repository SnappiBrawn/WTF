<?php 

// only used by the quick approve button on the Proposals pages

session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();

$prop = $_POST["which"];

$rep = $conn->query("select * from proposed_recipes where rep_Token='".$prop."'")->fetch();

$qry = "insert into recipes values(?,?,?,?,?,?,?,?,?,?)";
$exec = $conn->prepare($qry);
$exec->execute(
    [$rep[0],
    $rep[1],
    $rep[2],
    $rep[3],
    $rep[4],
    $rep[5],
    $rep[6],
    $rep[7],
    $rep[8],
    0]);

$conn->query("delete from proposed_recipes where rep_Token='".$prop."'");

echo "Item added.";
?>