<!-- Submit a recipe page -->
<?php 
    session_start();
    if(isset($_SESSION["current_user"]))
    $user = $_SESSION["current_user"];
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | Submit A Recipe</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                    placeholder: 'Enter your description here...',
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
                var Name = e.target.querySelector("#recipeName").value;
                var Time = e.target.querySelector("#prepTime").value;
                var User = <?php echo "'$user';";?>
                var Morals = e.target.querySelector("#vegetarian").checked?1:0;
                var Desc = window.quill.root.innerHTML;
                var Image = e.target.querySelector("#recipeImage").value;
                var Gallery = e.target.querySelector("#additionalImages").value;
                var Ing = "";
                var a = e.target.querySelector("#selectedIngredients").children;
                for(var i=0; i<a.length;i++){
                    Ing+=a[i].id+",";
                }
                var submission = Array({Name,Time,User,Morals,Desc,Image,Gallery,Ing});
                var req = new XMLHttpRequest();
                req.open("POST", "proposeRecipe.php", true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
                req.onreadystatechange = function() {
                    if(req.readyState == 4 && req.status == 200) {
                        alert(req.responseText);
                        window.location.reload();
                    }
                }
                req.send("data="+JSON.stringify(submission));
            }
        </script>
        <style>
            .recipe-submit{
                margin-top: 100px;
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
        </style>
    </head>
    <body onload='loadQuill()'>
        <?php include "utils/styles.php"?>
        <?php include "utils/Header.php"?>
        <div class="recipe-submit">
            <div class="container mt-4">
                <?php if(isset($_SESSION['current_user'])):?>
                <h2 class="mb-4 text-center">Propose a New Recipe</h2>
                <div class='alert alert-info'>
                <h4 class="alert-heading text-center"><b>Attention</b></h4>
                <p><b>Submission of a new recipe does not guarantee immediate addition.</b> We at WTF strive to provide our visitors with the best content possible.
                    In order to achieve this, we have an ever-active team reviewing all your submissions.
                    Only after the team's approval will the recipe be listed and due credit given.
                    We request you to be patient  till the process is completed. Any queries can be raised with our support team.</p>
                </div>
                <form onsubmit="submitForm(event)">
                    <div class="form-group">
                        <label for="recipeName">Recipe Name</label>
                        <input type="text" class="form-control" id="recipeName" name="recipeName" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prepTime">Preparation Time(in minutes)</label>
                            <input type="text" class="form-control" id="prepTime" name="prepTime" required>
                        </div>
                        <div class="form-group col-md-6 text-center">
                        <label class="d-block " for="vegetarian"> Is Vegetarian?
                            <input type="checkbox" id="vegetarian" class="tog-input" name="vegetarian" checked="checked">
                            <div class="tog-display mx-auto"></div>
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ingredients</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="ingredientSearch" onkeyup="getResults(this.value)" placeholder="Search Ingredient">
                                <ul class="list-group mt-2" id="searchResults" style="background:white; min-height: 10rem; overflow-y:scroll">
                                    <!-- Search results will be displayed here dynamically -->
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <p class="text-center py-2" style="background-color: lightgrey; margin:0"> <b>Selected Ingredients</b> </p>
                                <ul class="list-group" id="selectedIngredients" style="background:white; min-height: 10rem ; overflow-y:scroll">
                                    <!-- Selected ingredients will be displayed here dynamically -->
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
                        <input type="text" class="form-control" id="recipeImage" name="recipeImage" required>
                    </div>
                    <div class="form-group">
                        <label for="additionalImages">Additional Images (Up to 3 links, use space to separate them)</label>
                        <input type="text" class="form-control" id="additionalImages" name="additionalImages" multiple>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                <?php else:?>
                <div class="text-center">
                    <h1> Sorry! You need to log in to submit a recipe.</h1>
                    <p>Meanwhile, feel free to explore WTF for cool food recipes you can make with whatever you got.</p>
                    <p>We've got something for all your food needs ;)</p>
                    <h3>Not a registered user yet? Click below to register.</h3>
                    <button class="btn btn-outline-warning" data-toggle="modal" data-target="#registerModal">Register</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php include "utils/footer.php"?>
    </body>
</html>