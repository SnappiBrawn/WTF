<!-- recipes page -->
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
            function filter_validate(e){
                var veg = document.querySelector("#veg-filter");
                var nonveg =document.querySelector("#nonveg-filter");
                if(veg.checked === true && e.target.id == "nonveg-filter"){
                    nonveg.click();
                }
                if(nonveg.checked === true && e.target.id == "veg-filter"){
                    veg.click();
                }
                fetchRecipes();
            }

            function renderRecipe(recipe){
                if (recipe[4]=="1"){
                    var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/non-vegetarian-food-symbol.png" />`
                }
                else{
                    var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/vegetarian-food-symbol.png" />`
                    
                }
                var canvas = document.querySelector(".all-recipes");
                var newRecipe = `<div class='col-sm-3'>
                    <div class="card">
                    <div class="sticker">
                        ${sticker}
                    </div>
                    <img class="card-img-top" src=${recipe[7]} alt='${recipe[1]}' style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">${recipe[1]}</h5>
                        <p class="card-text">${recipe[5].slice(0,100)+"..."}</p>
                        <a href="recipe.php?id=${recipe[0]}" class="btn btn-outline-success">Cook Now</a>
                    </div>
                    </div>
                </div>`
                canvas.innerHTML+=newRecipe;
            }

            function fetchRecipes(){
                qry=document.querySelector("#recipe-search").value;
                var morals="";
                if (document.querySelector("#veg-filter").checked === true){
                    morals="1";
                }
                else if (document.querySelector("#nonveg-filter").checked === true){
                    morals="0";
                }
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
                req.send("search="+qry+"&morals="+morals);
            }
        
        </script>
        <style>
            body{
                background-image: ;
            }
            .recipe-search{
                margin: 100px auto;
                width: 40%;
            }
            .filters{
                margin: 0 auto;
            }
            .filters > label{
                margin-left: 15%;
            }
            .sticker{
                position: absolute;
                right:0;
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
                <input type="text" class="form-control" id="recipe-search" value="" onkeyup="fetchRecipes()" placeholder="Search for a recipe">
            </div>
            <div class="filters">
                <b>Filters:</b>
                <label for="veg-filter">Vegetarian Only</label>
                <input type="checkbox" name="veg-filter" id="veg-filter" onchange="filter_validate(event)"></input>
                <label for="nonveg-filter">Non-Vegetarian Only</label>
                <input type="checkbox" name="nonveg-filter" id="nonveg-filter" onchange="filter_validate(event)"></input>
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