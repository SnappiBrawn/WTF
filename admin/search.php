<?php
    include "classes/Connection.php";
    $conn = Connection::getInstance();
    $qry = "select * from ingredients where ing_Name like '%".$_POST["searchkey"]."%'";
    $res = $conn->query($qry);
    $list=[];
    foreach($res as $val)
        array_push($list,[$val[0],$val[1]]);
    $ret = json_encode($list);
    echo $ret;
?>