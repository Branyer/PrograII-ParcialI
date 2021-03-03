<?php 

session_start();



if($_SESSION['flag-board'][$_POST['i']][$_POST['j']] ==="flag") {

    $_SESSION['flag-board'][$_POST['i']][$_POST['j']] = "0";
    $_SESSION['bombs'] ++;

} else {

    $_SESSION['flag-board'][$_POST['i']][$_POST['j']] = "flag";
    $_SESSION['bombs'] --;

}


