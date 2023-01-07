<?php

namespace App\Controllers;


use Slim\Http\Request;
use App\Controllers\Controller;
use App\Models\Usuarios;
use App\src\Database\ConnectDB;

class Home extends Controller
{
    public function index()
    {
        $this->app->render('BemVindo');
    }

    public function listar()
    {
        $usuarios = new Usuarios();
        $listaUsuarios = $usuarios->getAll();
        $dados = ['usuarios' => $listaUsuarios];
        $this->app->render('cadastrar', $dados);

    }

    public function cadastrar() {
        ConnectDB::Transaction();
        $dados = json_decode($this->app->request->getBody(), true);
        $usuarios = new Usuarios();
        $usuarios->store($dados);
        ConnectDB::commit();

        $this->listar($this->app);
    }
}