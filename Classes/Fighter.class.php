<?php
require_once("Ship.class.php");
require_once("Weapon.class.php");

class Fighter extends Ship {

	public $_type;

	public function __construct(array $kwargs)
	{
		parent::__construct($kwargs);
		$this->_type = "Fighter";

		//Weapon::$verbose = true;
		$weapon = new Weapon(["name" => "Mini-lasers", "sprite" => "laser.png"]);
		$this->setWeapons(["Mini-lasers" => $weapon]);
		if (self::$verbose)
		{
			print_r($this);
			echo "\n";
		}
	}
}
?>
