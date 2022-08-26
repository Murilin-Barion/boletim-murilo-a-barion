<!DOCTYPE html>
<html lang="en">
<head>
    <title>Boletim Escolar</title>
</head>

<?php 

    require_once "conexao.php";
    
    #consulta de uma linha específica do bd
    try{ 
        if(ISSET($_REQUEST["al"])){
            $cod_boletim = $_REQUEST["al"];
            $consulta = $conn->prepare("SELECT * FROM tb_boletim where cod_boletim= :cod_boletim;");
            $consulta->bindValue(':cod_boletim', $cod_boletim);
            $consulta->execute();
            $row=$consulta -> fetch(PDO::FETCH_ASSOC);
       }

    }catch (PDOException $erro){
        echo $erro->getMessage();
    }
?>

<body>

<?php 

try{
    if(ISSET($_REQUEST["bt_alterar"]))
    {
    
        # recebe os dados do formulario
        $cod_boletim = $_REQUEST["cod_boletim"];
        $nome = $_REQUEST["nome"];
        $nota1 = $_REQUEST["nota1"];
        $nota2 = $_REQUEST["nota2"];
        $nota3 = $_REQUEST["nota3"];
        $nota4 = $_REQUEST["nota4"];

        # calculo da media
        $media = ($nota1 + $nota2 + $nota3 + $nota4) / 4;

        # situacao do aluno
        if($media >= 7.5)
        {
            $situacao = "Aprovado";
        }
        else
        {
            $situacao = "Reprovado";
        }

        

        # update na tabela
        $sql = $conn->prepare("UPDATE tb_boletim SET cod_boletim= :cod_boletim, nome= :nome, nota1= :nota1, nota2= :nota2, nota3= :nota3, nota4= :nota4, media= :media, situacao= :situacao WHERE cod_boletim= :cod_boletim");

        $sql->bindValue(':cod_boletim', $cod_boletim);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':nota1', $nota1);
        $sql->bindValue(':nota2', $nota2);
        $sql->bindValue(':nota3', $nota3);
        $sql->bindValue(':nota4', $nota4);
        $sql->bindValue(':media', $media);
        $sql->bindValue(':situacao', $situacao);

        $sql->Execute();
        
        # "pop-up" informando que a alteração foi feita e redirecionamnto para cadastro.php
        echo"<script language=javascript>alert('Alteração efetuada com Sucesso !!'); location.href = 'cadastro.php? al=$cod_boletim';</script>";
    }
}   
    
    catch (PDOException $erro){
        echo $erro->getMessage();
    }

?>
</body>
</html>

<h2>Alterar informações do Boletim Escolar</h2>
<!-- Formulário de alteração -->
<fieldset>
    <form action="alterar.php" method="post">
    
        <p>ID do Aluno<br>
            <input type="text" required name="cod_boletim" value="<?php echo $row['cod_boletim'] ?>" readonly>
        </p>

        <p>Nome do Aluno<br>
            <input type="text" required name="nome" value="<?php echo $row['nome']?>">
        </p>

        <p>Nota 01<br>
            <input type="text" required name="nota1" value="<?php echo $row['nota1']?>">
        </p>

        <p>Nota 02<br>
            <input type="text" required name="nota2" value="<?php echo $row['nota2']?>">
        </p>

        <p>Nota 03<br>
            <input type="text" required name="nota3" value="<?php echo $row['nota3']?>">
        </p>

        <p>Nota 04<br>
            <input type="text" required name="nota4" value="<?php echo $row['nota4']?>">
        </p>

        <input type="submit" name="bt_alterar" value="Alterar">
    </form>

    <p><a href="exemplo1.php">Voltar para a página de cadastro/consulta</a></p>

</fieldset>