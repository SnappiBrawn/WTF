<script>
    function login(e){
        e.preventDefault();
        uname = document.querySelector("#uname").value;
        pword = document.querySelector("#pword").value;
        var req = new XMLHttpRequest();
        req.open("POST", "utils/userlogin.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200){
                if(req.responseText==""){
                    alert("Welcome "+uname);
                    window.location.reload();
                }
                else{
                    var error = document.querySelector("#error");
                    document.querySelector("#uname").value="";
                    document.querySelector("#pword").value="";
                    error.style.display = "block";
                    setTimeout(() => {
                        error.style.display="none";                        
                    }, 3000);
                    error.innerHTML = req.responseText;
                }
            };
        }
        req.send("uname="+uname+"&pword="+pword);
    }

    function logout(){
        var req = new XMLHttpRequest();
        req.open("POST", "utils/userlogout.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200){
                window.location.href = "index.php";
            };
        }
        req.send();
    }

</script>
<style>
    #error{
        display: none;
        margin: auto;
        background-color: #fca9a9;
        border-radius: 3px;
        padding: 5px;
    }
</style>

<?php include "utils/Register-modal.php";?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="form">
    <div class="modal-content">
        <div class="text-right p-3">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-header mx-auto">
        <h2 style='font-size:3rem'>LOGIN</h2>
      </div>
      <span id="error"></span>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="pword" placeholder="Password">
            </div>
            <br style="font-size:3rem">
            <div class="mx-auto" style="text-align:center">
                <button class="btn btn-outline-success" onclick="login(event)">Login</button>
                <button type=button class="btn btn-outline-primary" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Sign-up</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>