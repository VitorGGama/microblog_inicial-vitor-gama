<?php

namespace Microblog;

final class ControleDeAcesso
{

    public function  __construct()
    {
        /*Se não existir uma sessão "em andamento" */
        if (!isset($_SESSION)) {
            //então inicialize uma sessão
            session_start();
        }
    }
    public function verificaAcesso():void {
        /*Se não existir uma varialvel de sessaão 
        chamada "id" (ou seja, ainda não houve um login por parte do usuário) */
        if( !isset($_SESSION['id']) ){
            /*...então destrua qualquer resquicio
            de sessão, redirecione para o formulário
            de login e pare completamente o script. */ 
            session_destroy();
            header("location:../login.php?acesso_proibido");
            die(); //ou exit;
        }
    }

    public function verificaAcessoAdmin():void {
        /*SE o tipo de usuário logado na sessão NÃO FOR admin */
        if( $_SESSION["tipo"] !== "admin") {
            header("location:nao-autorizado.php");
            die();
        }
    }

    public function login(int $id, string $nome, string $tipo):void {
        /*No momento em que ocorre login, criamos variaveis
        de sessão contendo os dados que queremos monitorar/controlar/usar 
        através da sessão enquanto a pessoa estiver logada. */
        $_SESSION["id"] = $id;
        $_SESSION["nome"] = $nome;
        $_SESSION["tipo"] = $tipo;       

    }

    public function logout():void {
        session_start();
        session_destroy();
        header("location:../login.php?logout");
        die();
    }
}
