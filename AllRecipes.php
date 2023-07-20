<!-- Widget on the main page, NOT THE SAME AS THE VIEW ALL RECIPES -->
<head>
<script>
    function renderRecipe(recipe){
        if (recipe[4]=="1"){
            var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/non-vegetarian-food-symbol.png" />`
        }
        else{
            var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/vegetarian-food-symbol.png" />`
            
        }
        var canvas = document.querySelector(".allrecipes");
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
        var pantry = document.querySelector(".pantry > ul");
        var items = [];
        for(var i=0; i<pantry.childNodes.length;i++){
            items.push(pantry.childNodes[i].getAttribute("id"));
        }
        items=items.toString();
        var req = new XMLHttpRequest();
        req.open("POST", "fetchRecipes.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200){
                recipes =JSON.parse(req.responseText);
                document.querySelector(".allrecipes").innerHTML = "";
                for(var i=0;i<recipes.length;i++){
                    renderRecipe(recipes[i]);
                }
            };
        }
        req.send("fetchfor="+items);
    }

    fetchRecipes("");
</script>

<style>
   .card{
    margin: 10px;
   }
   .sticker{
        position: absolute;
        right:0;
    }
</style>
</head>
<body>
<div class="container" style="padding: 30px;">
    <h2 style="text-align:center"><u>JUST FOR YOU</u></h2>
    <div class="row allrecipes">
    </div>
</div>
</body>