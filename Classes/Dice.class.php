<?php

class Dice {

	// attributs
	private $_diceValue;
	public static $verbose = false;

	// getter
	public function getDiceValue () {
		return $this->_diceValue;
	}

	// builtins
	public function __construct(array $kwargs) {
		if (array_key_exists("value", $kwargs))
			$this->_diceValue = $kwargs["value"];
		else
			$this->_diceValue = 6;
		if (self::$verbose)
			echo "The dice is ready to roll !\n";
	}
	public function __destruct() {
		if (self::$verbose)
			echo "Thx for having used our dice !\n";
	}
	public function __toString() {
		if (self::$verbose)
			echo "This is a " + getDiceValue() + " dice.";
	}
	public function doc() {
		echo file_get_contents("Dice.doc.txt");
	}

	// methods
	public function roll($dice_number) {
		$sum = 0;
		for ($i = 0; $i < $dice_number; $i++)
			$sum += $this->rollOne();
		return $sum;
	}
	private function rollOne() {
		$result = rand(1, $this->getDiceValue());
		if (self::$verbose)
			echo "$result\n";
		return $result;
	}
}
?>
