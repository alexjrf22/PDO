<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>  
        <h2>Altere os dados do aluno:</h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <label>Altere o nome:</label>
            <input name="nome" type="text" placeholder="<?php ; print $_GET['nome'];?>" required /><br>
            <label>Altere a nota:</label>
            <input name="nota" type="text" placeholder="<?php  print $_GET['nota']; ?>" required /><br>
            <input type="submit" name="enviar" value="Alterar" class= "btn btn-primary" />
        </form>

            <?php
            
            ini_set("display_errors", true);
            error_reporting(E_ALL);
            
            require_once '../../src/ALEX/ServiceDB/ConexaoDB.php';
            require_once '../../src/ALEX/entitys/Aluno.php';
            require_once '../../src/ALEX/ServiceDB/AlunosMapper.php';
            use ALEX\ServiceDB\ConexaoDB;
            use ALEX\entitys\Aluno;
            use ALEX\serviceDB\AlunosMapper;
 
                if (isset($_POST['enviar']))
                {
                    $id = $_POST['id'];
                    $nome =  $_POST['nome'];
                    $nota = $_POST['nota'];
                    
                    $novoAluno = new Aluno();
                    $novoAluno->setId($id)
                              ->setNome($nome)
                              ->setNota($nota);
                     
                    $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "");
                    $pdo = $obj_pdo->getConnection();
                    $update = new AlunosMapper($novoAluno, $pdo);
                    
                    $resultado = $update->alterarAluno();
                    
                    if ($update == true)
                    {
                        echo 'Alterado com sucesso. <a href="index_alunos.php">Voltar</a>';
                        
                    }else 
                    {
                        echo 'Não foi possível fazer a alteração. <a href="index_alunos.php">Voltar</a>';
                    }
                    
                }
            ?>
        
    </body>
</html>