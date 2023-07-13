<?php 

include_once("classes/Connection.php");
include_once("classes/rep.php");

if(!isset($_GET["id"])){
    $error = "Wait a minute,.....How did you get here?";
    echo "alert(".$error.")";
}
else{
    $rep = new rep($_GET["id"]);

}

?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | Ingredient</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <?php include 'utils/styles.php' ?>
        <?php include 'utils/header.php' ?>
        <style>
            .back-arrow{
                color: darkgrey;
            }
            .back-arrow:hover{
                color: grey;
                cursor: pointer;
            }
            .content{
                border: 1px lightgreen solid;
                border-radius: 10px;
                box-shadow: 0px 0px 5px lightgreen;
            }
            .content img {
                width: 100%;
                object-fit:cover;
                object-position: center;
                height: 20em;
                padding: 5%;
                border-radius: 30px;
                overflow: hidden;
            }
            .main-content{
               padding: 3% 5%;
            }
            .main-content a{
                color: red;
            }
            .content-description{
                padding: 3%;
            }
        </style>
    
    </head>
    <body>
        <div style="padding:100 0 0 5%; font-size:3rem"><span class="back-arrow" onclick="history.back()">🔙</span></div>
        <?php if(isset($error)): ?>
            <p>Wait a minute,.....How did you get here?</p>
        <?php else: ?>
        <div class="container content">
            <div class="row">
                <div class="col-sm-4">
                    <img src=<?php echo "recipes/".$rep->getImg()." alt='".$rep."'";?> >
                </div>
                <div class="col-sm-8 main-content">
                    <h2><?php echo $rep?></h2>
                    <h3>Posted By: <?php echo $rep->getOwner();?></h3>
                    <h3>Approximate Preparation Time: <?php echo $rep->getTime();?>hrs</h3>
                    <h3>List of Ingredients:</h3>
                    <h4>
                        <ul>
                        <?php 
                        $items = explode(" ", $rep->getIngredients());
                        foreach (array_slice($items,0,4) as $i){
                            $con = Connection::getInstance();
                            $name = $con->query("select ing_Name, ing_Id from ingredients where ing_Id='".$i."'")->fetch();
                            echo "<li><a href=ingredient.php?id=".$name[1].">".$name[0]."</a></li>";
                        }
                        ?>
                        </ul>
                    </h4>
                </div>
            </div>
            <div class="content-description">
                <?php echo"<p>".$rep->getDesc()."</p>"?>
            </div>
            <?php endif; ?>
        </div>
    </body>
</html>