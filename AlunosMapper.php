<?php

require_once 'Aluno.php';

class AlunosMapper{
    
    public function selecionarTodos($pdo)
    {
        
            $query = "select * from alunos";

            $stmt = $pdo->prepare($query);
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
    
    public function inserirAluno(Aluno $aluno, \PDO $pdo)
    {
        $query = "insert alunos (nome, nota) values (:nome, :nota)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":nome", $aluno->getNome());
        $stmt->bindValue(":nota", $aluno->getNota());
        return $stmt->execute() ? false : true ;
    }
    
    public function alterarAluno(Aluno $aluno, \PDO $pdo) 
    {
        $query = "update alunos set nome= :nome, nota= :nota where id= :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":nome", $aluno->getNome());
        $stmt->bindValue(":nota", $aluno->getNota());
        $stmt->bindValue(":id", $aluno->getId());
        return $stmt->execute() ? true : false;
       
    }
    
    public function deletarAluno($id, \PDO $pdo) 
    {
        $query = "delete from alunos where id= :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        return $stmt->execute() ? true : false;      
    }
    
    public function maioresNotas($pdo)
    {
        $query = "select * from alunos order by nota desc limit 3";

            $stmt = $pdo->prepare($query);
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
    
}
   