<!-- Widget on the main page, NOT THE SAME AS THE VIEW ALL RECIPES -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script>
    function liker(what){
        <?php if(!isset($_SESSION['current_user'])){
                echo "alert('Oops! You need to be logged in to do that.');";
                echo "return;";
              }
        ?>
        var heart = document.querySelector("#fav"+what);
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
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200){
                //pass
            }
        }
        req.send("id="+what+"&action="+action);
    }

    function renderRecipe(recipe){
        if (recipe[4]=="1"){
            var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/non-vegetarian-food-symbol.png" />`
        }
        else{
            var sticker = `<img width="48" height="48" class="sticker" src="https://img.icons8.com/fluency/48/vegetarian-food-symbol.png" />`
            
        }
        var canvas = document.querySelector(".allrecipes");
        if(recipe[10]=="1"){
            var likeStatus="fas";
        }
        else{
            var likeStatus="far";
        }
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
                            <span class="${likeStatus} fa-heart"></span>
                        </button>
                    </div>
                </div>
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
</style>
</head>
<body>
<div class="container" style="padding: 30px;">
    <h2 style="text-align:center"><u>JUST FOR YOU</u></h2>
    <div class="row allrecipes">
    </div>
</div>
</body>