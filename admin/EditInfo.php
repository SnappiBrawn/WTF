<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .main{
            overflow: hidden;
        }
        .card{
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function updatePic(e){
            e.preventDefault();
            pp ="images/"+document.querySelector("#profilePicture").files[0].name;
            alert(pp);
            var req = new XMLHttpRequest();
            req.open("POST", "updateProf.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    alert("Profile changed successfully.");
                    window.location.href="Dashboard.php";
                };
            }
            req.send("which=profile&what="+pp);

        }
        function changePass(e){
            e.preventDefault();
            var p1 = document.querySelector("#password").value;
            var p2 = document.querySelector("#confirmPassword").value;
            if (p1===p2){
                document.querySelector("#pwordError").style.display = "none";
                if(confirm("Confirm password change.")){
                    var req = new XMLHttpRequest();
                    req.open("POST", "updateProf.php", true);
                    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    req.onreadystatechange = function() {
                        if(req.readyState == 4 && req.status == 200) {
                            alert("Password changed successfully.");
                            window.location.href="Dashboard.php";
                        };
                    }
                    req.send("which=pass&what="+p1);
                }
                
            }
            else{
                document.querySelector("#pwordError").style.display = "inline";
            }
        }
        function getStats(){
            var req = new XMLHttpRequest();
            req.open("POST", "stats.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    var stats = JSON.parse(req.responseText);
                    document.querySelector("#recipeNos").innerHTML = stats['recipes'];
                    document.querySelector("#ingredientNos").innerHTML = stats['ingredients'];
                    document.querySelector("#proposedRecipeNos").innerHTML = stats['proposals'];
                };
            }
            req.send();
        }
    </script>
</head>
<body>
    <?php include "utils/scripts.php";?>
    <?php include "utils/styles.php";?>
    <div class="main">
        <?php include "utils/header.php" ?>
        <div class="container mt-5">
            <div class="card bg-warning ">
                <div class="card-header">
                    <h3><i class='fas fa-key'></i> Password Change</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="form-group col">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group col">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password"  onkeyup="changePass(event)" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            </div>
                        </div>
                        <button onclick="changePass(event)" class="btn btn-primary">Confirm</button>
                        <span class="alert alert-danger" style="font-size: 0.8rem; transition-duration:0.3s; display:none" id="pwordError"><strong>The two fields do not match.</strong></span>
                    </form>
                </div>
            </div>

            <div class="card bg-warning mt-3">
                <div class="card-header">
                    <h3><i class='fas fa-user'></i> Profile Picture</h3>
                </div>
                <div class="card-body">
                    <form onsubmit='updatePic(event)'>
                        <div class="form-group">
                            <label for="profilePicture">Upload a new picture to set as your profile.</label>
                            <input type="file" class="form-control-file" id="profilePicture" name="profilePicture" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
