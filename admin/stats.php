<?php

session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

$rcps = $conn->query("select count(*) from recipes;")->fetchColumn();
$ings = $conn->query("select count(*) from ingredients;")->fetchColumn();
$prcps = $conn->query("select count(*) from proposed_recipes;")->fetchColumn();

$stats["recipes"] = $rcps;
$stats["ingredients"] = $ings;
$stats["proposals"] = $prcps;

echo json_encode($stats);

?>