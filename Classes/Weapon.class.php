<?php

require_once("Dice.class.php");

class Weapon implements JsonSerializable {

	  /////////////////
	 // attributes  //
	/////////////////

	public static $verbose = false;

	private $_bonus;
	private $_charges;
	private $_effectZone;
	private $_longRange;
	private $_mediumRange;
	private $_name;
	private $_power;
	private $_shortRange;
	private $_sprite;

	  /////////////////////////
	 // getter and setters  //
	/////////////////////////

	public function getCharges() { return $this->_charges; }
	public function setCharges($charges) { $this->_charges = $charges; }

	public function getShortRange() { return $this->_shortRange; }
	public function setShortRange($shortRange) { $this->_shortRange = $shortRange; }

	public function getLongRange() { return $this->_longRange; }
	public function setLongRange ($longRange) { $this->_longRange = $longRange; }

	public function getMediumRange() { return $this->_mediumRange; }
	public function setMediumRange ($mediumRange) { $this->_mediumRange = $mediumRange; }

	public function getEffectZone() { return $this->_effectZone; }
	public function setEffectZone ($effectZone) { $this->_effectZone = $effectZone; }

	public function getPower() { return $this->_power; }
	public function setPower($power) { $this->_power = $power; }
	
	public function getName() { return $this->_name; }
	public function setName($name) { $this->_name = $name; }

	public function getBonus() { return $this->_bonus; }
	public function setBonus($bonus) { $this->_bonus = $bonus; }

	public function getSprite() { return $this->_sprite; }
	public function setSprite($sprite) { $this->_sprite = $sprite; }

	  ///////////////
	 // builtins  //
	///////////////
	
	public function __construct(array $kwargs) {

		// optional attributes, default values if not exists //
		if (array_key_exists("shortRange", $kwargs))
			$this->setShortRange($kwargs["shortRange"]);
		else
			$this->setShortRange([1, 10]);
		if (array_key_exists("mediumRange", $kwargs))
			$this->setMediumRange($kwargs["mediumRange"]);
		else
			$this->setMediumRange([11, 21]);
		if (array_key_exists("longRange", $kwargs))
			$this->setLongRange($kwargs["longRange"]);
		else
			$this->setLongRange([21, 30]);
		if (array_key_exists("effectZone", $kwargs))
			$this->setEffectZone($kwargs["effectZone"]);
		else
			$this->setEffectZone(10);
		if (array_key_exists("power", $kwargs))
			$this->setPower($kwargs["power"]);
		else
			$this->setPower(1);
		if (array_key_exists("charges", $kwargs))
			$this->setCharges($kwargs["charges"]);
		else
			$this->setCharges(5);

		// mandatory attributes, throw error if not exists //
		$this->setName($kwargs["name"]);
		$this->setSprite($kwargs["sprite"]);
		$this->setBonus(0);

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
		return ("nothing");
	}

	public function doc() {
		echo file_get_contents("Dice.doc.txt");
	}

	// which data should be serialized !
	public function jsonSerialize() {
		$array = ["bonus" => $this->getBonus(),
			"charges" => $this->getCharges(),
			"effectZone" => $this->getEffectZone(),
			"longRange" => $this->getLongRange(),
			"mediumRange" => $this->getMediumRange(),
			"name" => $this->getName(),
			"power" => $this->getPower(),
			"shortRange" => $this->getShortRange(),
			"sprite" => $this->getSprite()];
		return ($array);
	}

	  //////////////
	 // methods  //
	//////////////

	public function showRange()
	{
		echo $this->getShortRange();
		echo $this->getMediumRange();
		echo $this->getLargeRange();
	}
}
