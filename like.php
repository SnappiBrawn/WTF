<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();
$user = $_SESSION["current_user"];
$what = $_POST["id"];
$action = $_POST["action"];
$likes = explode(",",$conn->query("select users_Favourites from users where users_Name = '$user'")->fetchColumn());

if($action == "add"){
    array_push($likes,$what);
}
else{
    $likes = array_diff($likes,array($what));
}

$likes = implode(",",$likes);
$conn->query("update users set users_Favourites = '$likes' where users_Name = '$user'");

echo $likes;
?>