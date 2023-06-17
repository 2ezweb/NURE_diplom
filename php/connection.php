<?php
    $hn = 'localhost';
    $db = 'nure_classroom';
    $un = 'root';
    $pw = 'root';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
?>