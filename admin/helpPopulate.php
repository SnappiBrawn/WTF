<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();


if($_POST["what"]==="recipes"){
    $qry="select * from recipes where rep_Name like ? order by rep_Name";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST["key"]."%"]);
    $rcps = $exec->fetchAll();
}

if($_POST["what"]==="ingredients"){
    $qry="select * from ingredients where ing_Name like ? order by ing_Name";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST["key"]."%"]);
    $rcps = $exec->fetchAll();
}
if($_POST["what"]==="proposals"){
    $qry="select * from proposed_recipes where rep_Name like ? order by rep_Name";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST["key"]."%"]);
    $rcps = $exec->fetchAll();
}

echo json_encode($rcps);

?>