<?php

    session_start();
    session_destroy();

    $url = $_GET['a'];
    $url = explode("/", $url);
    $url = $url[2];

    header("Location: ../" . $url);

?>