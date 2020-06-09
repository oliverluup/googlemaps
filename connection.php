<?php

$mysqli = new mysqli(
    "d82731.mysql.zonevs.eu",
    "d82731_googlecha",
    "kool on tore1",
    "d82731_chagoogle"
);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}