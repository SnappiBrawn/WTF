<script>
    function register(e){
        e.preventDefault();
        uname = document.querySelector("#username").value;
        pword = document.querySelector("#password").value;
        email = document.querySelector("#email").value;
        var req = new XMLHttpRequest();
        req.open("POST", "utils/userregister.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200){
                if(req.responseText[0]=="V"){
                    document.querySelector("#submitter").style.display = 'none';
                    document.querySelector("#verifier").style.display = 'block';
                }
                else{
                    var err = document.querySelector("#registration-error");
                    err.style.display="block";
                    err.innerHTML = req.responseText;

                }
            };
        }
        req.send("uname="+uname+"&pword="+pword+"&email="+email);
        
    }
    
    function verify(e){
        e.preventDefault();
        email = document.querySelector("#otp").value;
        var req = new XMLHttpRequest();
        req.open("POST", "utils/verifyUser.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200){
                if(req.responseText[0]=="U"){
                    var err = document.getElementById("registration-error");
                    err.style.display="block";
                    err.style.backgroundColor = 'lightgreen';
                    err.innerHTML = req.responseText;
                    window.location.reload();
                }
                else{
                    var err = document.getElementById("registration-error");
                    err.style.display="block";
                    err.innerHTML = req.responseText;
                }
            };
        }
        req.send("code="+email+"&uname="+uname);
    }

</script>
<style>
    .bf{
        z-index:100;
    }
    #registration-error{
        display: none;
        margin: auto;
        background-color: #fca9a9;
        border-radius: 3px;
        padding: 5px;
    }
    #verifier{
        display:none;
        gap: 5px;
        text-align: center;
    }
    #verifier > input{
        margin: auto;
        text-align: center;
        width: 10%;
    }
</style>


<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered bf" role="form">
    <div class="modal-content">
        <div class="text-right p-3">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-header mx-auto">
        <h2 style='font-size:3rem'>SIGN UP</h2>
      </div>
      <span id="registration-error"></span>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <input type="text" class="form-control" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="Password" class="form-control" id="cnfpword" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <br style="font-size:3rem">
            
            <div class="mx-auto" style="text-align: center;">
                <div id='verifier'>
                    Enter the OTP sent to your email<br>
                    <input type='text' id="otp" placeholder="....."><br>
                    <button class="btn btn-outline-success" onclick="verify(event)">Verify</button>
                </div>
                <div id='submitter'>
                    <button class="btn btn-outline-success" onclick="register(event)">Register</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>