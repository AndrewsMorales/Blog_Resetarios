<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$basedatos = 'blog_master';
$port = 3306;
$db = mysqli_connect($host, $user, $pass, $basedatos, $port);

mysqli_query($db, "SET NAMES 'utf8'");

//Iniciar la sesion
if (!isset($_SESSION)) {
	session_start();
}
