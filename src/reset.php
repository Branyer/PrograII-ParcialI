<?php 

session_start();
date_default_timezone_set('America/Caracas');

$_SESSION["board"] = $_SESSION["init-board"];
$_SESSION["flag-board"] = $_SESSION["init-board"];
$bombs = round($_SESSION["N"] * $_SESSION["N"] * 0.35);
$_SESSION['bombs'] = $bombs;
$_SESSION['time-start'] = date("Y-m-d H:i:s", time());
unset($_SESSION['game-over']);