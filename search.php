<?php
    include "classes/Connection.php";
    $con = Connection::getInstance();
    $res = $con->query("select * from ingredients where ing_Name like '%".$_POST["searchkey"]."%'");
    $list=[];
    foreach($res as $val)
        array_push($list,[$val[0],$val[1]]);
    $ret = json_encode($list);
    echo $ret;
?>