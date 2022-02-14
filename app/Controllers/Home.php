<?php

namespace App\Controllers;


use Slim\Http\Request;
use App\Models\Usuarios;
use App\src\Database\ConnectDB;

class Home 
{
    public function index($app)
    {
        $app->render('BemVindo');
    }

    public function listar($app)
    {
        $usuarios = new Usuarios();
        $listaUsuarios = $usuarios->getAll();
        $dados = ['usuarios' => $listaUsuarios];
        $app->render('cadastrar', $dados);

    }

    public function cadastrar($app) {
        ConnectDB::Transaction();
        $dados = json_decode($app->request->getBody(), true);
        $usuarios = new Usuarios();
        $usuarios->store($dados);
        ConnectDB::commit();

        $this->listar($app);
    }
}