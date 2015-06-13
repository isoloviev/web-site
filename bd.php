<?php
session_start();

$link=mysql_connect("localhost",'u9823881_web','mwmiNrpw');
mysql_select_db("u9823881_web",$link) or die("Не доступно");
mysql_query("SET NAMES utf8");

$login = $_SESSION['login'];
$password = $_SESSION['password'];
$id_user = $_SESSION['id'];


print_r($_SESSION);