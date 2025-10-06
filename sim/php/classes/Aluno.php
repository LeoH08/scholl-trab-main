<?php

require_once 'User.php';
require_once 'Curso.php';

class Aluno extends Usuario
{
    private $nota;
    private $curso = new Curso(0, "Curso Padrão", [], 0);
    private $duracao;

    public function __construct($id, $email, $senha, $nome, $idade, $endereco, $permissoes = [], $nota, $curso, $duracao, $matricula)

    // Chama o construtor da classe pai (Usuario)
    {
        parent::__construct($id, $email, $senha, $nome, $idade, $endereco, $permissoes, $nota, $curso, $duracao, $matricula);
        $this->nota = $nota;
        $this->curso = $curso;
        $this->adicionarPermissao("editar nota");
    }

    // Getter e Setter para 'nota'      
    public function getNota()
    {
        return $this->nota;
    }


    public function getCurso()
    {
        return $this->curso;
    }
    public function getDuracao()
    {
        return $this->duracao;
    }

    public function setDurca($duracao)
    {
        $this->duracao = $duracao;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }
}
