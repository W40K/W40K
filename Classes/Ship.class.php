<?php

require_once("Dice.class.php");

abstract class Ship implements JsonSerializable {

	  /////////////////
	 // attributes  //
	/////////////////

	public static $verbose = false;

	private $_activated; // bool
	private $_faction; //fleet
	private $_hp; // array (max, now)
	private $_inerty;
	private $_name;
	private $_owner;
	private $_pp; //useful ?
	private $_shield; // 0 by default
	private $_size;
	private $_speed; // array (max, now);
	private $_sprite;
	private $_orientation;
	private $_weapons; // array of objects
	private $_x;
	private $_y;
	private $_oldX;
	private $_oldY;

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

	public function getOrientation() { return $this->_orientation; }
	public function setOrientation($orientation) { $this->_orientation = $orientation; }

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

	public function getOldX() { return $this->_oldX; }
	public function setOldX($oldX) { $this->_oldX = $oldX; }

	public function getOldY() { return $this->_oldY; }
	public function setOldY($oldY) { $this->_oldY = $oldY; }

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
			{
				$this->setOldY($this->getY());
				$this->setY($this->getY() - 1);
			}
			else
				$this->isDestroyed();
			break;
		case "down":
			if ($this->getY() + 1 < 100)
			{
				$this->setOldY($this->getY());
				$this->setY($this->getY() + 1);
			}
			else
				$this->isDestroyed();
			break;
		case "left":
			if ($this->getX() - 1 >= 0)
			{
				$this->setOldX($this->getX());
				$this->setX($this->getX() - 1);
			}
			else
				$this->isDestroyed();
			break;
		case "right":
			if ($this->getX() + 1 < 150)
			{
				$this->setOldX($this->getX());
				$this->setX($this->getX() + 1);
			}
			else
				$this->isDestroyed();
			break;
		}
		$this->setOrientation($direction);
		$this->setSpeed(["now" => $speed["now"] - 1]);
		if ($this->_checkCollision($board))
			echo "COLLISION<br />";
		else
		{
			$oldX = intVal($this->getOldX());
			$oldY = intVal($this->getOldY());
			echo "this => $oldX et $oldY";
			$board->updateBoard([
				["object" => null, "x" => $oldX, "y" => $oldY],
				["object" => $this, "x" => $this->getX(), "y" => $this->getY()]
			]);
		}
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
		return (false);
	}

	// is_destroyed
	public function isDestroyed()
	{
		$fleet = $this->getFaction();
		$name = $this->getName();
		$fleet->removeShip($name);
		echo "$name no more exists in its fleet<br />";
	}
	
	// fire
	public function fire($which, $board)
	{
		$direction = $this->getOrientation();
		$weapons = $this->getWeapons();
		$weapon = $weapons[$which];
		$shortRange = $weapon->getShortRange();
		$mediumRange = $weapon->getMediumRange();
		$longRange = $weapon->getLongRange();

		$x = $this->getX();
		$y = $this->getY();
		$start = $shortRange[0];
		$end = $longRange[1];

		echo "$x, $y, $start, $end";
	
		// straight fire
		switch ($direction)
		{
		case "up":
			for ($i = $start; $i < $end; $i++)
			{
				$block = $board->getBoard()[$y - $i][$x];
				$object = $block->getObject();
				$parent = get_parent_class($object);
				$class = get_class($object);
				if ($parent == "Ship")
				{
					echo "SHIP IS DAMAGED ===>";
					$this->_computeHit($object, $weapon, $i);
					break ;
				}
				else if ($class == "Obstacle")
				{
					echo "YOU HAVE HIT AN OBSTACLE  ===>";
					print_r($object);
					break ;
				}
			}
			break;
		case "down":
			for ($i = $start; $i < $end; $i++)
			{
				$block = $board->getBoard()[$y + $i][$x];
				$object = $block->getObject();
				$parent = get_parent_class($object);
				$class = get_class($object);
				if ($parent == "Ship")
				{
					echo "YOU HAVE HIT A SHIP ! ////";
					$this->_computeHit($object, $weapon, $i);
					break ;
				}
				else if ($class == "Obstacle")
				{
					echo "YOU HAVE HIT AN OBSTACLE  ===>";
					print_r($object);
					break ;
				}
			}
			break;
		case "left":
			for ($i = $start; $i < $end; $i++)
			{
				$block = $board->getBoard()[$y][$x - $i];
				$object = $block->getObject();
				$parent = get_parent_class($object);
				$class = get_class($object);
				if ($parent == "Ship")
				{
					echo "SHIP IS DAMAGED ===>";
					$this->_computeHit($object, $weapon, $i);
					break ;
				}
				else if ($class == "Obstacle")
				{
					echo "YOU HAVE HIT AN OBSTACLE  ===>";
					print_r($object);
					break ;
				}
			}
			break;
		case "right":
			for ($i = $start; $i < $end; $i++)
			{
				$block = $board->getBoard()[$y][$x + $i];
				$object = $block->getObject();
				$parent = get_parent_class($object);
				$class = get_class($object);
				if ($parent == "Ship")
				{
					echo "SHIP IS DAMAGED ===>";
					$this->_computeHit($object, $weapon, $i);
					break ;
				}
				else if ($class == "Obstacle")
				{
					echo "YOU HAVE HIT AN OBSTACLE  ===>";
					print_r($object);
					break ;
				}
			}
			break;
		}
	}

	private function _computeHit($object, $weapon, $i)
	{
		$shortRange = $weapon->getShortRange();
		$mediumRange = $weapon->getMediumRange();
		$longRange = $weapon->getLongRange();

$fleet = new Fleet(["name" => "Ma super flotte", "owner" => "me"]);
		if ($i <= $shortRange[1])
			$minDice = 4;
		else if ($i <= $mediumRange[1])
			$minDice = 5;
		else if ($i <= $longRange[1])
			$minDice = 6;
		else
			return (false);

		$damages = 0;
		$charges = $weapon->getCharges();
		$dice = new Dice([]);
		for ($j = 0; $j < $charges; $j++)
		{
			$result = $dice->roll(1);
			if ($result >= $minDice)
				$damages += $result;
		}
		$name = $object->getName();
		echo "$name has been hit for $damages total damages <br />";
		$hp = $object->getHp();
		$hp["now"] = $hp["now"] - $damages;
		if ($hp["now"] > 0)
		{
			echo "$name has now ". $hp['now'] ."HP";
			$object->setHp($hp);
		}
		else
		{
			echo "$name has been destroyed !";
			$object->isDestroyed();
		}
	}
}	//! end of Ship.class.php //
?>
