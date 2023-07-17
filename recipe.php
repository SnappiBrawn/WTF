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
        <title>WTF | <?php echo $rep;?></title>
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
                font-size: x-large;
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
                    <h1><?php echo $rep?></h1>
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
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $media = explode(" ",$rep->getGallery());
                    for ($index = 0; $index < count($media)-1; $index++) {
                        ?>
                        <div class="carousel-item">
                            <img class="d-block w-100" src=<?php echo "recipes/".$media[$index]." alt=".$media[$index];?>>
                        </div>
                    <?php }?>
                        <div class="carousel-item active">
                            <img class="d-block w-100" src=<?php echo "recipes/".$media[$index]." alt=".$media[$index];?>>
                        </div>
                </div>
                    <?php if (count($media) > 1) { ?>
                    <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    <?php }?>
                    </a>
            </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
            <!-- add slideshow
            add like-dislike -->
            <?php endif; ?>
            <?php include("utils/footer.php"); ?>
        </div>
    </body>
</html>