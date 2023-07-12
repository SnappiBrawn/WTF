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
        <title>WTF | Ingredient</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <?php include 'utils/styles.php' ?>
        <?php include 'utils/header.php' ?>
        <style>
            .content{
                border: 1px lightgreen solid;
                border-radius: 10px;
                box-shadow: 0px 0px 5px lightgreen; 
                margin-top: 100px;
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
        <div class="container content">
            <div class="row">
                <div class="col-sm-4">
                    <img src=<?php echo $ing->getImg()." alt=".$ing;?> >
                </div>
                <div class="col-sm-8 main-content">
                    <h2><?php echo $ing?></h2>
                    <h3>Posted By: <?php echo $ing->getOwner()?></h3>
                    <h3>Common Measure: <?php echo $ing->getUnit();?></h3>
                    <h3>Popularly used in:</h3>
                    <h4>
                        <ul>
                        <?php 
                        $items = explode(" ", $ing->getLink());
                        foreach (array_slice($items,0,4) as $i){
                            $con = Connection::getInstance();
                            $name = $con->query("select rep_Name, rep_Id from recipes where rep_Id='".$i."'")->fetch();
                            echo "<li><a href=recipe.php?id=".$name[1].">".$name[0]."</a></li>";
                        }
                        ?>
                        </ul>
                    </h4>
                </div>
            </div>
            <div class="content-description">
                <?php echo"<p>".$ing->getDesc()."</p>"?>
            </div>

        </div>
    </body>
</html>