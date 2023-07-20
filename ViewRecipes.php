<?php 
include_once("classes/Connection.php");
include_once("classes/rep.php");
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | All Recipes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script>
            function renderRecipe(recipe){
                var canvas = document.querySelector(".all-recipes");
                var newRecipe = `<div class='col-sm-3'>
                    <div class="card">
                    <img class="card-img-top" src=${recipe[6]} alt='${recipe[1]}' style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">${recipe[1]}</h5>
                        <p class="card-text">${recipe[4].slice(0,100)+"..."}</p>
                        <a href="recipe.php?id=${recipe[0]}" class="btn btn-outline-success">Cook Now</a>
                    </div>
                    </div>
                </div>`
                canvas.innerHTML+=newRecipe;
            }

            function fetchRecipes(qry){
                var req = new XMLHttpRequest();
                req.open("POST", "searchRecipes.php", true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
                req.onreadystatechange = function() {
                    if(req.readyState == 4 && req.status == 200){
                        recipes =JSON.parse(req.responseText);
                        document.querySelector(".all-recipes").innerHTML = "";
                        for(var i=0;i<recipes.length;i++){
                            renderRecipe(recipes[i]);
                        }
                    };
                }
                req.send("search="+qry);
            }
        
        </script>
        <style>
            .recipe-search{
                margin: 100px auto;
                width: 40%;
                font-size: 2rem;
            }

        </style>
    </head>
    <body onload='fetchRecipes("")'>
        <?php include "utils/styles.php"?>
        <?php include "utils/header.php"?>
        <div class="recipe-search">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" id="recipe-search" value="" onkeyup="fetchRecipes(this.value)" placeholder="Search for a recipe">
            </div>
        </div>
        <div class="container">
            <div class="row all-recipes">
                <!-- will be populated by js -->
            </div>
        </div>
        <?php include "utils/footer.php"?>
    </body>
</html>