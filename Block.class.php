<?PHP

class						Block
{
	public					$sprite;
	public					$ship;

	public function			__construct(array $av)
	{
		$this->sprite = $av[0];
		$this->ship = $av[1];
	}
}

?>
