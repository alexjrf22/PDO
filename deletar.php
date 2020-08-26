<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link href="app/css/bootstrap.min.css" rel="stylesheet" media="screen">
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
            
            require_once 'ConexaoDB.php';
            require_once 'Aluno.php';
            require_once 'AlunosMapper.php';
            
            
                if (isset($_POST['enviar']))
                {
                    $id = $_POST['id'];
                    $option = $_POST['option'];
           
                    $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "root");
                    $pdo = $obj_pdo->getConnection();
                    $deletar = new AlunosMapper();
                    
                    if ($option === 'sim')
                    {
                        
                        $resultado = $deletar->deletarAluno($id, $pdo);
                        
                        if ($resultado == true)
                        {
                            
                            echo 'Deletado com sucesso. <a href="index.php">Voltar</a>';
                        
                        }else 
                        {
                         echo 'Não foi possível deletar o aluno. <a href="index.php">Voltar</a>';
                        }
                        
                    }else
                    {
                        print 'Tudo bem o aluno não será removido. <a href="index.php">Voltar</a>';
                    }    
                    
                    
                    
                }
            ?>
        
    </body>
</html>

