<?php
use Microblog\ControleDeAcesso;
use Microblog\Categoria;
require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcessoAdmin();


$sessao->verificaAcesso();

$categoria = new Categoria;
$categoria->setId($_GET['id']);
$categoria->excluir();


header("location:categorias.php");