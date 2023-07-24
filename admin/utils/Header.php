<style>
  .custom-header {
    position: relative;
    width: 100vw;
    padding: 20px;
    text-align: center;
    z-index: 1;
    color:white;
    
  }
  .options{
    display: flex;
    align-items: flex-end;
    gap:10px;
    position: absolute;
    top:0;
    right:0;
    margin-right: -300px;
  }
  .profile-pic{
    height: 50px;
    border-radius: 50%;
  }
  .dropdown-toggle{
    cursor: pointer;
  }
  .dropdown-item{
    cursor: pointer;
  }
</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
<script>
  function logout(){
    var req = new XMLHttpRequest();
    req.open("POST", "logout.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.onreadystatechange = function() {
        if(req.readyState == 4 && req.status == 200) {
            window.location.href = "../index.php";
        };
    }
    req.send();
  }
</script>

<div class="container-fluid bg-dark">
    <div class="row custom-header">
        <div class="col-md-6 offset-md-3">
            <h2><strong>W</strong>hat<strong>T</strong>o<strong>F</strong>ood</h2>
            <div class="dropdown options">
              <img src="<?php echo $_SESSION['display']?>" alt="User" class="profile-pic">
              <p class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['admin']?></p>
              <div class="dropdown-menu">
                <p class="dropdown-item" onclick="window.location.href = 'EditInfo.php'">Edit Info</p>
                <p class="dropdown-item" onclick="logout()">Log Out</p>
              </div>
            </div>
        </div>
    </div>
</div>