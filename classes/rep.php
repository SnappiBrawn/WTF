<?php
include_once "Connection.php";
class rep {
    private $id;
    private string $name;
    private $owner;
    private $time;
    private $morals;
    private $desc;
    private $ingredients;
    private $img;
    private $gallery;
    private $likes;

    public function __construct($var) {
        $con = Connection::getInstance();
        try{
            $recipe = $con->query("select * from recipes where rep_Id='".$var."'")->fetch();
            if(gettype($recipe)=="boolean"){
                throw new Exception("Does not exist");
            }
            $this->id=$recipe[0];
            $this->name=$recipe[1];
            $this->owner=$recipe[2];
            $this->time=$recipe[3];
            $this->morals=$recipe[4];
            $this->desc=$recipe[5];
            $this->ingredients=$recipe[6];
            $this->img=$recipe[7];
            $this->gallery=$recipe[8];
            $this->likes=$recipe[9];
        }
        catch(Exception $e){
            echo("");
        }
    }

    public function __toString(){
        return $this->name;
    }


    public function getOwner(){return $this->owner;}
    public function getTime(){return $this->time;}
    public function getMorals(){return $this->morals;}
    public function getDesc(){return $this->desc;}
    public function getImg(){return $this->img;}
    public function getIngredients(){return $this->ingredients;}
    public function getId(){return $this->id;}
    public function getGallery(){return $this->gallery;}
    public function getLikes(){return $this->likes;}
}