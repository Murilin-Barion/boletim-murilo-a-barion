<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas e médias</title>
</head>
<body>

<form name="formulário" method="post" aciton="exemplo1.php">
<fieldset>

Digite seu nome: <br>
<input type="text" name="nome"><br><br>

Nota 1: <br>
<input type="number" name="nota1" min="0" max="10"><br><br>

Nota 2: <br>
<input type="number" name="nota2" min="0" max="10"><br><br>

Nota 3: <br>
<input type="number" name="nota3" min="0" max="10"><br><br>

Nota 4: <br>
<input type="number" name="nota4" min="0" max="10"><br><br>


<input type="submit" value="Enviar" name="Enviar">

</fieldset>
</form> 

<?php

require_once "conexao.php";

if(isset($_REQUEST["Enviar"]))
{

    $nome = $_REQUEST["nome"];
    $nota1 = $_REQUEST["nota1"];
    $nota2 = $_REQUEST["nota2"];
    $nota3 = $_REQUEST["nota3"];
    $nota4 = $_REQUEST["nota4"];

    $media =  ($nota1 + $nota2 + $nota3 + $nota4)/4;
    if($media >= 7.5)
    {
        $situacao = "Aprovado";
    }
    else
    {
        $situacao = "Reprovado";
    }

    try{

        $sql = $conn->prepare("INSERT INTO tb_boletim (cod_boletim, nome, nota1, nota2, nota3, nota4, media, situacao, ativo) 
                               VALUES (:cod_boletim, :nome, :nota1, :nota2, :nota3, :nota4, :media, :situacao, :ativo) ");

        # passagem de parâmetros para a tabela
        $sql->bindValue(":cod_boletim", null);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":nota1", $nota1);
        $sql->bindValue(":nota2", $nota2);
        $sql->bindValue(":nota3", $nota3);
        $sql->bindValue(":nota4", $nota4);
        $sql->bindValue(":media", $media);
        $sql->bindValue(":situacao", $situacao);
        $sql->bindValue(":ativo", 1);

        # execução da query de inserção
        $sql->execute();

        # msg caso não ocorra erro
        echo"<script language=javascript>alert('Dados gravados com Sucesso !!'); location.href = 'cadastro.php';</script>";

        }

        # caso não executar captura o erro no bd
        catch (PDOException $erro)
        {
            echo $erro->getMessage();
        }

}
?>

<h1>Consulta</h1>

<!-- tabela com consulta do bd -->
<table border=1 >
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">Média</th>
        <th scope="col">Situação</th>
        <th scope="col">Ações</th>
    </tr>

<?php 

try{
    
     //cria a variavel consulta que ira armazenar resultado sql
     $consulta = $conn->prepare("SELECT * FROM tb_boletim WHERE ativo= 1;");
     $consulta->execute();

     //codigo para consulta 
     while ( $row = $consulta->fetch(PDO::FETCH_ASSOC)) {
     ?> 

    <tr>
      <td><?php echo $row["nome"]?></td>
      <td><?php echo $row["media"]?></td>
      <td><?php echo $row["situacao"]?></td>

        <td>
        <a href="cadastro.php?id=<?php echo $row["cod_boletim"]; ?>">Detalhes</a>
        <a href="alterar.php?al=<?php echo $row["cod_boletim"];  ?>">Alterar</a>
        <a href="cadastro.php?ex=<?php echo $row["cod_boletim"]; ?>">Excluir</a>
        </td>
    <tr>
<?php 
  } 

}
catch (PDOException $erro) {
    echo $erro->getMessage();
}

try{

    # exclusão de uma linha do bd
    if(ISSET($_REQUEST["ex"]))
    {
        $cod_boletim = $_REQUEST["ex"];
        $delete = $conn->prepare("UPDATE tb_boletim SET ativo = 0 WHERE cod_boletim=:cod_boletim;");
        $delete->bindValue(':cod_boletim', $cod_boletim);
        $delete->execute();

        echo"<script language=javascript>alert('O aluno foi excluído com Sucesso !!'); location.href = 'cadastro.php';</script>
        ";
    }

}
catch(PDOException $erro)
{
   
    echo $erro->getMessage();

}

?>
</table>
</body>
</html>