<?php

class Aluno
{
    private $id;
    private $nome;
    private $nota;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getNota() {
        return $this->nota;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setNota($nota) {
        $this->nota = $nota;
        return $this;
    }
}

