<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();

$rep = json_decode($_POST["data"],true)[0];

$qry = "UPDATE `proposed_recipes` SET `rep_Token`=?,`rep_Name`=?,`rep_Owner`=?,`rep_Time`=?,`rep_Morals`=?,`rep_Description`=?,`rep_Ingredients`=?,`rep_Image`=?,`rep_Gallery`=? WHERE rep_Token ='".$rep["Id"]."'";

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
    $rep['Gallery']]);

echo "Updation Successful.";
?>