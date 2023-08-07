<?php

namespace App\Models;

use App\src\Database\ConnectDB;


class Usuarios extends Qu
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::open();
    }

    /**
     * -----------------------------------------------------------------------------------------------------
     */
    public function select()
    {
        $this->sql = "SELECT u.* FROM usuarios";
        return $this;
    }

    /**
     * -----------------------------------------------------------------------------------------------------
     */

     public function get()
     {
         $this->constructSql();
 
         $apolices = ConnectDB::query($this->sql, $this->valores);
 
         if (count($apolices) == 0) {
             return null;
         }
 
         return $apolices;
     }

     /**
     * -----------------------------------------------------------------------------------------------------
     */
    public function first()
    {
        $apolices = $this->get();
        if (!$apolices) {
            return null;
        }
        return current($apolices);
    }

    /**
     * -----------------------------------------------------------------------------------------------------
     */
    public function last()
    {
        $apolices = $this->get();
        if (!$apolices) {
            return null;
        }

        return end($apolices);
    }

     /**
     * ------------------------------------------------------------------------------------------------------------
     *
     * @param Array $dados
     * @return Int
     */
    public function cadastrar(array $dados): int
    {
        $dadosFiltrados = $this->apenasAtributosPreenchidos($dados);
        $sql = "INSERT INTO apolices ({$this->insert($dadosFiltrados)}) VALUES ({$this->gerarBinds($dadosFiltrados)})";
        $retorno = ConnectDB::execute($sql, array_values($dadosFiltrados));

        return $retorno->lastInsertId();
    }

    /**
     * -----------------------------------------------------------------------------------------------------
     */
    public function atualizar(int $id, array $dados)
    {
        $dados = $this->apenasAtributosPreenchidos($dados);
        $sql = "UPDATE apolices set  {$this->update($dados)} WHERE id=?";
        $dados['id'] = $id;
        ConnectDB::execute($sql, array_values($dados));
    }

}