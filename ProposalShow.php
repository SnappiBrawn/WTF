<?php
session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

$qry = 'select * from proposed_recipes where rep_Token="'.$_GET['id'].'"';
$res = $conn->query($qry)->fetch();

if(gettype($res)=="boolean"){
    echo "<h1 align='center'>You aren't supposed to be here!</h1>";
    exit(0);
}

$ing_string = explode(",",$res[6]);
$ing = [];
foreach ($ing_string as $i){
    $qry = "select ing_Name from ingredients where ing_Id='".$i."'";
    array_push($ing, [$i, $conn->query($qry)->fetchColumn()]);
}
$ing = json_encode($ing);

?>
<!DOCTYPE html>
<html>
<head>
    <title>WTF | Edit Proposal</title>
    <style>
        .main{
            overflow-x: hidden;
        }
        .ingredient{
            padding: 5px;
            border: 1px solid grey;
            cursor: pointer;
        }
        .ingredient:hover{
            background-color: lightblue;
        }
        #description{
            height: 10rem;
        }
        #vegetarian{
            color: green;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
    
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script> 
        function loadQuill(){
            window.quill = new Quill('#description', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['clean']
                    ]
                },
                placeholder: 'Enter recipe description here...',
            });
        }
        function removeFromSelection(ing){
            var element = document.querySelector('#'+ing);
            element.parentNode.removeChild(element);
        }
        function addToSelection(ing){
            var dest = document.querySelector("#selectedIngredients");
                for (var i=0; i<dest.children.length;i++){
                    if(dest.children[i].id ==ing.target.getAttribute("value"))
                        return;
                }
                dest.innerHTML+=`<li id="${ing.target.getAttribute("value")}" class="ingredient" onclick="removeFromSelection('${ing.target.getAttribute("value")}')">
                                        ${ing.target.innerHTML}
                                    </li>`
        }
        function getResults(target){
            if(target.length<1){
            document.querySelector("#searchResults").innerHTML="";
            return
            }
            document.querySelector("#searchResults").innerHTML="";
            
            var req = new XMLHttpRequest();
            req.open("POST", "search.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                var return_data = JSON.parse(req.responseText);
                const ul = document.querySelector("#searchResults");
                for(var i=0; i<return_data.length; i++){ 
                    ul.innerHTML+=("<li class='ingredient' value="+return_data[i][0]+" onclick=addToSelection(event)>"+return_data[i][1]+"</li>");
                }
                };
            }
            req.send("searchkey="+target);
        }
        function submitForm(e){
            e.preventDefault();
            var Id = e.target.querySelector("#recipeId").value;
            var Name = e.target.querySelector("#recipeName").value;
            var Owner = e.target.querySelector("#recipeOwner").value
            var Time = e.target.querySelector("#prepTime").value;
            var Morals = e.target.querySelector("#vegetarian").checked?1:0;
            var Desc = window.quill.root.innerHTML;
            var Image = e.target.querySelector("#recipeImage").value;
            var Gallery = e.target.querySelector("#additionalImages").value;
            var Likes = 0;
            var Ing = "";
            var a = e.target.querySelector("#selectedIngredients").children;
            for(var i=0; i<a.length;i++){
                Ing+=a[i].id+",";
            }
            var submission = Array({Id,Name,Owner,Time,Morals,Desc,Image,Gallery,Likes,Ing});
            var req = new XMLHttpRequest();
            req.open("POST", "addRecipe.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    alert(req.responseText);
                }
            }
            req.send("&data="+JSON.stringify(submission));
        }
        function populate(){
            loadQuill();
            document.querySelector("#recipeId").value = <?php echo '`'.$res[0].'`'?>;
            document.querySelector("#recipeOwner").value = <?php echo '`'.$res[2].'`'?>;
            document.querySelector("#recipeName").value = <?php echo '`'.$res[1].'`'?>;
            document.querySelector("#prepTime").value = <?php echo '`'.$res[3].'`'?>;
            document.querySelector("#vegetarian").checked = <?php echo '`'.$res[4].'`'?>=="1"?true:false;
            window.quill.root.innerHTML = <?php echo '`'.$res[5].'`'?>;
            document.querySelector("#recipeImage").value = <?php echo '`'.$res[7].'`'?>;
            document.querySelector("#additionalImages").value = <?php echo '`'.$res[8].'`'?>;
            var ing = <?php echo $ing;?>;
            ing.forEach(element => {
                if(element[0]){
                    document.querySelector("#selectedIngredients").innerHTML+=`<li id="${element[0]}" class="ingredient" onclick="removeFromSelection('${element[0]}')">
                                            ${element[1]}
                                        </li>`
                }
            });

        }
    </script>
</head>
<body onload='populate()'>
    <?php include "utils/scripts.php";?>
    <?php include "utils/styles.php";?>
    <div class="main">
        <?php include "utils/Header.php" ?>
            <form onsubmit="submitForm(event)">
                <div class="container" style="padding-top: 100px">
                    <div class="border rounded p-4">
                        <div class="form-group">
                            <label for="recipeId">Proposal Token Number</label>
                            <input type="text" class="form-control" id="recipeId" name="recipeId" disabled>
                        </div>
                        <div class="form-group" hidden>
                            <label for="recipeOwner">Recipe Owner</label>
                            <input type="text" class="form-control" id="recipeOwner" name="recipeOwner" disabled>
                        </div>
                    </div>
                    <div class="border rounded p-4">
                        <div class="form-group">
                            <label for="recipeName">Recipe Name</label>
                            <input type="text" class="form-control" id="recipeName" name="recipeName">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="prepTime">Preparation Time(in minutes)</label>
                                <input type="text" class="form-control" id="prepTime" name="prepTime">
                            </div>
                            <div class="form-group col-md-6 text-center">
                                <label class="d-block" for="vegetarian">Vegetarian</label>
                                <input type="checkbox" id="vegetarian" name="vegetarian" checked="checked">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ingredients</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="ingredientSearch" onkeyup="getResults(this.value)" placeholder="Search Ingredient">
                                    <ul class="list-group mt-2" id="searchResults" style="background:whitesmoke; height: 10rem; overflow-y:scroll">
                                        <!-- Search results will be updated here dynamically -->
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-center py-2" style="background-color: lightgrey; margin:0"> <b>Selected Ingredients</b> </p>
                                    <ul class="list-group" id="selectedIngredients" style="background:whitesmoke; height: 10rem ; overflow-y:scroll">
                                        <!-- Selected ingredients will be updated here dynamically -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="description">Description</label>
                            <div class="form-control" id="description" name="description"></div>
                        </div>
                        <div class="form-group">
                            <label for="recipeImage">Recipe Image (Link)</label>
                            <input type="text" class="form-control" id="recipeImage" name="recipeImage">
                        </div>
                        <div class="form-group">
                            <label for="additionalImages">Additional Images (Up to 3 links, use space to separate them)</label>
                            <input type="text" class="form-control" id="additionalImages" name="additionalImages">
                        </div>
                    </div>
                </div>
                <div class="m-4 text-center">
                    <button type="submit" class="btn btn-success ">Confirm</button>
                </div>
            </form>
    </div>
</body>
</html>
