<?php

require_once("Classes/Fighter.class.php");
require_once("Classes/Obstacle.class.php");
require_once("Classes/Fleet.class.php");
require_once("Classes/Board.class.php");

session_start();

$ship = $_SESSION[$_GET["ship"]];
$board = $_SESSION["board"];

if (isset($_GET["direction"]))
	$ship->moves($_GET["direction"], $board);

echo $board->toJson();
?>
