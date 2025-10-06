<?php

require_once 'User.php';

class Professor extends Usuario
{
    private $materia;
    private $masp;
    public function __construct($id, $email, $senha, $nome, $idade, $endereco, $permissoes = [], $materia, $masp)
    {
        parent::__construct($id, $email, $senha, $nome, $idade, $endereco, $permissoes);
        $this->materia = $materia;
        $this->masp = $masp;
        $this->adicionarPermissao("editar nota");
    }

    // Getter e Setter para 'materia'
    public function getMateria()
    {
        return $this->materia;
    }

    public function setMateria($materia)
    {
        $this->materia = $materia;
    }


    public function getMasp()
    {
        return $this->masp;
    }
    public function setMasp($masp)
    {
        $this->masp = $masp;
    }
}
