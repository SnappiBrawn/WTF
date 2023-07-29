<?php
    include "classes/Connection.php";
    $conn = Connection::getInstance();
    $qry = "select * from ingredients where ing_Name like ?";
    $exec = $conn->prepare($qry);
    $exec->execute(["%".$_POST['searchkey']."%"]);
    $res = $exec->fetchAll();
    $list=[];
    foreach($res as $val)
        array_push($list,[$val[0],$val[1]]);
    $ret = json_encode($list);
    echo $ret;
?>