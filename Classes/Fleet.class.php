<?php

class Fleet implements JsonSerializable {

	  /////////////////
	 // attributes  //
	/////////////////

	public static $verbose = false;

	private $_spaceships; //array
	private $_owner;
	private $_name;

	  /////////////////////////
	 // getter and setters  //
	/////////////////////////

	public function getOwner() { return $this->_owner; }
	public function setOwner ($owner) { $this->_owner = $owner; }

	public function getName() { return $this->_name; }
	public function setName ($name) { $this->_name = $name; }

	public function getSpaceships() { return $this->_spaceships; }

	  ///////////////
	 // builtins  //
	///////////////
	
	public function __construct(array $kwargs) {

		// mandatory attributes, throw error if not exists //
		$this->setName($kwargs["name"]);
		$this->setOwner($kwargs["owner"]);
		$this->_spaceships = [];

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
		$array = ["name" => $this->getName()];
		return ($array);
	}

	  //////////////
	 // methods  //
	//////////////

	public function addShip($ship) {
		$this->_spaceships[key($ship)] = $ship;
	}

	public function removeShip($shipName) {
		unset($this->_spaceships[$shipName]);
	}

	public function is_destroyed()
	{
		if (count($this->getSpaceships()) == 0)
			echo "flotte détruite ! la loose";
	}

	}	//! end of Fleet.class.php //
?>
