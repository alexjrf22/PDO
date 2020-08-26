<?php

namespace ALEX\serviceDB;
use ALEX\entitys\Aluno;
use PDO;
 
class AlunosMapper{
    
    private $pdo;
    private $aluno;
    
    public function __construct(Aluno $aluno, \PDO $pdo)
    {
        $this->aluno = $aluno;
        $this->pdo = $pdo;
    }
    public function selecionarTodos()
    {
        
            $query = "select * from alunos";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_CLASS);
            
           if ($stmt->rowCount($resultado) > 0)
           {
               return $resultado;  
           }
           
           else
           {
               return "Sem alunos para listar.";
           }
    }
    
    public function inserirAluno()
    {
        $query = "insert alunos (nome, nota) values (:nome, :nota)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":nome", $this->aluno->getNome());
        $stmt->bindValue(":nota", $this->aluno->getNota());
        return $stmt->execute() ? false : true ;
    }
    
    public function alterarAluno() 
    {
        $query = "update alunos set nome= :nome, nota= :nota where id= :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":nome", $this->aluno->getNome());
        $stmt->bindValue(":nota", $this->aluno->getNota());
        $stmt->bindValue(":id", $this->aluno->getId());
        return $stmt->execute() ? true : false;
       
    }
    
    public function deletarAluno() 
    {
        $query = "delete from alunos where id= :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $this->aluno->getId());
        return $stmt->execute() ? true : false;      
    }
    
    public function maioresNotas()
    {
        $query = "select * from alunos order by nota desc limit 3";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_CLASS);
            
            if ($stmt->rowCount($resultado) > 0)
            {
               
               echo '<h2>As três maiores notas são: </h2>';
               
                foreach ($resultado as $resultados)
                {
                   print "<b>Nome:</b> " . $resultados->nome . " " . "<b>Nota:</b> " . $resultados->nota . "<br>";
                }                        
                    
            }
    }
    
    public function buscaAluno() 
    {
        $query = "select * from alunos where nome= :nome";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":nome", $this->aluno->getNome());
        $stmt->execute(); 
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
      if ($stmt->rowCount($resultado) > 0)
        {

           echo '<h2>Resultado da pesquisa: </h2>';

            print "<p style= 'font-size: 18px'><b>Nome:</b> " . $resultado['nome'] . " " . "<b>Nota:</b> " . $resultado['nota'] . "<br></p>";
        }
        
        else
        {
            echo '<h2>Resultado da pesquisa: </h2>';

            print "<p style= 'color: red'><b>Não foi encontrado nenhum resultado.</b></p>";
        }
    }
    
}
   