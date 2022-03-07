<?php

require_once('./aluno.crud.php');

if($_POST['txtAluno'] == NULL || $_POST['txtEmail'] == NULL)
{
    header('location: ./error.php?status=access-deny'); #redirecionar para a página error.php
    die(); #matar o carregamento da página
}

$result = fnAddAluno($_POSTR['txtAluno'], $_POST['txtEmail']);
echo $result;

# ?status=access-deny = query string  --> $status = access deny
# chave1=valor1&chave2=valor2&chave3=valor3 ... 