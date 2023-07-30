<?php
  session_start();
  if(!isset($_SESSION["current_user"])){
    header("Location: index.php");
  }
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>WTF | Favourites - <?php echo $_SESSION["current_user"];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
    <script>
      function renderRecipe(recipe){
        if (recipe[4]=="1"){
            var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/vegetarian-food-symbol.png" />`
        }
        else{
            var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/non-vegetarian-food-symbol.png" />`
            
        }
        var canvas = document.querySelector("#myrecipe");
        var newRecipe = `<div class='col-sm-3'>
            <div class="card">
            <div class="sticker">
                ${sticker}
            </div>
            <img class="card-img-top" src=${recipe[7]} alt='${recipe[1]}' style="height:200px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title">${recipe[1]}</h5>
                <p class="card-text">${recipe[5].slice(0,100)+"..."}</p>
                <div>
                    <a href="recipe.php?id=${recipe[0]}" class="btn btn-outline-success">Cook Now</a>
                    <div class="float-right">
                        <button id="fav${recipe[0]}" class="btn swap" onclick='liker("${recipe[0]}")'>
                            <span class="fas fa-heart"></span>
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </div>`
        canvas.innerHTML+=newRecipe;
    }

    function fetchRecipes(key){
        var req = new XMLHttpRequest();
        req.open("POST", "fetchFaves.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200){
                recipes =JSON.parse(req.responseText);
                document.querySelector("#myrecipe").innerHTML = "";
                for(var i=0;i<recipes.length;i++){
                    renderRecipe(recipes[i]);
                }
            }
        }
        req.send("key="+key);
    }
    function liker(who){
        var heart = document.querySelector("#fav"+who);
        if(heart.querySelector("span").className == "far fa-heart"){
            heart.querySelector("span").className = "fas fa-heart";
            var action = "add";
        }
        else{
            heart.querySelector("span").className = "far fa-heart";
            var action = "remove";
        }
        var req = new XMLHttpRequest();
        req.open("POST", "like.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 

        req.send("id="+who+"&action="+action);
    }
    </script>
    <style>
        .favess{
            margin-top:100px;
        }       
    </style>
  </head>
  <body onload='fetchRecipes("")'>
    <?php include 'utils/styles.php' ?>
    <?php include 'utils/header.php' ?>
    <div class="container favess">
        <h2 class="text-center"><u>My Favourites</u></h2>
        <div class="input-group p-2" style="font-size:1.3rem;">
            <div class="input-group-prepend ">
                <span class="input-group-text"><i class='fas fa-search'></i></span>
            </div>
            <input type="text" onkeyup="fetchRecipes(this.value)"></input>
        </div>
        <div class="row" id="myrecipe">
        </div>
    </div>
    <?php include 'utils/footer.php' ?>
  </body>
</html>
