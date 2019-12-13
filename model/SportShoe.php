<?php
require_once "Shoe.php";
class SportShoe extends Shoe {

	function getType(){
		return "Sport Shoe";
	}

	function getImagePath(){
  		return "images/shoe/".$this->image.".jpg";
  }

  function getDisplayPrice(){
    if($this->color == "black"){
        return ($this->price * 140 / 100)." VND "." (+40%) ";
    }
     return $this->price." VND";
  }

  function getDisplayOldPrice(){
     if($this->color == "black"){
        return $this->price." VND";
     }
     return "";
  }
}
?>