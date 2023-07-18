<?php 
include "classes/Connection.php";

$conn = Connection::getInstance();

$items = $_POST["fetchfor"];

if($items == ""){
    $res = $conn->query("select * from recipes order by rep_Likes");
    $list = [];
    foreach($res as $rep){
        array_push($list,$rep);
    }
}
else{
    // compare for each recipe, if its ingredients have any of the given ingredients
    $items = explode(",", $_POST["fetchfor"]);
    $list = [];
    foreach($items as $item){
        $qry = "select * from recipes where FIND_IN_SET('".$item."',rep_Ingredients)";
        $res=$conn->query($qry);
        foreach($res as $rep){
            array_push($list,$rep);
        }
    }
}
$ret = json_encode($list);
echo $ret;

?>