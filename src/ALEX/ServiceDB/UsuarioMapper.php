<?php

namespace ALEX\serviceDB;

class UsuarioMapper
{
    private $pdo;
    private $usuario;
    
    public function __construct($pdo, $usuario)
    {
        $this->pdo = $pdo;
        $this->usuario = $usuario;
    }
    
    public function inserirUsuario()
    {
        $query = "insert usuarios (usuario, senha) values (:usuario, :senha)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":usuario", $this->usuario->getUsuario());
        $stmt->bindValue(":senha", $this->usuario->getSenha());
        return $stmt->execute() ? true : false ;
    }
    
    public function selecionarTodos()
    {
        
        $query = "SELECT * FROM usuarios";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_CLASS);
        
        if ($stmt->rowCount($resultado) > 0)
           {
               return $resultado;  
           }
           
           else
           {
               return "Sem alunos para listar.";
           }
        
    }
    

    public function alterarUsuario()
    {
        $query = "UPDATE usuarios SET usuario = :usuario, senha = :senha WHERE id = :id ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":usuario", $this->usuario->getUsuario());
        $stmt->bindValue(":senha", $this->usuario->getSenha());
        $stmt->bindValue(":id", $this->usuario->getId());
        return $stmt->execute() ? true : false;
    }
    
    public function deletarUsuario()
    {
        $query = "DELETE FROM usuarios where id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id", $this->usuario->getId());
        return $stmt->execute() ? true : false;
    }
    
    public function buscaUsuario() 
    {
        $query = "select * from usuarios where usuario = :usuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":usuario", $this->usuario->getUsuario());
        $stmt->execute(); 
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($stmt->rowCount($resultado) > 0)
        {
            return $resultado;
        }else{
            return "Usuario Inexistente <a href=''../../../app/index.php''>Voltar</a>";
        }
            
    }
    
    public function deslogar()
    {
      
    }
                
}

