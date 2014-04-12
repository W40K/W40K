<?php

class Obstacle implements JsonSerializable {

	  /////////////////
	 // attributes  //
	/////////////////

	public static $verbose = false;

	private $_name;
	private $_size;
	private $_sprite;
	private $_x;
	private $_y;

	  /////////////////////////
	 // getter and setters  //
	/////////////////////////

	public function getName() { return $this->_name; }
	public function setName($name) { $this->_name = $name; }

	public function getSize() { return $this->_size; }
	public function setSize($size) { $this->_size = $size; }

	public function getSprite() { return $this->_sprite; }
	public function setSprite($sprite) { $this->_sprite = $sprite; }

	public function getX() { return $this->_x; }
	public function setX($x) { $this->_x = $x; }

	public function getY() { return $this->_y; }
	public function setY($y) { $this->_y = $y; }

	  ///////////////
	 // builtins  //
	///////////////
	
	public function __construct(array $kwargs) {

		// optional attributes, default values if not exists //
		if (array_key_exists("size", $kwargs))
			$this->setSize($kwargs["size"]);
		else
			$this->setSize(1);

		// mandatory attributes, throw error if not exists //
		$this->setName($kwargs["name"]);
		$this->setSprite($kwargs["sprite"]);
		$this->setX($kwargs["x"]);
		$this->setY($kwargs["y"]);

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

	// which data should be serialized !
	public function jsonSerialize() {
		$array = ["type" => "obstacle",
			"name" => $this->getName(),
			"size" => $this->getSize(),
			"x" => $this->getX(),
			"y" => $this->getY(),
			"sprite" => $this->getSprite()];
		return ($array);
	}

	  //////////////
	 // methods  //
	//////////////

	// someday, some obstacles could maybe move or do damages
}	//! end of Ship.class.php //
?>
