<?php
session_start();

?>

<html>
<head>
    <title>Login Form</title>
    <!-- Add the Bootstrap CSS link -->
    <style>
        #error{
            display:none;
        }
    </style>
</head> 
<body>
    <?php include "utils/scripts.php"?>
    <?php include "utils/styles.php"?>
    <div class="container mt-5">
        <a href="#" onclick="goBack()" class="btn btn-secondary mb-3">Back</a>

        <div class="row justify-content-center border">
            <div class="col-md-6 p-5">
                <div>
                    <div class="form-group heading text-center">
                        <h2 for="username">Welcome, Admin!</h2>
                    </div>
                    <div id="error">
                        <p class="alert alert-danger text-center"><strong>Error!</strong> Invalid username or password.</p>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button onclick="login(event)" class="btn btn-primary btn-block">Login</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script for the back button functionality -->
    <script>
        function goBack() {
            window.location.replace('../index.php');
        }
        function login(e){
            e.preventDefault();
            var uid = document.querySelector("#username").value;
            var pword = document.querySelector("#password").value;
            var req = new XMLHttpRequest();
            req.open("POST", "authenticate.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    if (req.responseText==="1"){
                        window.location.href = "Dashboard.php";
                    }
                    else{
                        var err = document.querySelector("#error");
                        err.style.display = "inline";
                    }
                };
            }
            req.send("id="+uid+"&pword="+pword);
        }
    </script>
</body>
</html>
