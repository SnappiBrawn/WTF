<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();


if($_POST["what"]==="recipes"){
    $qry="select * from recipes where rep_Name like ? or rep_Owner like ? order by rep_Name";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST["key"]."%","%".$_POST["key"]."%"]);
    $rcps = $exec->fetchAll();
}

if($_POST["what"]==="ingredients"){
    $qry="select * from ingredients where ing_Name like ? order by ing_Name";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST["key"]."%"]);
    $rcps = $exec->fetchAll();
}
if($_POST["what"]==="proposals"){
    $qry="select * from proposed_recipes where rep_Name like ? or rep_Owner like ? order by rep_Name";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST["key"]."%","%".$_POST["key"]."%"]);
    $rcps = $exec->fetchAll();
}

if($_POST["what"]==="users"){
    $qry="select * from users where users_Name like ? or users_Email like ?";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST["key"]."%","%".$_POST["key"]."%"]);
    $rcps = $exec->fetchAll();
}

echo json_encode($rcps);

?>