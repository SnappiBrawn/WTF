<?php 
include "classes/Connection.php";

$conn = Connection::getInstance();
$list = [];
$item = $_POST["search"];
if($_POST["morals"]!==""){
    $item = $_POST["search"];
    $veg=$_POST["morals"];
    
    if($item == ""){
        $res = $conn->query("select * from recipes where rep_Morals=".$veg." order by rep_Likes desc");
    }
    else{
        $qry = "select * from recipes where rep_Morals=".$veg." and rep_Name like '%".$item."%' order by rep_Likes desc";
        $res=$conn->query($qry);
    }
}
else{
    if($item == ""){
        $res = $conn->query("select * from recipes order by rep_Likes desc");
    }
    else{
        $qry = "select * from recipes where rep_Name like '%".$item."%' order by rep_Likes desc";
        $res=$conn->query($qry);
    }
}
foreach($res as $rep){
    array_push($list,$rep);
}
$ret = json_encode($list);
echo $ret;

?>