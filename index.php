<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link href="app/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        
        <h3> Inserir Aluno</h3>
        <form method="post" action="">
            <input name="nome" type="text" placeholder="Insira nome do aluno" required />
            <input name="nota" type="text" placeholder="Insira a nota do aluno" required /><br>
            <input type="submit" name="enviar" value="Enviar" class= "btn btn-primary" />
        </form>
        
        <?php
            
            ini_set("display_errors", true);
            error_reporting(E_ALL);
            
            require_once 'ConexaoDB.php';
            require_once 'Aluno.php';
            require_once 'AlunosMapper.php';
            
            $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "root");
            
            $pdo = $obj_pdo->getConnection();
            
            $objAlunos = new AlunosMapper();
            
            if(isset($_POST['enviar']))
            {
                    $nome =  $_POST['nome'];
                    $nota = $_POST['nota'];
                    
                    $novoAluno = new Aluno();
                    $novoAluno->setNome($nome)
                              ->setNota($nota);
                    $objAlunos->inserirAluno($novoAluno, $pdo);
                    
            }
            
            $alunos = $objAlunos->selecionarTodos($pdo);
             
            echo '<h3>Lista de alunos e notas: </h3>';
        
            ?>
        
            <table border="1"> 
                <tr>
                    <th>Nome</th>
                    <th>Nota</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
            <?php
            
                foreach ($alunos as $aluno):
                              
            ?>
            
                <tr>
                    <td><?php print $aluno->nome; ?></td>
                    <td><?php print $aluno->nota; ?></td>
                    <td><a  title="alterar" href="alterar.php?id=<?php print $aluno->id; ?>&amp;nome=<?php print $aluno->nome; ?>&amp;nota=<?php print $aluno->nota; ?>"><i class="icon-edit" title="Alterar"></i></a></td>
                    <td><a  title="Deletar" href="deletar.php?id=<?php print $aluno->id; ?>&amp;nome=<?php print $aluno->nome; ?>&amp;nota=<?php print $aluno->nota; ?>"><i class="icon-trash" title="Deletar"></i></a></td> 
                    
                </tr>
                
                <?php endforeach; ?>
                
            </table>
 
    </body>
</html>
