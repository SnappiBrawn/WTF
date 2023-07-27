<?php 
session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();
$list = [];
$item = $_POST["search"];

if($item == ""){
    $res = $conn->query("select * from ingredients order by ing_Name");
}
else{
    $qry = "select * from ingredients where ing_Name like ? order by ing_Name";
    $exec = $conn->prepare($qry);
    $exec->execute(["%$item%"]);
    $res = $exec->fetchAll();
}

foreach($res as $rep){
    array_push($list,$rep);
}

$ret = json_encode($list);
echo $ret;

?>