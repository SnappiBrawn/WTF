<?php 
session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();
$list = [];

if(isset($_SESSION["current_user"])){
    $user = $_SESSION["current_user"];
    $res = $conn->query("select users_Favourites from users where users_Name ='$user'")->fetchColumn();
    $faves = explode(",",$res);
}
else{
    $faves=[];
}

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

foreach($list as &$e){
    if (in_array($e[0],$faves)){
        $e[10] = "1";
    }
    else{
        $e[10] = "0";
    }

}

$ret = json_encode($list);
echo $ret;

?>