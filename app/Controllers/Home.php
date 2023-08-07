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
        $usuarios = $usuarios->select()->where('u.id', 1, '>')->get();
        $dados = ['usuarios' => $usuarios];
        $this->app->render('cadastrar', $dados);

    }

    public function cadastrar() {
        ConnectDB::Transaction();
        $dados = json_decode($this->app->request->getBody(), true);
        $usuarios = new Usuarios();
        $usuarios->cadastrar($dados);
        ConnectDB::commit();

        $this->listar($this->app);
    }
}