<?php
$username = "root";
$host = "localhost";
$db = "ecommerce";
$password = "";

$conn = mysqli_connect($host, $username, $password, $db);

if (mysqli_connect_error())
{
    echo "koneksi error";
    die;
}
