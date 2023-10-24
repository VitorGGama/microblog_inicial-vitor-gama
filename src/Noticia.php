<?php

namespace Microblog;

use PDO, Exception;

final class Noticia
{
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private string $termo; // será usado na busca
    private PDO $conexao;

    public Usuario $usuario;
    public Categoria $categoria;

    /* Propriedades cujos tipos são ASSOCIADOS ás classes já 
existentes. Isso permitirá usar recurso destas classes á partir
de noticia. */
    public function __construct()
    {
        /* Ao criar um objeto Noticia, aproveitamos para
        instanciar objetos de Usuario e Categoria. */
        $this->usuario = new Usuario;
        $this->categoria = new Categoria;

        $this->conexao = Banco::conecta();
    }

    /* metodo para upload de foto */
    public function upload(array $arquivo):void {
        //defeinindo os tipos válidos
        $tiposValidos = [
            "image/png",
            "image/jpeg",
            "image/gif",
            "image/svg+xml"
        ];

        //Verificando se o arquivo não é um dos tipos válidos
        if( !in_array($arquivo["type"], $tiposValidos) ){
            die(
                "<script>
                 alert('Formato inválido!');
            history.back();
            </script>
            ");
        }

        //Acessando apenas o nome/extensão do arquivo
        $nome = $arquivo["name"];

        //acessando os dados de acesso/armazenamento temporarios
        $temporario = $arquivo["tmp_name"];

        //definindo a pasta de destino das imagens no site
        $pastaFinal = "../imagens/".$nome;

        //movemos/enviamos da area temporaria para a final/destino
        move_uploaded_file($temporario, $pastaFinal);
    }

    /* metodos CRUD */
    public function inserir(): void
    {
        $sql = "INSERT INTO noticias(
            data, titulo, texto, resumo,
            imagem, destaque,
            usuario_id, categoria_id
            ) VALUES(
            :titulo, :texto, :resumo,
            :imagem, :destaque,
            :usuario_id, :categoria_id)";


        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindValue(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindValue(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);
            /*Aqui, primeiro chamamos os getters de ID do usuario e de Categoria 
        para só, depois acessar os valores aos parametros da consulta SQL.
        Isso é possivel devido á associação entre as classes. */

            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":categoria_id", $this->categoria->getId(), PDO::PARAM_INT);
        } catch (Exception $erro) {
            die("Erro ao inserir notícia: " . $erro->getMessage());
        }
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): self
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }


    public function getData(): string
    {
        return $this->data;
    }


    public function setData(string $data): self
    {
        $this->data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getTitulo(): string
    {
        return $this->titulo;
    }


    public function setTitulo(string $titulo): self
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getTexto(): string
    {
        return $this->texto;
    }


    public function setTexto(string $texto): self
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getResumo(): string
    {
        return $this->resumo;
    }


    public function setResumo(string $resumo): self
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getImagem(): string
    {
        return $this->imagem;
    }


    public function setImagem(string $imagem): self
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getDestaque(): string
    {
        return $this->destaque;
    }


    public function setDestaque(string $destaque): self
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getTermo(): string
    {
        return $this->termo;
    }


    public function setTermo(string $termo): self
    {
        $this->termo = filter_var($termo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }
}
