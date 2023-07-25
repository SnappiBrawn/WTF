<?php
session_start();

include "classes/Connection.php";

$conn = Connection::getInstance();

$res = [md5(rand()),"","",$_SESSION['admin'],"","",""];

$type="add";

if($_GET['id']!==""){
    $type="update";
    $qry = 'select * from ingredients where ing_ID="'.$_GET['id'].'"';
    $res = $conn->query($qry)->fetch();
}
$links = $res["6"];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Recipe</title>
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
                placeholder: 'Enter ingredient description here...',
            });
        }
        function submitForm(e){
            e.preventDefault();
            var Id = e.target.querySelector("#ingredientId").value;
            var Name = e.target.querySelector("#ingredientName").value;
            var Owner = e.target.querySelector("#ingredientOwner").value
            var Units = e.target.querySelector("#measurementUnit").value;
            var Desc = window.quill.root.innerHTML;
            var Image = e.target.querySelector("#ingredientImage").value;
            var Link = `<?php echo $links;?>`;

            var submission = Array({Id, Name, Owner, Units, Desc, Image, Link});
            alert(JSON.stringify(submission));
            var req = new XMLHttpRequest();
            req.open("POST", "addIngredient.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    alert(req.responseText);
                    window.location.href = "Ingredients.php";
                }
            }
            req.send("type=<?php echo $type;?>&data="+JSON.stringify(submission));
        }
        function populate(){
            loadQuill();
            document.querySelector("#ingredientId").value = <?php echo '`'.$res[0].'`'?>;
            document.querySelector("#ingredientOwner").value = <?php echo '`'.$res[3].'`'?>;
            document.querySelector("#ingredientName").value = <?php echo '`'.$res[1].'`'?>;
            document.querySelector("#measurementUnit").value = <?php echo '`'.$res[2].'`'?>;
            window.quill.root.innerHTML = <?php echo '`'.$res[4].'`'?>;
            document.querySelector("#ingredientImage").value = <?php echo '`'.$res[5].'`'?>;
        }
    </script>
</head>
<body onload='populate()'>
    <?php include "utils/scripts.php";?>
    <?php include "utils/styles.php";?>
    <div class="main">
        <?php include "utils/Header.php" ?>
        <div class="row">
            <?php include "utils/Sidebar.php"?>
            <main class="col-md-10 pt-4">
                <form class="container mt-5" onsubmit="submitForm(event)">
                    <div class="row mb-4 mx-1 border rounded p-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ingredientId">Ingredient ID</label>
                                <input type="text" class="form-control" id="ingredientId" name="ingredientId" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ingredientOwner">Ingredient Owner</label>
                                <input type="text" class="form-control" id="ingredientOwner" name="ingredientOwner" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-1 border rounded p-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ingredientName">Ingredient Name</label>
                                <input type="text" class="form-control" id="ingredientName" name="ingredientName" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="measurementUnit">Ingredient Measurement Unit</label>
                                <input type="text" class="form-control" id="measurementUnit" name="measurementUnit" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <div class="form-control" id="description" name="description"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ingredientImage">Ingredient Image</label>
                                <input type="text" class="form-control" id="ingredientImage" name="ingredientImage">
                            </div>
                        </div>
                    </div>
                    <div class="m-4 text-center">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </form>
</body>
</html>
