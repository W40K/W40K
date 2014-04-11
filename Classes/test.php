<?php

require_once("Fighter.class.php");
require_once("Obstacle.class.php");
require_once("Fleet.class.php");
require_once("Board.class.php");

Board::$verbose = true;
$board = new Board(["width" => 150, "height" => 100]);
$board->initBoard();

//Fleet::$verbose = true;
$fleet = new Fleet(["name" => "Ma super flotte", "owner" => "me"]);
//Fighter::$verbose = true;
$ship = new Fighter(["name" => "Foo Fighter", "faction" => "zikos",
	"x" => 1, "y" => 0, "owner" => "me", "sprite" => "fighter.png"]);
$ship2 = new Fighter(["name" => "Foo Fighter2", "faction" => "zikos",
	"x" => 2, "y" => 0, "owner" => "me", "sprite" => "fighter.png"]);
$planet = new Obstacle(["name" => "Planet X", "x" => 1, "y" => 1, "sprite" => "planet.jpg"]);
$board->updateBoard([
		["object" => $ship, "x" => 1, "y" => 0],
		["object" => $ship2, "x" => 2, "y" => 0],
		["object" => $planet, "x" => 1, "y" => 1]
	]);

$ship->moves("down", $board);
echo $board->toJson();
?>
