<?php 
session_start();
include "classes/Connection.php";

$conn = Connection::getInstance();

$proposal = json_decode($_POST["data"],true)[0];
try{
    $id=$conn->query('select max(rep_Token) from proposed_recipes')->fetchColumn()+1;

    $qry = "insert into proposed_recipes values(?,?,?,?,?,?,?,?,?)";
    $exec = $conn->prepare($qry);
    $exec->execute(
        [
        $id,
        $proposal['Name'],
        $_SESSION['current_user'],
        $proposal['Time'],
        $proposal['Morals'],
        $proposal['Desc'],
        $proposal['Ing'],
        $proposal['Image'],
        $proposal['Gallery']
        ]);

    $sub = explode(",",$conn->query("select users_Submissions from users where users_Name='".$_SESSION['current_user']."'")->fetchColumn());
    array_push($sub, $id);
    $new_sub = implode(",",$sub);

    $conn->query("update users set users_submissions='$new_sub' where users_Name='".$_SESSION['current_user']."'");

    echo "Submission successful";
}
catch(Exception $e){
    echo "Internal Server Error during submission. Kindly contact Administrators";
}

?>