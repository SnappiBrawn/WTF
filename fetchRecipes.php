<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();

$items = $_POST["fetchfor"];
$list = [];

if(isset($_SESSION["current_user"])){
    $user = $_SESSION["current_user"];
    $res = $conn->query("select users_Favourites from users where users_Name ='$user'")->fetchColumn();
    $faves = explode(",",$res);
}
else{
    $faves=[];
}

if($items == ""){
    $res = $conn->query("select * from recipes order by rep_Likes desc limit 8");
    foreach($res as $rep){
        array_push($list,$rep);
    }
}
else{
    // compare for each recipe, if its ingredients have any of the given ingredients
    $items = explode(",", $_POST["fetchfor"]);
    foreach($items as $item){
        $qry = "select * from recipes where FIND_IN_SET('".$item."',rep_Ingredients) order by rep_Likes desc LIMIT 8";
        $res=$conn->query($qry);
        foreach($res as $rep){
            array_push($list,$rep);
        }
    }
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