<?php

class Turma
{
    private $id;
    private $alunos = [];
    private $curso;

    // Construtor
    public function __construct($id, $alunos, $curso)
    {
        $this->id = $id;
        $this->curso = $curso;
        $this->alunos = $alunos;
    }
    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getAlunos()
    {
        return $this->alunos;
    }
    public function getCurso()
    {
        return $this->curso;
    }
    public function addAlunos($alunos)
    {
        if (is_array($alunos)) {
            $this->alunos = array_merge($this->alunos, $alunos);
        } else {
            $this->alunos[] = $alunos;
        }
    }
    public function removeAlunos($alunos)
    {
        if (is_array($alunos)) {
            $this->alunos = array_diff($this->alunos, $alunos);
        } else {
            $key = array_search($alunos, $this->alunos);
            if ($key !== false) {
                unset($this->alunos[$key]);
            }
        }
    }
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }
    public function setAlunos($alunos)
    {
        if (is_array($alunos)) {
            $this->alunos = $alunos;
        } else {
            $this->alunos = [$alunos];
        }
    }
}
