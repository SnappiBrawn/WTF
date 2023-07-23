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
    </style>
</head>
<body>
    <?php include "utils/scripts.php";?>
    <?php include "utils/styles.php";?>
    <div class="main">
        <?php include "utils/header.php" ?>
        <div class="row">
            <?php include "utils/Sidebar.php"?>
            <main class="col-md-10 pt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card m-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Recipes</h5>
                                <p class="card-text">Number of total recipes hosted.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card m-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Ingredients</h5>
                                <p class="card-text">Number of total ingredients listed.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card m-4">
                            <div class="card-body">
                                <h5 class="card-title">Pending Proposals</h5>
                                <p class="card-text">Number of pending recipe proposals.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
