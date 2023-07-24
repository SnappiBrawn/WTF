<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();

$rep = json_decode($_POST["data"],true)[0];

if($_POST['type']==="add" || $_POST['type']==="approve"){
    $qry = "insert into recipes values(?,?,?,?,?,?,?,?,?,?)";
}
else{
    $qry = "UPDATE `recipes` SET `rep_Id`=?,`rep_Name`=?,`rep_Owner`=?,`rep_Time`=?,`rep_Morals`=?,`rep_Description`=?,`rep_Ingredients`=?,`rep_Image`=?,`rep_Gallery`=?,`rep_Likes`=? WHERE rep_Id ='".$rep["Id"]."'";
}

$exec = $conn->prepare($qry);
$exec->execute(
    [$rep["Id"],
    $rep['Name'],
    $rep['Owner'],
    $rep['Time'],
    $rep['Morals'],
    $rep['Desc'],
    $rep['Ing'],
    $rep['Image'],
    $rep['Gallery'],
    $rep['Likes']]);

if($_POST['type']==="approve"){
    $conn->query("delete from proposed_recipes where rep_Token='".$rep["Id"]."'");
}

echo "Request Successful.";
?>