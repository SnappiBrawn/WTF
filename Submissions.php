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
        function remove(t){
            if(confirm("Confirm deletion of Proposal "+t+"?")){
                if(confirm("Are you reeeallly sure?")){
                    var req = new XMLHttpRequest();
                    var table = document.querySelector("tbody");
                    req.open("POST", "deleteProposal.php", true);
                    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    req.onreadystatechange = function() {
                        if(req.readyState == 4 && req.status == 200) {
                            alert(req.responseText);
                            window.location.reload();
                        };
                    }
                    req.send("which="+t);
                }
                else{
                    alert('Yeah, probably was the better call.');
                }
            }
        }
        function populate(t){
            var req = new XMLHttpRequest();
            var table = document.querySelector("tbody");
            table.innerHTML = "";
            req.open("POST", "getSubmissions.php", true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    var recipes = JSON.parse(req.responseText);
                    recipes.forEach(element => {
                        table.innerHTML +=`<tr>
                        <td>${element[0]}</td>
                        <td>${element[1]}</td>
                        <td>${element[4]==="1"?"Yes":"No"}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item" onclick='window.location.href="ProposalShow.php?id=${element[0]}"'>Edit</button>
                                    <button class="dropdown-item" onclick='remove("${element[0]}")'>Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>`;
                    });
                };
            }
            req.send("key="+t);
        }
    </script>
    <style>
        .submissions-body{
            margin-top:100px;
        }
        tbody, thead{
            background-color: white;
        }
    </style>
  </head>
  <body onload="populate('')">
    <?php include 'utils/styles.php' ?>
    <?php include 'utils/header.php' ?>
    <div class="container submissions-body">
        <h2 class="text-center"><u>My Submissions</u></h2>
        <div class="alert alert-info">
        <h4 class="alert-heading text-center"><b>Note</b></h4>
            <p>Hey there! We appreciate your enthusiam to add to our ever-growing list of recipes. 
                While your recipes await approval, they'll be put on a waiting queue. Below is a list of submissions you've made along with their Token numbers.
                For any queries regarding your recipe status, do reach out to us at support.wtf@gmail.com with your submission' stoken number.</p>
        </div>
            <div class='input-group p-3'>
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" placeholder="Search by name" onkeyup="populate(this.value)">
                </div>
            <table id="recipeTable" class="table table-bordered table-striped mx-auto">
                <thead>
                    <tr> 
                        <th>Token</th>
                        <th>Recipe Name</th>
                        <th>Vegetarian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- will be populated by populate() -->
                </tbody>
            </table>
    </div>
    <?php include 'utils/footer.php' ?>
  </body>
</html>
