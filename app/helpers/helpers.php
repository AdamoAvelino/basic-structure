<?php
use Slim\Http\Request;
use App\src\Services\Sessao;

function env($name)
{
    $env = new \App\src\Services\ConfigEnv;
    $var = $env->getEnv($name);
    
    if(in_array(strtolower($var), ['false', 'true'])) {
        return strtolower($var) === 'true' ? true : false;
    }

    return $var;
}

function dd($debug)
{
    var_dump($debug);
    die();
}

function metadataTabela(Slim\Http\Request $request)
{
    $ordernar_coluna = $request->get('order')[0]['column'];
    return (Object) [
        'direcao_ordenacao' => $request->get('order')[0]['dir'],
        'coluna_ordenacao' => $request->get('columns')[$ordernar_coluna]['data'],
        'limit' => $request->get('length'),
        'offset' => $request->get('start'),
        'numero_requisicao' => $request->get('draw') + 1,
        'busca' => $request->get('search')['value']
    ];

}

function setFlash($chave, $descricao)
{
    $sessao = new Sessao;
    $sessao->set('flash', [$chave => $descricao]);
}

function getFlash($chave = null)
{
    $sessao = new Sessao;
    $flash = $sessao->get('flash');

    if ($chave and isset($flash[$chave])) {
        $sessao->remove('flash');
        return $flash[$chave];
    }

    if (!$flash) {
        return null;
    }
}

function removeFlash()
{
    $sessao = new Sessao;
    $sessao->remove('flash');

}