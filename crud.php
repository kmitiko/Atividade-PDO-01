<?php

require_once('./conexao.php');



function create($aluno)
{

       try {

        $con = getConnection();
        #Insert something

        $stmt = $con->prepare("INSERT INTO aluno(nome, email) VALUES (:nome , :email)");

        $stmt->bindParam(":nome", $aluno->nome);
        $stmt->bindParam(":email", $aluno->email);

        if ($stmt->execute()) {
            echo " Aluno Cadastrado com sucesso";
        }
    } catch (PDOException $error) {
        echo "Error ao cadastrar o aluno. Error: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}
function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT nome, email FROM aluno");

            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome . "<br>";
                echo $row->email . "<br>";
            }
        } catch (PDOException $error) {
            echo "Erro ao listar as cidades. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($rs);
        }
    }
    function find($nome)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT nome, email FROM aluno WHERE nome LIKE :nome");
            # o bindParam recebe os parâmetros por referência, não é possível usar literais.
            # para literais usa-se bindValue
            $stmt->bindValue(":nome", "%{$nome}%");

            # https://www.php.net/manual/en/pdostatement.debugdumpparams
            // $stmt->debugDumpParams();

            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome . "<br>";
                        echo $row->email . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar ao aluno '{$nome}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }
    
    function update($aluno)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE aluno SET nome= :nome, email = :email WHERE id = :id");

            $stmt->bindParam(":id", $aluno->id);
            $stmt->bindParam(":nome", $aluno->nome);
            $stmt->bindParam(":email", $aluno->email);

            if ($stmt->execute())
                echo "Aluno atualizado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar o aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function delete($id)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM aluno WHERE id = ?");
            $stmt->bindParam(1, $id);

            if ($stmt->execute())
                echo "Aluno deletado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

#create test - 
$aluno = new stdClass();
$aluno->nome = "Arlequina";
$aluno->email = "arlequina@gmail.com";
create($aluno);

echo "<br><br>---<br><br>";

#get test
    get();

    echo "<br><br>---<br><br>";

#teste do find
    find("Arlequina");

#teste upgrade - Retirado aluno Maria Mitiko e incluído Mariana
    $aluno = new stdClass();   
     $aluno->nome = "Mariana";
     $aluno->email = "mariana@gmail.com";
     $aluno->id = 2;
     update($aluno); 
    
#get test
    echo "<br><br>---<br><br>";

    get();
#delete test
    echo "<br><br>---<br><br>";
    delete(2); #deletado aluno Mariana, mariana@gmail.com
    echo "<br><br>---<br><br>";
 get();