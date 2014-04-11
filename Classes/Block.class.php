<?php

require_once("Block.class.php");

class Block {

	  /////////////////
	 // attributes  //
	/////////////////

	public static $verbose = false;

	public $_sprite;
	public $_object;

	  /////////////////////////
	 // getter and setters  //
	/////////////////////////

	public function getSprite() { return $this->_sprite; }
	public function setSprite($sprite) { $this->_sprite = $sprite; }

	public function getObject() { return $this->_object; }
	public function setObject($object) { $this->_object = $object; }

	  ///////////////
	 // builtins  //
	///////////////
	
	public function __construct(array $kwargs) {

		// optional attributes, default values if not exists //
		if (array_key_exists("object", $kwargs))
			$this->setObject($kwargs["object"]);
		else
			$this->setObject(null);

		$this->__toString();
	}

	public function __destruct() {
		if (self::$verbose)
			echo $this->getName()." no more used !<br />";
	}

	public function __toString() {
		if (self::$verbose)
		{
			echo "<u>".$this->getName()." :</u><br/>";
			echo "<u>Attributes</u><br/>";
			print_r($this);
			echo "<br />";
			echo "<u>Methods</u><br/>";
			print_r(get_class_methods($this));
			echo "<br />";
		}
	}

	public function doc() {
		echo file_get_contents("Dice.doc.txt");
	}

	  //////////////
	 // methods  //
	//////////////

}	//! end of Block.class.php //
?>
