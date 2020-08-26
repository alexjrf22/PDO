<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>  
        <h2>Altere os dados do Usuario:</h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <label>Altere o nome:</label>
            <input name="usuario" type="text" placeholder="<?php print $_GET['usuario'];?>" required /><br>
            <label>Altere a nota:</label>
            <input name="senha" type="text" placeholder="<?php print $_GET['senha']; ?>" required /><br>
            <input type="submit" name="enviar" value="Alterar" class= "btn btn-primary" />
        </form>

            <?php
            
            ini_set("display_errors", true);
            error_reporting(E_ALL);
            
            require_once '../../src/ALEX/ServiceDB/ConexaoDB.php';
            require_once '../../src/ALEX/entitys/Usuario.php';
            require_once '../../src/ALEX/ServiceDB/UsuarioMapper.php';
            use ALEX\ServiceDB\ConexaoDB;
            use ALEX\entitys\Usuario;
            use ALEX\serviceDB\UsuarioMapper;
 
                if (isset($_POST['enviar']))
                {
                    $id = $_POST['id'];
                    $usuario =  $_POST['usuario'];
                    $senha = $_POST['senha'];
                    
                    $novoUsuario = new Usuario();
                    $novoUsuario->setId($id)
                              ->setUsuario($usuario)
                              ->setSenha($senha);
                     
                    $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "");
                    $pdo = $obj_pdo->getConnection();
                    $update = new UsuarioMapper($pdo, $novoUsuario);
                    
                    $resultado = $update->alterarUsuario();
                    
                    if ($update == true)
                    {
                        echo 'Alterado com sucesso. <a href="../index.php">Voltar</a>';
                        
                    }else 
                    {
                        echo 'Não foi possível fazer a alteração. <a href="../index.php">Voltar</a>';
                    }
                    
                }
            ?>
        
    </body>
</html>
