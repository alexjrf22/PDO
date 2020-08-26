 <!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>  
        <h2>Deseja realmente deletar esse registro?</h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <label><b>Nome:</b> <?php print $_GET['nome']; ?></label>
            <label><b>Nota:</b> <?php  print $_GET['nota']; ?></label>
            <input name="option" type="radio" value="sim" />Sim
            <input name="option" type="radio" value="nao" />Não<br><br>
            <input type="submit" name="enviar" value="Deletar" class= "btn btn-primary" />
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
                $option = $_POST['option'];

                $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "");
                $pdo = $obj_pdo->getConnection();
                $obj_aluno = new Aluno();
                $aluno = $obj_aluno->setId($id);
                $deletar = new AlunosMapper($aluno, $pdo);

                if ($option === 'sim')
                {

                    $resultado = $deletar->deletarAluno();

                    if ($resultado == true)
                    {

                        echo 'Deletado com sucesso. <a href="index_alunos.php">Voltar</a>';

                    }else 
                    {
                     echo 'Não foi possível deletar o aluno. <a href="index_alunos.php">Voltar</a>';
                    }

                }else
                {
                    print 'Tudo bem o aluno não será removido. <a href="index_alunos.php">Voltar</a>';
                }    



            }
        ?>
        
    </body>
</html>
