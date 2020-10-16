<?php

$connection = new mysqli('localhost', 'todo', 'password', 'todos');
$connection->query("CREATE TABLE user(
   id INT AUTO_INCREMENT,
   login VARCHAR(20) NOT NULL,
   password VARCHAR(20) NOT NULL,
   primary key (id)
)");
$connection->query("CREATE TABLE todo(
   id INT AUTO_INCREMENT,
   name VARCHAR(20) NOT NULL,
   status BOOL NOT NULL,
   primary key (id)
)");
$connection->query("CREATE TABLE users_todo(
   id_user INT NOT NULL,
   id_todo INT NOT NULL,
   FOREIGN KEY (id_user)  REFERENCES user(id),
   FOREIGN KEY (id_todo)  REFERENCES todo(id)
)");
$connection->close();