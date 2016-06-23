<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            require_once 'ConexaoDB.php';
            require_once 'AlunosMapper.php';
            
            $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "root");
            
            $pdo = $obj_pdo->getConnection();
            
            $objAlunos = new AlunosMapper();
            
            $alunos = $objAlunos->selecionarTodos($pdo);
            
            $maioresnotas = $objAlunos->maioresNotas($pdo);
            
          
            
        ?>
    </body>
</html>
