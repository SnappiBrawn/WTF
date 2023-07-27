<?php
  session_start();
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>WTF | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
    
    <script>
      function addToPantry(e){
        document.querySelector("#search").value = "";
        finding("");
        pantry = document.querySelector(".pantry > ul");
        for(var i=1; i<pantry.childNodes.length; i++){
          if(pantry.childNodes[i].getAttribute("id")===e.target.getAttribute('value')){
            return;
          }
        }
        pantry.innerHTML+=("<li id='"+e.target.getAttribute('value')+"'>"+e.target.innerHTML+"<span class='float-right' onclick=remove('"+e.target.getAttribute('value')+"')>&#10006</span></li>");
        fetchRecipes();
      }
      
      function finding(target){
        if(target.length<2){
          document.querySelector(".suggestions").innerHTML="";
          return
        }
        document.querySelector(".suggestions").innerHTML="";
        
        var req = new XMLHttpRequest();
        req.open("POST", "search.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        req.onreadystatechange = function() {
            if(req.readyState == 4 && req.status == 200) {
              var return_data = JSON.parse(req.responseText);
              const ul = document.querySelector(".suggestions");
              for(var i=0; i<return_data.length; i++){ 
                ul.innerHTML+=("<li value="+return_data[i][0]+" onclick=addToPantry(event)>"+return_data[i][1]+"</li>");
              }
            };
        }
        req.send("searchkey="+target);
      }
      </script>
  </head>
  <body>
  <?php include 'utils/styles.php' ?>
  <?php include 'utils/header.php' ?>
  <?php include 'utils/pantry.php' ?>
  
    <div class="s006">
      <form>
        <fieldset>
          <legend>What do you got in your pantry?</legend>
          <div class="inner-form">
            <div class="input-field">
              <button class="btn-search" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </button>
              <input id="search" type="text" onkeyup='finding(this.value)' />
              <div class="search-dropdown">
                <ul class="suggestions">
                </ul>
              </div>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
    <?php include("allRecipes.php");?>
    <?php include("utils/footer.php"); ?>
  </body>
</html>
