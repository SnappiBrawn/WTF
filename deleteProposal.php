<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

$qry = "delete from proposed_recipes where rep_Token = ?;";
$exec = $conn->prepare($qry);
$exec->execute([$_POST['which']]);
echo "Recipe Proposal Deleted Successfully.";

?>