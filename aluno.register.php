<?php

require_once('./crud.php');


if($_POST['txtaluno'] == NULL || $_POST['txtemail'] == NULL)
{
    header('location: ./error.php?status=access-deny'); #redirecionar para a página error.php
    die(); #matar o carregamento da página
}

$aluno = new stdClass();
$aluno->nome=$_POST['txtaluno'];
$aluno->email=$_POST['txtemail'];

create($aluno);

#$result = create($_POST['txtAluno'], $_POST['txtEmail']);


# ?status=access-deny = query string  --> $status = access deny
# chave1=valor1&chave2=valor2&chave3=valor3 ... 