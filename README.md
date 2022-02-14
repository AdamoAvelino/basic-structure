## Estrutura basica para desenvolvimento PHP

Trata-se de uma estrutura simples para desenvovlmento MVC para aplicações simples, utilizando SLIM, TWIG.
Para facilitar e padronizar as estilizações do frontend é utilizado webpack para configuração de transpiladores SASS para css e Babel para para javascript e bootstrap para HTML

### Instalção 
composer

### Configuração

Incluir configurações para conexões com serviços como Base de Dados e/ou SMTP para envio de e-mails é simples.
Utilize o arquivo __.env__.

### Rotas
No diretório de rota, é possivel colocar quantos arquivos necessário, assim como pastas para separar versões de apis.
Exemplo: Dentro da pasta __routes__, incluir api/v1.
