<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

$qry="select * from proposed_recipes where rep_Name like ? and rep_Owner = ? order by rep_Name";
$exec = $conn->prepare($qry);
$exec->execute(["%".$_POST["key"]."%",$_SESSION['current_user']]);
$rcps[0] = $exec->fetchAll();

$qry="select * from recipes where rep_Name like ? and rep_Owner = ? order by rep_Name";
$exec = $conn->prepare($qry);
$exec->execute(["%".$_POST["key"]."%",$_SESSION['current_user']]);
$rcps[1] = $exec->fetchAll();

echo json_encode($rcps);

?>