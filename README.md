# Estrutura basica para desenvolvimento PHP

Trata-se de uma estrutura simples para desenvovilmento aplicações utilizando MVC com SLIM, TWIG.

Para facilitar e padronizar as estilizações do frontend é utilizado webpack para configuração de transpiladores __SASS__ para __css__ e Babel para para __javascript__ e __bootstrap para HTML__

## Instalção 
```
composer create-project quaestum/quaestum

npm install
```

## Configuração

Incluir configurações para conexões com serviços como Base de Dados e/ou SMTP para envio de e-mails é simples.
Utilize o arquivo __.env__.
>O arquivo já vem com as variáveis de conexão com banco de dados já definidas, basta incluir os valores. Utilize o __.env.exemplo.__ 

## Rotas
No diretório de rota, é possivel colocar quantos arquivos necessário, assim como pastas para separar versões de apis.

>Exemplo: Dentro da pasta __routes__, incluir api/v1. Dentro desta pasta pode ser criado quantos arquivos de rota necessário, além de pastas para melhor organizar o projeto. 


arquivo usuario.php
```PHP
<?php
use App\Controllers\Home;

$app->group('/api', function() {
    
    $app->group('/v1', function() {

        $app->group('/usuario', function() {
            $app->get('/', $authi,  function() {
                $home = new Home();
                $home->index();
            });

        });

    });

})

```

Dentro da pasta app crie os controllers e brinque o quanto necessário.

Para criar um controller é bem simples:
Crie um arquivo de controller dentro da pasta App/Controllers.
Exepmlo da criação do de Home.php:
 ```
 namespace App\Controllers;

/** 
 * Utilize a classe Controller principal para extender a classe Home
 * Essa seper classe oferece o atributo app que carrega a instancia do Slim.
 * Assim conseguirá recuperar **requests**, utilizar **responses** ou o render do Twig que é instanciado no bootstrap da aplicação
 */
use App\Controllers\Controller;

class Home extends Controller
{
    public function index()
    {
        $this->app->render('BemVindo');
    }
}
 ```
