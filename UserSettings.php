<!-- Submit a recipe page -->
<?php 
    session_start();
    if(isset($_SESSION["current_user"]))
    $user = $_SESSION["current_user"];
    else{
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | Settings - <?php echo $user;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
        <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script>
            function changePass(e){
                e.preventDefault();
                if (document.querySelector("#pword").value !==document.querySelector("#confirmPassword").value){
                    document.querySelector('#pwordError').style.display = 'block';
                }
                else{
                    var p = document.querySelector("#pword").value;
                    var req = new XMLHttpRequest();
                    req.open("POST", "updatePassword.php", true);
                    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    req.onreadystatechange = function() {
                        if(req.readyState == 4 && req.status == 200) {
                            alert(req.responseText);
                            document.querySelector("#pword").value="";
                            document.querySelector("#confirmPassword").value="";
                        }
                    }
                    req.send('pword='+p);
                }
            }
            function terminate(e){
                e.preventDefault();
                if(confirm("Are you reeaaaaly sure you wanna leave us?")){
                    e.preventDefault();
                    var req = new XMLHttpRequest();
                    req.open("POST", "deleteAccount.php", true);
                    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    req.onreadystatechange = function() {
                        if(req.readyState == 4 && req.status == 200) {
                            alert(req.responseText);
                            window.location.href = 'index.php';
                        }
                    }
                    req.send();
                }
                else{
                    alert("Good call :)");
                }
        }
        </script>
        <style>
            .profile-body{
                margin-top: 100px;  
            }
            .bg-danger{
                color: black;
            }
        </style>
    </head>
    <body>
        <?php include "utils/styles.php"?>
        <div class="container profile-body">
            <div class="card bg-light">
                <div class="card-header">
                    <h3><i class='fas fa-key'></i> Password Change</h3>
                </div>
                <div class="card-body">
                    <form onsubmit="changePass(event)">
                        <div class="row">
                            <div class="form-group col">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="pword" name="password" required>
                            </div>
                            <div class="form-group col">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            </div>
                        </div>
                        <button class="btn btn-primary">Confirm</button>
                        <span class="alert alert-danger" style="font-size: 0.8rem; transition-duration:0.3s; display:none" id="pwordError"><strong>The two fields do not match.</strong></span>
                    </form>
                </div>
            </div>

            <div class="card bg-danger mt-3">
                <div class="card-header">
                    <h3><i class='fas fa-times'></i> Deletion Request</h3>
                </div>
                <div class="card-body">
                    <form onsubmit='terminate(event)'>
                        <button type="submit" class="btn btn-light">Delete my Account</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include "utils/footer.php"?>
    </body>
</html>