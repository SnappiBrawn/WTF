<?php 

include_once("classes/Connection.php");
include_once("classes/ing.php");

if(!isset($_GET["id"])){
    $error = "Wait a minute,.....How did you get here?";
    echo "alert(".$error.")";
}
else{
    $ing = new ing($_GET["id"]);

}

?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | Ingredient - <?php echo $ing ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <?php include 'utils/styles.php' ?>
        <?php include 'utils/header.php' ?>
        <style>
            
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
                    <img src=<?php echo $ing->getImg()." alt=".$ing;?> >
                </div>
                <div class="col-sm-8 main-content">
                    <h2><?php echo $ing?></h2>
                    <h3>Posted By: <?php echo $ing->getOwner()?></h3>
                    <h3>Unit of Measurement: <?php echo $ing->getUnit();?></h3>
                    <h3>Popularly used in:</h3>
                    <h4>
                        <ul>
                        <?php 
                        $con = Connection::getInstance();
                        $items = $con->query("select rep_Name,rep_Id from recipes where FIND_IN_SET('".$ing->getId()."', rep_Ingredients) limit 4");
                        if ($items->rowCount() >0){
                            foreach ($items as $i){
                                echo "<li><a href=recipe.php?id=".$i[1].">".$i[0]."</a></li>";
                            }
                        }
                        else{
                            echo "<p style='color:black'>No related recipes yet</p>";
                        }
                        ?>
                        </ul>
                    </h4>
                </div>
            </div>
            <div class="content-description">
                <?php echo"<p>".$ing->getDesc()."</p>"?>
            </div>
            <?php endif; ?>
        </div>
    </body>
</html>