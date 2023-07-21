<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();
$user = $_SESSION["current_user"];
$key = $_POST['key'];
$qry = "select users_Favourites from users where users_Name like '$user'";
$favourites = $conn->query($qry)->fetch();

$list = [];

foreach($conn->query("select * from recipes where rep_Name like '%$key%' and FIND_IN_SET(rep_Id,'$favourites[0]')") as $rep){
    array_push($list,$rep);
}
$ret = json_encode($list);
echo $ret;

?>