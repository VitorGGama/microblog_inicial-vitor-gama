<?php
namespace Microblog;
abstract class Utilitarios {

    /*Sobre o parametro $dados com tipo array/bool
    Quando um parametro pode receber tipos de dados
    diferentes de acordo com a chamada do metodo, 
    usamos o operador | (ou) entre as opções de tipos. 
    Essa sintax é válida a partir do php 7.4 */
    public static function dump(array | bool | object $dados):void {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }

    //2023-10-27  10:56
    public static function formatarData(string $data):string {
        return date("d/m/Y H:i", strtotime($data));        
    }
    // 27/10/2023  10:56
}