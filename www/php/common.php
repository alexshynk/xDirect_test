<?php
//константы доступа к БД
require "../db.php";

//функция подключения к БД
function connect_to_db(){
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSW);
	if (!$link)
		throw new Exception("Ошибка подключения к серверу MySQL: ".mysql_error());
	
	if (!@mysql_select_db(DB_NAME))
		throw new Exception("Ошибка подключения к базе данных: ".mysql_error());
	
	
	if (!@mysql_query("SET names 'utf8'"))
		throw new Exception("Ошибка установки кодировки ".mysql_error());	
	
	return $link;
}