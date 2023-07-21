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
                if(req.responseText==""){
                    alert("Congratulations! You are now registered "+uname);
                    window.location.reload();
                }
                else{
                    var error = document.querySelector("#registration-error");
                    error.style.display = "block";
                    setTimeout(() => {
                        error.style.display="none";                        
                    }, 5000);
                    error.innerHTML = req.responseText;
                }
            };
        }
        req.send("uname="+uname+"&pword="+pword+"&email="+email);
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
        <!-- configure error message inside span, also make it look presentable -->
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
                <button class="btn btn-outline-success" onclick="register(event)">Register</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>