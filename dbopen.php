<?php

$db = mysql_connect('localhost', 'c1mobile', '3PllYfRlZz4');

if (!$db) {
    die('Erro ao conectar ao servidor: ' . mysql_error());
}

$db_selected = mysql_select_db('c1mobile', $db);
if (!$db_selected) {
    die ('Erro ao conectar ao banco: ' . mysql_error());
}

