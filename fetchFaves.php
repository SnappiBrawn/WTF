<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();
$user = $_SESSION["current_user"];
$key = $_POST['key'];
$qry = "select users_Favourites from users where users_Name = ?";
$exec = $conn->prepare($qry);
$exec->execute([$user]);
$favourites = $exec->fetchColumn();

$list = [];

$qry="select * from recipes where rep_Name like ? and FIND_IN_SET(rep_Id,'$favourites')";
$exec= $conn->prepare($qry);
$exec->execute(["%$key%"]);

foreach($exec->fetchAll() as $rep){
    array_push($list,$rep);
}
$ret = json_encode($list);
echo $ret;

?>