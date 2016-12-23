<?php
error_reporting(E_ALL & ~E_STRICT & ~E_COMPILE_WARNING & ~E_CORE_WARNING & ~E_WARNING);

//в скрипте метод для конекта к БД
require "common.php";

$name = isset($_GET["name"]) ? $_GET["name"] : "";
$surname = isset($_GET["surname"]) ? $_GET["surname"] : "";
$phone = isset($_GET["phone"]) ? $_GET["phone"] : "";
$email = isset($_GET["email"]) ? $_GET["email"] : "";

//конект к БД
connect_to_db();

//форматируем строки  - екранирутся спец символы
$name = mysql_real_escape_string($name);
$surname = mysql_real_escape_string($surname);
$phone = mysql_real_escape_string($phone);
$email = mysql_real_escape_string($email);

//вставляем в БД отметку о регистрации пользователя
$query = sprintf("insert into xdirect_contacts(name, surname, phone, email) values('%s','%s','%s','%s')",$name, $surname, $phone, $email);
$result = mysql_query($query);
if (!$result) throw new Exception("Ошибка при регистрации".mysql_error());

//формируем формируем письмо для отправки пользователю
$subject = "Регистрация на xDirect";
$body = "Поздравляем {$name} {$surname}, Вы были успешно зарегиcтрированы";
$headers = "Content-type:text/text; charset=utf-8";

//выводим сообщение о успешной регистрации
echo $body."<br>";

//отправляем письмо - настройки почтового сервера на хостинге
if (mail($email, $subject, $body, $headers, "-fwww@{$_SERVER["HTTP_HOST"]}")) echo "На ваш почтовый ящик отправлены поздравления";
?>