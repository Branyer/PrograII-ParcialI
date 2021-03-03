<?php
session_start();
date_default_timezone_set('America/Caracas');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscaminas</title>
</head>

<body>
    <div>
        <label for="n">
            <b>INGRESA EL VALOR DE N: </b>
        </label>
        <input type="number" name="n" id="n" min="8" max="20" value="8" required>
        <button onclick="cargarData(event)">Generar Tablero</button>
        <button onclick="reiniciar(event)">Reiniciar Tablero</button>
    </div>
    <p>(click derecho sobre una casilla para agregar una bandera)</p>
    <?php
    if (isset($_SESSION["board"])) {
        $board = $_SESSION["board"];
        $N = $_SESSION['N'];
        $bombs = $_SESSION['bombs'];


        $horaInicio = new DateTime($_SESSION['time-start']);
        $horaTermino = new DateTime(date('Y-m-d H:i:s', time()));

        $interval = $horaInicio->diff($horaTermino);

        $horas = $interval->format('%H');
        $minutos = $interval->format('%i');
        $segundos = $interval->format('%s');


        echo "<p>Bombas restantes: $bombs</p>";

        echo "<p>Tiempo: <span id='h'>$horas</span> : <span id='m'>$minutos</span> : <span id='s'>$segundos</span></p>";

        echo "<div id='board' style='display:grid; grid-template-columns: repeat($N, 50px); border: 1px double black; width: max-content; margin-top:50px'>";

        for ($i = 0; $i < $N; $i++) {

            for ($j = 0; $j < $N; $j++) {
                $bck = "#9c9c9c";

                $content = "";
                $disabled = "";

                if (isset($_SESSION['game-over'])) {

                    $disabled = "disabled";
                }

                if (isset(explode("-", $board[$i][$j])[1]) && $board[$i][$j] !== "*") {
                    $content = explode("-", $board[$i][$j])[0];
                    $disabled = "disabled";
                    $bck = "#D3D3D3";
                }
                if ($board[$i][$j] === "*-active") {
                    $bck = "red";
                }

                $flag = "false";

                if ($_SESSION['flag-board'][$i][$j] === "flag") {

                    $bck = "blue";
                    $flag = "true";
                }


                echo "<button id='$i-$j' style='height:50px;  background-color: $bck; border:1px solid black; outline:none; cursor:pointer' onclick='handleClickSquare(event, $flag)' onauxclick='handleFlag(event)' $disabled>$content</button>";
            }
        }

        echo "</div>";
    }

    ?>


</body>

</html>
<script>

setInterval(() => {
    if(document.querySelector("#m")){


            let s = parseInt(document.querySelector("#s").innerHTML)

            if(s+1 == 60) {

                let m = parseInt(document.querySelector("#m").innerHTML)

                if(m+1 == 60) {

                    let h = parseInt(document.querySelector("#h").innerHTML)

                    document.querySelector("#h").innerHTML = h;
                    document.querySelector("#m").innerHTML = 0;
                    document.querySelector("#s").innerHTML = 0;

                } else {

                    m++;
                    s=0; 
                    document.querySelector("#m").innerHTML = m;
                    document.querySelector("#s").innerHTML = s;
                }


            } else {

                s++;
                document.querySelector("#s").innerHTML = s;
            }
            
        }
    }, 1000)


    function cargarData(e) {

        e.preventDefault();
        const n = document.querySelector("#n").value;
        const data = new FormData();
        data.append("N", n)

        fetch("./src/loadBoard.php", {
                method: "POST",
                body: data
            })
            .then(r => window.location.reload())

    }

    function reiniciar (e) {

        fetch("./src/reset.php")
            .then(r => window.location.reload())
    }


    function handleFlag(e) {

        const i = e.target.id.split("-")[0]
        const j = e.target.id.split("-")[1]

        const data = new FormData();
        data.append("i", i)
        data.append("j", j)

        fetch("./src/handleFlag.php", {
                method: "POST",
                body: data
            })
            .then(r => r.text())
            .then(d => {
                window.location.reload()
            })


    }

    function handleClickSquare(e, flag) {
        if (!flag) {

            const i = e.target.id.split("-")[0]
            const j = e.target.id.split("-")[1]

            const data = new FormData();
            data.append("i", i)
            data.append("j", j)

            fetch("./src/squareSelected.php", {
                    method: "POST",
                    body: data
                })
                .then(r => r.text())
                .then(d => {
                     window.location.reload()
                })
        }


    }
</script>