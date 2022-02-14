<?php

namespace App\Models;

use App\src\Database\ConnectDB;


class Usuarios
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::open();
    }


    public function getAll()
    {
        $query = "SELECT * FROM usuarios";
        return $this->conn->query($query, \PDO::FETCH_ASSOC)->fetchAll();
    }

    public function store(Array $dados)
    {
        $colunas = sprintf("(%s)", implode(", ", array_keys($dados)));
        
        $values = sprintf("VALUES ('%s')", implode("', '", array_values($dados)));
        
        
        $query = "INSERT INTO usuarios $colunas $values";
        $this->conn->query($query);
    }

}