<?php

namespace App\src\Services;

class Sessao
{
    const MENSAGEM = [
        'Não Autorizado',
        'Login Expirado'
    ];
    
    const NAO_AUTORIZADO = 0;
    const EXPIRADO = 1;
    const AUTORIZADO = 2;



    /**
     * -------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        if ( session_status() !== PHP_SESSION_ACTIVE ) {
            \session_start();
        }
    }

    /**
     * -----------------------------------------------------------------------------------------
     */
    public function set(String $atributo, $valor) : void
    {
        $_SESSION[$atributo] = $valor;
    }

    public function init()
    {
        $_SESSION['expira'] = time() + (int) env('SESSION_EXPIRED');
    }


    /**
     * ----------------------------------------------------------------------------------------
     */
    public function get(String $nome)
    {
        return isset($_SESSION[$nome]) ? $_SESSION[$nome] : null;
    }

    /**
     * ----------------------------------------------------------------------------------------
     */
    public function remove($nome)
    {
        unset($_SESSION[$nome]);
    }


    /**
     * -------------------------------------------------------------------------------------------
     */
    public function autorizado() : Bool
    {
        if($this->verificar() == self::AUTORIZADO) {
            $_SESSION['expira'] = time() + (int) env('SESSION_EXPIRED');
            return true;
        }

        $this->destroy();
        return false;

    }

    /**
     * ---------------------------------------------------------------------------------------------
     */
    public function destroy() : void
    {
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['expira']);
        session_destroy();
    }

    /**
     * ------------------------------------------------------------------------------------------------
     */
    private function verificar() : Int
    {
        if(!isset($_SESSION['usuario_nome'])) {
            return self::NAO_AUTORIZADO;
        }

        if(isset($_SESSION['expira']) && $_SESSION['expira'] < time()) {
            return self::EXPIRADO;
        }

        return self::AUTORIZADO;
    }


    
}