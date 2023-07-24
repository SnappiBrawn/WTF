<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();

$rep = json_decode($_POST["data"],true)[0];


if($_POST['type']==="add"){
    $qry = "insert into ingredients values(?,?,?,?,?,?,?)";
}
else{
    $qry = "UPDATE `ingredients` SET `ing_ID`=?,`ing_Name`=?,`ing_Unit`=?,`ing_Owner`=?,`ing_Desc`=?,`ing_Img`=?,`ing_Link`=? WHERE ing_ID ='".$rep["Id"]."'";
}

$exec = $conn->prepare($qry);
$exec->execute(
    [$rep["Id"],
    $rep['Name'],
    $rep['Units'],
    $rep['Owner'],
    $rep['Desc'],
    $rep['Image'],
    $rep['Link']]);

echo "Request Successful.";
?>