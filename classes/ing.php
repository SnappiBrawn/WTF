<?php
include_once "Connection.php";
class ing {
    private $id;
    private string $name;
    private $unit;
    private $owner;
    private $desc;
    private $img;
    private $link;

    public function __construct($var) {
        $con = Connection::getInstance();
        try{
            $ingredient = $con->query("select * from ingredients where ing_ID='".$var."'")->fetch();
            if(gettype($ingredient)=="boolean"){
                throw new Exception("Does not exist");
            }
            $this->id=$ingredient[0];
            $this->name=$ingredient[1];
            $this->unit=$ingredient[2];
            $this->owner=$ingredient[3];
            $this->desc=$ingredient[4];
            $this->img=$ingredient[5];
            $this->link=$ingredient[6];
        }
        catch(Exception $e){
            echo("");
        }
    }

    public function __toString(){
        return $this->name;
    }

    public function getUnit(){return $this->unit;}
    public function getOwner(){return $this->owner;}
    public function getDesc(){return $this->desc;}
    public function getImg(){return $this->img;}
    public function getLink(){return $this->link;}
    public function getId(){return $this->id;}
}