<?php
session_start();

$link = mysql_connect("localhost", 'u9823881_web', 'mwmiNrpw');
mysql_select_db("u9823881_web", $link) or die("Не доступно");
mysql_query("SET NAMES utf8");

/**
 * Получение всех пользователей в системе
 *
 * @return array
 */
function getListOfUsers()
{
    $rst = mysql_query("SELECT * FROM subscribers ORDER BY email");
    $arr = array();
    while($row = mysql_fetch_array($rst, MYSQL_ASSOC)) {
        $arr[] = $row;
    }
    mysql_free_result($rst);
    return $arr;
}

/**
 * Получение всех подписок
 *
 * @return array
 */
function getListOfSubscribes()
{
    $rst = mysql_query("SELECT * FROM lists ORDER BY listid");
    $arr = array();
    while($row = mysql_fetch_array($rst, MYSQL_ASSOC)) {
        $arr[] = $row;
    }
    mysql_free_result($rst);
    return $arr;
}