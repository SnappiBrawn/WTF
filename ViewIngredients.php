<!-- recipes page -->
<?php 
include_once("classes/Connection.php");
include_once("classes/rep.php");

?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | All Ingredients</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script>
            
            function renderIngredient(ing){
                var canvas = document.querySelector(".all-ingredients");
                var newIngredient = `<div class='col-sm-3 my-2'>
                    <div class="card">
                    <img class="card-img-top" src=${ing[5]} alt='${ing[1]}' style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">${ing[1]}</h5>
                        <p class="card-text">${ing[4].slice(0,100)+"..."}</p>
                        <div>
                            <a href="Ingredient.php?id=${ing[0]}" class="btn btn-outline-success">View details</a>
                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>`
                canvas.innerHTML+=newIngredient;
            }

            function fetchIngredients(){
                qry=document.querySelector("#ingredient-search").value;
                var req = new XMLHttpRequest();
                req.open("POST", "searchIngredients.php", true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
                req.onreadystatechange = function() {
                    if(req.readyState == 4 && req.status == 200){
                        ingredients =JSON.parse(req.responseText);
                        console.log(req.responseText);
                        document.querySelector(".all-ingredients").innerHTML = "";
                        for(var i=0;i<ingredients.length;i++){
                            renderIngredient(ingredients[i]);
                        }
                    };
                }
                req.send("search="+qry);
            }
        
        </script>
        <style>
            body{
                background-image: ;
            }
            .ingredient-search{
                margin: 100px auto 50px auto;
                width: 40%;
            }

        </style>
    </head>
    <body onload='fetchIngredients("")'>
        <?php include "utils/styles.php"?>
        <?php include "utils/header.php"?>
        <div class="ingredient-search">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" id="ingredient-search" value="" onkeyup="fetchIngredients()" placeholder="Search for an ingredient...">
            </div>
        </div>
        <div class="container">
            <div class="row all-ingredients">
                <!-- will be populated by js -->
            </div>
        </div>
        <?php include "utils/footer.php"?>
    </body>
</html>