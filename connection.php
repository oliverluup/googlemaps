<?php

$mysqli = new mysqli(
    "x",
    "x",
    "x",
    "x"
);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
