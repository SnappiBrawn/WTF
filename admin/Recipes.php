<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Recipes</title>
    <style>
        .main{
            overflow: hidden;
        }

        thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
    <script> 
        function remove(t){
            var sure = confirm("Confirm deletion of recipe "+t+"?");
            if(sure){
                if(confirm("Are you reeeallly sure?")){
                    var req = new XMLHttpRequest();
                    var table = document.querySelector("tbody");
                    req.open("POST", "deleteItem.php", true);
                    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    req.onreadystatechange = function() {
                        if(req.readyState == 4 && req.status == 200) {
                            alert(req.responseText);
                            window.location.reload();
                        };
                    }
                    req.send("what=recipe&which="+t);
                }
                else{
                    alert('Yeah, probably was the better call.')
                }
            }
        }
        function populate(t){
            var req = new XMLHttpRequest();
            var table = document.querySelector("tbody");
            table.innerHTML = "";
            req.open("POST", "helpPopulate.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    var recipes = JSON.parse(req.responseText);
                    recipes.forEach(element => {
                        table.innerHTML +=`<tr>
                        <td>${element[0]}</td>
                        <td>${element[1]}</td>
                        <td>${element[2]}</td>
                        <td>${element[9]}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item" onclick="edit('${element[0]}')">Edit</button>
                                    <button class="dropdown-item" onclick="remove('${element[0]}')">Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>`;
                    });
                };
            }
            req.send("what=recipes&key="+t);
        }
    </script>
</head>
<body onload="populate('')">
    <?php include "utils/scripts.php";?>
    <?php include "utils/styles.php";?>
    <div class="main">
        <?php include "utils/header.php" ?>
        <div class="row">
            <?php include "utils/Sidebar.php"?>
            <main class="col-md-10 pt-4">
                <div class='input-group p-3'>
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" placeholder="Search..." onkeyup="populate(this.value)">
                </div>
            <table id="recipeTable" class="table table-bordered table-striped mx-auto">
                <thead>
                    <tr>
                        <th>Recipe ID</th>
                        <th>Recipe Name</th>
                        <th>Recipe Owner</th>
                        <th>Recipe Likes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- will be populated by populate() -->
                </tbody>
            </table>
            </main>
        </div>
    </div>
</body>
</html>
