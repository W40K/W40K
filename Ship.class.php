<?php
abstract Class Ship {

	protected				$_name;
	protected				$_sprite;
	protected				$_race;
	protected				$_height;
	protected				$_width;
	protected				$_life;
	protected				$_pp;
	protected				$_speed;
	protected				$_agility;
	protected				$_shield;
	protected				$_mobilize;

	public function				__construct(array $targ) {
		$this->_name = $targ['name'];
		$this->_sprite = $targ['sprite'];
		$this->_race = $targ['race'];
		$this->_height = $targ['height'];
		$this->_width = $targ['width'];
		$this->_life = $targ['life'];
		$this->_pp = $targ['pp'];
		$this->_speed = $targ['speed'];
		$this->_agility = $targ['agility'];
		$this->_shield = $targ['shield'];
		$this->_mobilize = TRUE;
	}
	public function 			__toString() {
		return vsprintf("
			\tName : %s\n
			\tType : ".__CLASS__."\n
			\tRace : %s\n
			\tSprite : %s\n
			\tHeight : %d\n
			\tWidth : %d\n
			\tLife : %d\n
			\tPP : %d\n
			\tSpeed : %d\n
			\tAgility : %d\n
			\tShield : %d\n
			\tMobilize : %d\n
			", array($this->_name,$this->_race,$this->_sprite,$this->_height,$this->_width,$this->_life,$this->_pp,$this->_speed,$this->_agility,$this->_shield,$this->_mobilize));
	}
}
?>
