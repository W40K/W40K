<?php
abstract Class Ship {

	public						$name;
	public						$sprite;
	public						$race;
	public						$height;
	public						$width;
	public						$life;
	public						$pp;
	public						$speed;
	public						$agility;
	public						$shield;
	public						$mobilize;
	public						$x = 0;
	public						$y = 0;

	public function				__construct(array $targ) {
		$this->name = $targ['name'];
		$this->sprite = $targ['sprite'];
		$this->race = $targ['race'];
		$this->height = $targ['height'];
		$this->width = $targ['width'];
		$this->life = $targ['life'];
		$this->pp = $targ['pp'];
		$this->speed = $targ['speed'];
		$this->agility = $targ['agility'];
		$this->shield = $targ['shield'];
		$this->mobilize = TRUE;
		if ($this->race == "chaos")
		{
			$this->x = 145;
			$this->y = 99;
		}
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
			", array($this->name,$this->race,$this->sprite,$this->height,$this->width,$this->life,$this->pp,$this->speed,$this->agility,$this->shield,$this->mobilize));
	}
}
?>
