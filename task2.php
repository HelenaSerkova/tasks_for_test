<?php
/*
 Есть несколько таблиц в БД: users, objects
 1.	users: id, login, password, object_id
 2.	objects: id, name, status
 Нужно сделать выборку пользователей из базы данных с использованием конструкции
 JOIN у которых есть запись в таблице objects, соответствующая значению object_id
*/

$query = "SELECT * FROM users JOIN objects ON users.object_id = objects.id"

?>

SELECT *
FROM users
JOIN objects
ON users.object_id = objects.id
