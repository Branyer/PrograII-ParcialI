<?php

session_start();

date_default_timezone_set('America/Caracas');

if (isset($_SESSION['board'])) {
    unset($_SESSION['board']);
    unset($_SESSION['N']);
    unset($_SESSION['game-over']);
    unset($_SESSION['bombs']);
    unset($_SESSION['init-board']);
    unset($_SESSION['flag-board']);
}

$N = $_POST["N"];

$bombs = round($N * $N * 0.35);
$_SESSION['bombs'] = $bombs;


//inicializando el array
$squares = array();

for ($i = 0; $i < $N; $i++) {

    $row = array_fill(0, $N, " ");

    array_push($squares, $row);
}

//añadiendo las bombas
for ($i = 0; $i < $bombs; $i++) {

    $band = false;

    do {
        $randI = rand(0, $N - 1);
        $randJ = rand(0, $N - 1);
        if ($squares[$randI][$randJ] == " ") {
            $squares[$randI][$randJ] = "*";
            $band = true;
        }
    } while ($band == false);
}


// //añadiendo los números

for ($i = 0; $i < $N; $i++) {
    for ($j = 0; $j < $N; $j++) {
        
        if ($squares[$i][$j] === " ") {
            $total = 0;
            //arriba
            if ($i > 0 && $squares[$i - 1][$j] === "*") $total++;
            //abajo
            if ($i < $N - 1 && $squares[$i + 1][$j] === "*") $total++;
            //derecha
            if ($j < $N - 1 && $squares[$i][$j + 1] === "*") $total++;
            //izquierda
            if ($j > 0 && $squares[$i][$j - 1] === "*") $total++;
            //arriba derecha
            if($i > 0 && $j < $N - 1 && $squares[$i-1][$j+1] === "*") $total++;
            //arriba izquierda
            if($i > 0 && $j > 0 && $squares[$i-1][$j-1] ==="*") $total++;
            //abajo derecha
            if($i < $N - 1 && $j < $N - 1 && $squares[$i+1][$j+1] ==="*") $total++;
            //abajo izquierda
            if($i < $N - 1 && $j > 0 && $squares[$i+1][$j-1] ==="*") $total++;


            $squares[$i][$j] = $total;
        }
    }
}



$_SESSION["board"] = $squares;
$_SESSION["init-board"] = $squares;
$_SESSION["flag-board"] = $squares;
$_SESSION['N'] = $N;
$_SESSION['time-start'] = date("Y-m-d H:i:s", time());
echo json_encode($squares);
