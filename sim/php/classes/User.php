<?php

class Usuario
{
    private $email;
    private $senha;
    private $id;
    private $nome;
    private $idade;
    private $endereco;
    private $permissoes = [];

    // Construtor
    public function __construct($id, $email, $senha, $nome, $idade, $endereco, $permissoes = [])
    {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->endereco = $endereco;
        $this->email = $email;
        $this->id = $id;
        $this->senha = $senha;
        $this->permissoes = $permissoes;
    }

    // Getters e Setters
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getIdade()
    {
        return $this->idade;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
    }
    public function setEmail($email)
    {
        $this->idade = $email;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getPermissoes()
    {
        return $this->permissoes;
    }

    public function setPermissoes($permissoes)
    {
        $this->permissoes = $permissoes;
    }

    public function adicionarPermissao($permissao)
    {
        if (!in_array($permissao, $this->permissoes)) {
            $this->permissoes[] = $permissao;
        }
    }


    public function removerPermissao($permissao)
    {
        $index = array_search($permissao, $this->permissoes);
        if ($index !== false) {
            unset($this->permissoes[$index]);
            $this->permissoes = array_values($this->permissoes); // Reindexa o array
        }
    }
}
