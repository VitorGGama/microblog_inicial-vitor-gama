<?php

namespace Microblog;

use PDO, Exception;

class Categoria
{
    private int $id;
    private string $nome;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Banco::conecta();
    }

    public function inserir(): void 
    {
        $sql = "INSERT INTO categorias(nome)
        VALUES(:nome)";

        try {
            $consulta =
            $this->conexao->prepare($sql);
            $consulta->bindValue(":nome",
            $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir categoria" . $erro->getMessage());
        }
    }



    public function getNome(): string
    {
        return $this->nome;
    }
    
    public function setNome(string $nome): self
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }
}

//UPDATE de categorias
public function atualizar
