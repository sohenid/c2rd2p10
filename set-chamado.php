<?php

if (isset($_POST['device_id']) && $_POST['device_id'] != null)
{

    $device_id = addslashes($_POST['device_id']);

    include('dbopen.php');

    $sql = "INSERT INTO chamado (device_id, data_insert) VALUES ('{$device_id}', now())";

    $result = mysql_query($sql);

    include('dbclose.php');

    if ($result)
    {
        echo 'Garçom avisado! Aguarde um momento até que o Garçom vá até a mesa atendê-lo!';
    }
    else
    {
        echo 'Não foi possível chamar o Garçom.';
    }
}
else
{
    echo 'Não foi possível chamar o Garçom.';
}
