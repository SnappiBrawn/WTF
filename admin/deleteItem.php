<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

if($_POST['what']==="recipe"){
    $qry = "delete from recipes where rep_Id = ?;";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['which']]);
    echo "Recipe Deleted Successfully.";
}
if($_POST['what']==="ingredient"){
    $qry = "delete from ingredients where ing_ID = ?;";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['which']]);
    echo "Ingredient Deleted Successfully.";
}
if($_POST['what']==="proposal"){
    $qry = "delete from proposed_recipes where rep_Token = ?;";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['which']]);
    echo "Recipe Proposal Deleted Successfully.";
}

if($_POST['what']==="users"){
    $qry = "delete from users where users_Name = ?;";
    $exec = $conn->prepare($qry);
    $exec->execute([$_POST['which']]);
    echo "User Terminated Successfully.";
}



?>