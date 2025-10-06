<?php

require_once 'User.php';
require_once 'Curso.php';
require_once 'Aluno.php';
class Matricula extends Usuario
{
    private $curso;
    private $aluno;

    public function __construct($curso, $aluno)
    {
        parent::__construct($curso, $aluno);
        $this->curso = $curso;
        $this->aluno = $aluno;

        $this->adicionarPermissao("editar nota");
    }

    public function getCurso()
    {
        return $this->curso;
    }
    public function getAluno()
    {
        return $this->aluno;
    }
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }
    public function setAluno($aluno)
    {
        $this->aluno = $aluno;
    }
}
