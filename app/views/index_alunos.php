<?php session_start(); echo "<h3>Bem vindo " . $_SESSION['usuario'] . "</h3>"?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        
        <h3> Pesquisar por Aluno</h3>
        
        <form method="post" action="">
            <input name="nome" type="text" placeholder="Insira O Nome do Aluno" required />
            <input type="submit" name="pesquisar" value="pesquisar" class= "btn btn-primary" />
        </form>
        
        <h3> Insira um novo Aluno</h3>
        
        <form method="post" action="">
            <input name="nome" type="text" placeholder="Insira nome do aluno" required />
            <input name="nota" type="text" placeholder="Insira a nota do aluno" required /><br>
            <input type="submit" name="enviar" value="Enviar" class= "btn btn-primary" />
        </form>
        
        <?php
            
             ini_set ( 'display_errors' , 1 ); 
             ini_set ( 'display_startup_errors' , 1 ); 
             error_reporting(E_ALL);
            
           
            require_once '../../src/ALEX/entitys/Aluno.php';
            require_once '../../src/ALEX/ServiceDB/AlunosMapper.php';
            require_once '../../src/ALEX/ServiceDB/ConexaoDB.php';
            use ALEX\entitys\Aluno;
            use ALEX\ServiceDB\AlunosMapper;
            use ALEX\ServiceDB\ConexaoDB;
            
            if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["usuario"]))
            {
                header("Location:./tela_login.php");
                exit;
            }
            $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "");
            $pdo = $obj_pdo->getConnection();
            $aluno = new Aluno();
            $objAlunos = new AlunosMapper($aluno, $pdo); 
  
            if(isset($_POST['enviar']))
            {
                    $nome =  $_POST['nome'];
                    $nota = $_POST['nota'];
                    
                    $novoAluno = new Aluno();
                    $novoAluno->setNome($nome)
                              ->setNota($nota);
                   
                    $aluno = new AlunosMapper($novoAluno, $pdo);
                    $aluno->inserirAluno();         
            }
            
            if(isset($_POST['pesquisar']))
            {
                $nome =  $_POST['nome'];
                $novoAluno = new Aluno();
                $novoAluno->setNome($nome);
                $aluno = new AlunosMapper($novoAluno, $pdo);
                $busca = $aluno->buscaAluno();
                print_r($busca); 
            }
      
            
            $super_alunos = $objAlunos->maioresNotas();
            
            print_r($super_alunos);
            $alunos = $objAlunos->selecionarTodos();
             
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
                    <td><a title="alterar" href="alterar_aluno.php?id=<?php print $aluno->id; ?>&amp;nome=<?php print $aluno->nome; ?>&amp;nota=<?php print $aluno->nota; ?>"><i class="icon-edit" title="Alterar"></i></a></td>
                    <td><a title="Deletar" href="deletar_aluno.php?id=<?php print $aluno->id; ?>&amp;nome=<?php print $aluno->nome; ?>&amp;nota=<?php print $aluno->nota; ?>"><i class="icon-trash" title="Deletar"></i></a></td>   
                </tr>
                
                <?php endforeach; ?>
                
            </table>
  
         <form method="post" action="">
            <input type="submit" name="deslogar" value="Deslogar do Sistema" class= "btn btn-primary" />
        </form>
        
        <?php 
        
            if (isset($_POST['deslogar']))
            {
                if(isset($_SESSION["id_usuario"]) || isset($_SESSION["usuario"]))
                {
                    unset($_SESSION["id_usuario"]);
                    unset($_SESSION["usuario"]);
                    session_destroy();
                    header("Location:./tela_login.php");
                    exit;
                }
            }
            
        
        ?>

    </body>
</html>
