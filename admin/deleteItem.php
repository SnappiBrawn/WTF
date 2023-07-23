<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

if($_POST['what']==="recipe"){
    $qry = "delete from recipes where rep_Id = ?;";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['which']]);
}
if($_POST['what']==="ingredient"){
    $qry = "delete from ingredients where ing_ID = ?;";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['which']]);
}
if($_POST['what']==="proposal"){
    $qry = "delete from proposed_recipes where rep_Token = ?;";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['which']]);
}

echo "Item Deleted Successfully."

?>