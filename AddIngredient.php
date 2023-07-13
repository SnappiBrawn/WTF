<?php 

include_once("classes/DB.php");
include_once("classes/ing.php");

if(!isset($_GET["id"])){
    $error = "Wait a minute,.....How did you get here?";
    echo "alert(".$error.")";
}
else{
}

?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | Ingredient</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <style>

        </style>
    </head>
    <body>
        <?php echo "<h1>".$ing_id."</h1>"; ?>
    </body>
</html>