<?php

require_once("Dice.class.php");

abstract class Ship implements JsonSerializable {

	  /////////////////
	 // attributes  //
	/////////////////

	public static $verbose = false;

	private $_activated; // bool
	private $_faction;
	private $_hp; // array (max, now)
	private $_inerty;
	private $_name;
	private $_owner;
	private $_pp; //useful ?
	private $_shield; // 0 by default
	private $_size;
	private $_speed; // array (max, now);
	private $_sprite;
	private $_weapons; // array of objects
	private $_x;
	private $_y;

	  /////////////////////////
	 // getter and setters  //
	/////////////////////////

	public function getFaction() { return $this->_faction; }
	public function setFaction($faction) { $this->_faction = $faction; }

	public function getHp() { return $this->_hp; }
	public function setHp($hp) {
		if (array_key_exists("max", $hp))
			$this->_hp["max"] = $hp["max"];
		if (array_key_exists("now", $hp))
			$this->_hp["now"] = $hp["now"];
	}

	public function getInerty() { return $this->_inerty; }
	public function setInerty($inerty) { $this->_inerty = $inerty; }

	public function getName() { return $this->_name; }
	public function setName($name) { $this->_name = $name; }

	public function getOwner() { return $this->_owner; }
	public function setOwner ($owner) { $this->_owner = $owner; }

	public function getPp() { return $this->_pp; }
	public function setPp ($pp) {
		if (array_key_exists("max", $pp))
			$this->_pp["max"] = $pp["max"];
		if (array_key_exists("now", $pp))
			$this->_pp["now"] = $pp["now"];
	}

	public function getShield() { return $this->_shield; }
	public function setShield($shield) { $this->_shield = $shield; }

	public function getSize() { return $this->_size; }
	public function setSize($size) { $this->_size = $size; }

	public function getSpeed() { return $this->_speed; }
	public function setSpeed($speed) {
		if (array_key_exists("max", $speed))
			$this->_speed["max"] = $speed["max"];
		if (array_key_exists("now", $speed))
			$this->_speed["now"] = $speed["now"];
	}

	public function getSprite() { return $this->_sprite; }
	public function setSprite($sprite) { $this->_sprite = $sprite; }

	public function getWeapons() { return $this->_weapons; }
	public function setWeapons($weapons) { $this->_weapons = $weapons; }

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
		if (array_key_exists("hp", $kwargs))
			$this->setHp(["max" => $kwargs["hp"], "now" => $kwargs["hp"]]);
		else
			$this->setHp(["max" => 5, "now" => 5]);
		if (array_key_exists("pp", $kwargs))
			$this->setPp(["max" => $kwargs["pp"], "now" => $kwargs["pp"]]);
		else
			$this->setPp(["max" => 10, "now" => 10]);
		if (array_key_exists("speed", $kwargs))
			$this->setSpeed(["max" => $kwargs["speed"], "now" => $kwargs["speed"]]);
		else
			$this->setSpeed(["max" => 10, "now" => 10]);
		if (array_key_exists("inerty", $kwargs))
			$this->setInerty($kwargs["inerty"]);
		else
			$this->setInerty(2);
		if (array_key_exists("shield", $kwargs))
			$this->setShield($kwargs["shield"]);
		else
			$this->setShield(0);

		// mandatory attributes, throw error if not exists //
		$this->setName($kwargs["name"]);
		$this->setSprite($kwargs["sprite"]);
		$this->setFaction($kwargs["faction"]);
		$this->setOwner($kwargs["owner"]);
		$this->setWeapons(null);
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
		$array = ["faction" => $this->getFaction(),
			"inerty" => $this->getInerty(),
			"name" => $this->getName(),
			"owner" => $this->getOwner(),
			"pp" => $this->getPp(),
			"hp" => $this->getHp(),
			"shield" => $this->getShield(),
			"size" => $this->getSize(),
			"speed" => $this->getSpeed(),
			"sprite" => $this->getSprite(),
			"weapons" => $this->getWeapons()];
		return ($array);
	}

	  //////////////
	 // methods  //
	//////////////

	// activates
	public function activates($bool) {
		$this->$_activated = $bool;
	}

	// upgrades (pp)
	public function upgrade($data) {
		$dice = new Dice([]);
		print_r($data);
		// $what, $how, $which
		$what = $data["what"];
		$how = $data["how"];
		if (array_key_exists("which", $data))
			$which = $data["which"];
		switch ($what)
		{
		case "speed":
			$result = $dice->roll($data["how"]);
			$this->setSpeed($this->getSpeed() + $result);
			break ;
		case "shield":
			$this->setShield($this->getShield() + $data["how"]);
			break ;
		case "weapon":
			$result = $dice->roll($data["how"]);
			$weapons = $this->getWeapons();
			print_r($weapons);
			$weapon = $weapons[$which];
			$weapon->setBonus($result);
			break ;
		}
	}

	// moves
	public function moves($direction, $board)
	{
		$speed = $this->getSpeed();
		if ($speed["now"] - 1 < 0)
		{
			echo "not enough speed";
			return (false);
		}
		switch ($direction)
		{
		case "up":
			if ($this->getY() - 1 >= 0)
				$this->setY($this->getY() - 1);
			else
				$this->isDestroyed();
			break;
		case "down":
			if ($this->getY() + 1 < 100)
				$this->setY($this->getY() + 1);
			else
				$this->isDestroyed();
			break;
		case "left":
			if ($this->getX() - 1 >= 0)
				$this->setX($this->getX() - 1);
			else
				$this->isDestroyed();
			break;
		case "right":
			if ($this->getX() + 1 < 150)
				$this->setX($this->getX() + 1);
			else
				$this->isDestroyed();
			break;
		}
		$this->setSpeed(["now" => $speed["now"] - 1]);
		if ($this->_checkCollision($board))
			echo "COLLISION<br />";
		else
			return (true);
	}

	// Collision ?
	private function _checkCollision($board)
	{
		$boum = $this->_isObstacle($board);
		if ($boum == "dead")
			$this->isDestroyed();
		else if ($boum == "damages")
			echo "DAMAGES<br />";
		else
			return (false);
	}
	private function _isObstacle($board)
	{
		$x = $this->getX();
		$y = $this->getY();
		$block = $board->getBoard()[$y][$x];
		$object = $block->getObject();
		if ($object)
		{
			$str = get_parent_class($object);
			if ($str == "Ship")
				return "damages";
			else
				return "dead";
		}
		
		echo $str;
		echo "<br /><br />";
		return (false);
	}

	// is_destroyed
	public function isDestroyed()
	{
		// destroy ship in flotte;
		// parent::destroyShip ?
		echo "DESTRUCTION <br />";
	}
	
	// fire
	public function fire(Weapon $weapon)
	{
		// to do !
	}
}	//! end of Ship.class.php //
?>
