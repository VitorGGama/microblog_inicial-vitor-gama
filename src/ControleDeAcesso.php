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
            header("location:../login.php");
            die(); //ou exit;
        }
    }
}
