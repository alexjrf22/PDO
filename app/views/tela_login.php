<?php session_start(); ?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    
    <body>
    
       
    <h3>Efetuar Login no sistema</h3>
    <form method="post" action="<?php $_SERVER['PHP_SELF'];?>" >
            <input name="usuario" type="text" placeholder="Usuário" required /><br>
            <input name="senha" type="text" placeholder="Senha" required /><br>
            <input type="submit" name="enviar" value="Enviar" class= "btn btn-primary" />
        </form>
    
    <?php
        
        require_once '../../src/ALEX/ServiceDB/ConexaoDB.php';
        require_once '../../src/ALEX/ServiceDB/UsuarioMapper.php';
        require_once '../../src/ALEX/entitys/Usuario.php';
        use ALEX\ServiceDB\ConexaoDB;
        use ALEX\serviceDB\UsuarioMapper;
        use ALEX\entitys\Usuario;
        
        if (isset($_POST['enviar']))
        {
            $login = isset($_POST['usuario']) ? addslashes(trim($_POST['usuario'])) : false;
            $senha = isset($_POST['senha']) ? addslashes(trim($_POST['senha'])) : false;
            
            if (!$login || !$senha)
            {
                echo "Vc deve digitar seu usuario e senha.";
                exit();
            }
            
            
            $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "");
            $pdo = $obj_pdo->getConnection();
            $obj_usuario = new Usuario();
            
            $usuario = $obj_usuario->setUsuario($login);
            $mapper = new UsuarioMapper($pdo, $usuario);
            
            $dados = $mapper->buscaUsuario();
            
            if (!strcmp($senha, $dados['senha']))
            {
                $_SESSION["id_usuario"]= $dados["id"];
		$_SESSION["usuario"] = stripslashes($dados["usuario"]);
                header("location:./index_alunos.php");
            }
            else
            {
                echo "Senha está incorreta";
                exit();
            }
            
        }
        
        
    ?>
    
    <body>
</html>