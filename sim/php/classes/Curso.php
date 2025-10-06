<?php



class Curso
{
    private $id;
    private $nome;
    private $materias = [];
    private $duracao;

    // Construtor
    public function __construct($id, $nome, $materias = [], $duracao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->materias = $materias;
        $this->duracao = $duracao;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function getMaterias()
    {
        return $this->materias;
    }
    public function getDuracao()
    {
        return $this->duracao;
    }
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
        
    }



    // Setters
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setMaterias($materias)
    {
        if (is_array($materias)) {
            $this->materias = $materias;
        } else {
            $this->materias = [$materias];
        }
    }
    public function addMaterias($materia)
    {
        if (is_array($materia)) {
            $this->materias = array_merge($this->materias, $materia);
        } else {
            $this->materias[] = $materia;
        }
    }
}
