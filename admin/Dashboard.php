<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .main{
            overflow: hidden;
        }
        .card{
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function getStats(){
            var req = new XMLHttpRequest();
            req.open("POST", "stats.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    var stats = JSON.parse(req.responseText);
                    document.querySelector("#recipeNos").innerHTML = stats['recipes'];
                    document.querySelector("#ingredientNos").innerHTML = stats['ingredients'];
                    document.querySelector("#proposedRecipeNos").innerHTML = stats['proposals'];
                };
            }
            req.send();
        }
    </script>
</head>
<body onload="getStats()">
    <?php include "utils/scripts.php";?>
    <?php include "utils/styles.php";?>
    <div class="main">
        <?php include "utils/header.php" ?>
        <div class="row">
            <?php include "utils/Sidebar.php"?>
            <main class="col-md-10 pt-4">
                <div class="row card-deck">
                        <div class="card m-4 bg-success" onclick="window.location.href = 'Recipes.php'">
                            <div class="card-header">
                                Manage <span class="float-right"><i class="fas fa-arrow-right"></i></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h2 class="card-title">Total Recipes</h2>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <h1 id="recipeNos">0</h1>
                                    </div>
                                </div>
                            </div>
                    </div>
                        <div class="card m-4 bg-primary" onclick="window.location.href = 'Ingredients.php'">
                            <div class="card-header">
                                Manage <span class="float-right"><i class="fas fa-arrow-right"></i></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h2 class="card-title">Total Ingredients</h2>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <h1 id="ingredientNos">0</h1>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row card-deck">
                        <div class="card m-4 bg-danger" onclick="window.location.href = 'Proposals.php'">
                            <div class="card-header">
                                Manage <span class="float-right"><i class="fas fa-arrow-right"></i></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h2 class="card-title">Pending Recipe Proposals</h2>
                                    </div>
                                    <div class="col-md-2">
                                        <h1 id="proposedRecipeNos">0</h1>
                                    </div>
                                </div>
                            </div>
                    </div>
                        <div class="card m-4 bg-warning">
                            <div class="card-header">
                                Manage <span class="float-right"><i class="fas fa-arrow-right"></i></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h2 class="card-title">Total Active Users</h2>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <h1>0</h1>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
