<?php
//устанавливаем кодировку - ту же что и скрипта
header("Contet-Type: text/html; charset=UTF-8");

//в скрипте метод для конекта к БД
require "common.php";

//конект к БД
connect_to_db();

//запрос на выборк зарегистрированных пользователей
$query = "select date_reg, name, surname, phone, email from xdirect_contacts order by id desc";

//выбираем пользователей
$result = mysql_query($query);
if (!$result) throw new Exception("<p>Ошибка:<br>".mysql_error()."</p>");

//выводим на страницу пользователей
echo "<h3 style=' text-align: center;'>Зарегистрированные пользователи</h3><br>";
echo "<table style='border-collapse: collapse;  width: 100%;'>";
echo "<tr><td>Дата регистрации</td><td>Имя</td><td>Фамилия</td><td>Телефон</td><td>E-mail</td></tr>";
while ($row = mysql_fetch_assoc($result)){
	echo "<tr>";
	foreach($row as $val){
		echo "<td style='border: 1px solid black;'>$val</td>";
	}
	echo "</tr>";
}
echo "</table>";
exit;
