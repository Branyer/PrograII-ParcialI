<?php

session_start();

var_dump($_POST);

$board = $_SESSION['board'];
$N = $_SESSION['N'];
$i = $_POST['i'];
$j = $_POST['j'];




if ($board[$i][$j] === "*") {

    for ($k = 0; $k < $N; $k++) {

        for ($l = 0; $l < $N; $l++) {
            
                $_SESSION['board'][$k][$l] .= "-active";
            
        }
    }

    $_SESSION['game-over'] = true;
} else if ($board[$i][$j] > 0) {

    $_SESSION['board'][$i][$j] .= "-active";
} else {
    recursiva($i, $j, $N);
}


function recursiva($x, $y, $N)
{
    var_dump($_SESSION["board"][$x][$y], $x, $y);
    if ($_SESSION["board"][$x][$y] === 0) {
        $_SESSION['board'][$x][$y] .= "-active";
    }

    if ($x > 0 && $_SESSION["board"][$x - 1][$y] !== "*" && $_SESSION["board"][$x - 1][$y] > 0 && !isset(explode("-",$_SESSION['board'][$x-1][$y])[1]))
        $_SESSION['board'][$x - 1][$y] .= "-active";

    //abajo
    if ($x < $N - 1 && $_SESSION["board"][$x + 1][$y] !== "*" && $_SESSION["board"][$x + 1][$y] > 0 && !isset(explode("-",$_SESSION['board'][$x+1][$y])[1]))
        $_SESSION['board'][$x + 1][$y] .= "-active";

    //derecha
    if ($y < $N - 1 && $_SESSION["board"][$x][$y + 1] !== "*" && $_SESSION["board"][$x][$y + 1] > 0 && !isset(explode("-",$_SESSION['board'][$x][$y+1])[1]))
        $_SESSION['board'][$x][$y + 1] .= "-active";

    //izquierda
    if ($y > 0 && $_SESSION["board"][$x][$y - 1] !== "*" && $_SESSION["board"][$x][$y - 1] > 0 && !isset(explode("-",$_SESSION['board'][$x][$y-1])[1]))
        $_SESSION['board'][$x][$y - 1] .= "-active";

    //arriba derecha
    if ($x > 0 && $y < $N - 1 && $_SESSION["board"][$x - 1][$y + 1] !== "*" && $_SESSION["board"][$x - 1][$y + 1] > 0 && !isset(explode("-",$_SESSION['board'][$x-1][$y+1])[1] ))
        $_SESSION['board'][$x - 1][$y + 1] .= "-active";

    //arriba izquierda
    if ($x > 0 && $y > 0 && $_SESSION["board"][$x - 1][$y - 1] !== "*" && $_SESSION["board"][$x - 1][$y - 1] > 0 && !isset(explode("-",$_SESSION['board'][$x-1][$y-1])[1]))
        $_SESSION['board'][$x - 1][$y - 1] .= "-active";

    //abajo derecha
    if ($x < $N - 1 && $y < $N - 1 && $_SESSION["board"][$x + 1][$y + 1] !== "*" &&  $_SESSION["board"][$x + 1][$y + 1] > 0 && !isset(explode("-",$_SESSION['board'][$x+1][$y+1])[1]))
        $_SESSION['board'][$x + 1][$y + 1] .= "-active";

    //abajo izquierda
    if ($x < $N - 1 && $y > 0 && $_SESSION["board"][$x + 1][$y - 1] !== "*" &&  $_SESSION["board"][$x + 1][$y - 1] > 0 && !isset(explode("-",$_SESSION['board'][$x+1][$y-1])[1]))
        $_SESSION['board'][$x + 1][$y - 1] .= "-active";





    if (($x > 0) && $_SESSION["board"][$x - 1][$y] == 0) {
        recursiva($x - 1, $y, $N);
    }
    if (($x > 0) && ($y < $N - 1) && $_SESSION["board"][$x - 1][$y + 1] == 0) {
        recursiva($x - 1, $y + 1, $N);
    }
    if (($y < $N - 1) && $_SESSION["board"][$x][$y + 1] == 0) {
        recursiva($x, $y + 1, $N);
    }
    if (($x < $N - 1) && ($y < $N - 1) && $_SESSION["board"][$x + 1][$y + 1] == 0) {
        recursiva($x + 1, $y + 1, $N);
    }
    if (($x < $N - 1) && $_SESSION["board"][$x + 1][$y] == 0) {
        recursiva($x + 1, $y, $N);
    }

    if (($x < $N - 1) && ($y > 0) && $_SESSION["board"][$x + 1][$y - 1] == 0) {
        recursiva($x + 1, $y - 1, $N);
    }

    if (($y > 0) && $_SESSION["board"][$x][$y - 1] == 0) {
        recursiva($x, $y - 1, $N);
    }

    if (($x > 0) && ($y > 0) && $_SESSION["board"][$x - 1][$y - 1] == 0) {
        recursiva($x - 1, $y - 1, $N);
    }
}
