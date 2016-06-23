<?php

class AlunosMapper{
    
    public function selecionarTodos($pdo)
    {
        
            $query = "select * from alunos";

            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_CLASS);
            
           if ($stmt->rowCount($resultado) > 0)
            {
               
               echo '<h2>Todas as notas: </h2>';
               
                foreach ($resultado as $resultados)
                {
                   print "<b>Nome:</b> " . $resultados->nome . " " . "<b>Nota:</b> " . $resultados->nota . "<br>";
                }                        
                    
            }
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
   