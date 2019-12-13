<?php
require_once "Shoe.php";

class Sandal extends Shoe {

	function getType(){
  		return "Sandal Shoe";
  	}
	
	function getImagePath(){
  		return "images/shoe/".$this->image.".jpg";
  	}

  	function getDisplayPrice(){
  		if($this->color == "white"){
  			return ($this->price * 80 / 100)." VND "." (-20%) ";
  		}
		return $this->price." VND";
	}

	function getDisplayOldPrice(){
		if($this->color == "white"){
          return $this->price." VND";
    }
    return "";
  }
}

?>