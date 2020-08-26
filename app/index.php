<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>

        
        <h3> Insira um novo Usuario</h3>
        
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input name="usuario" type="text" placeholder="Insira Usuário" required />
            <input name="senha" type="text" placeholder="Insira a Senha" required /><br>
            <input type="submit" name="enviar" value="Enviar" class= "btn btn-primary" />
        </form>
        
        <a href="views/tela_login.php">Logar no Sistema</a>
        
        <?php
            
             ini_set ( 'display_errors' , 1 ); 
             ini_set ( 'display_startup_errors' , 1 ); 
             error_reporting(E_ALL);
             require_once '../vendor/autoload.php';
            require_once '../src/ALEX/ServiceDB/ConexaoDB.php';
            require_once '../src/ALEX/entitys/Usuario.php';
            require_once '../src/ALEX/ServiceDB/UsuarioMapper.php';
            use ALEX\ServiceDB\ConexaoDB;
            use ALEX\entitys\Usuario;
            use ALEX\serviceDB\UsuarioMapper;
        
            
            $obj_pdo = new ConexaoDB("mysql:host=127.0.0.1;charset=utf8", "pdo", "root", "");
            $pdo = $obj_pdo->getConnection();
            $usuario = new Usuario();
            $objUsuario = new UsuarioMapper($pdo, $usuario);  
            
            if(isset($_POST['enviar']))
            {
                    $usuario = $_POST['usuario'];
                    $senha   = $_POST['senha'];
                    
                    $novoUsuario = new Usuario();
                    $novoUsuario->setUsuario($usuario)
                                 ->setSenha($senha);
                   
                    $usuarioMapper = new UsuarioMapper($pdo, $novoUsuario);
                    $resultado = $usuarioMapper->inserirUsuario();
                    
            }
          
            echo '<h3>Lista de Usuários: </h3>';
        
            ?>
        
            <table border="1"> 
                <tr>
                    <th>Nome</th>
                    <th>Senha</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
            <?php
                
                
                $usuarios = $objUsuario->selecionarTodos();
                foreach ($usuarios as $usuario):
                                      
            ?>
                
            
                <tr>
                    <td><?php print $usuario->usuario; ?></td>
                    <td><?php print $usuario->senha; ?></td>
                    <td><a title="alterar" href="views/alterar_usuario.php?id=<?php print $usuario->id; ?>&amp;usuario=<?php print $usuario->usuario; ?>&amp;senha=<?php print $usuario->senha; ?>"><i class="icon-edit" title="Alterar"></i></a></td>
                    <td><a title="Deletar" href="views/deletar_usuario.php?id=<?php print $usuario->id; ?>&amp;usuario=<?php print $usuario->usuario; ?>&amp;senha=<?php print $usuario->senha; ?>"><i class="icon-trash" title="Deletar"></i></a></td> 
                    
                </tr>
                
                <?php endforeach; ?>
                
            </table>
            
           


    </body>
</html>


