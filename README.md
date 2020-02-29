# Companies List

## Instalação
Para instalar essa aplicação e executar em seu computador voce deve:

- Clonar o projeto `git clone https://github.com/hugopaulista7/companies-crud` 
- Instalar o Laravel `composer global require laravel/installer`
- Instalar as dependências do projeto `composer install`
- Copiar o arquivo `.env.example` para o arquivo `.env`
- Adicionar a database no arquivo `.env` com o nome da database, usuário de acesso ao banco e senha
- Executar comando `php artisan key:generate`
- Executar comando `php artisan migrate --seed`
- Executar comando `php artisan vendor:publish --tag="cors"`
- Executar comando `php artisan adminlte:install` e`php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\AdminLteServiceProvider" --tag=views`
- Executar servidor local com o comando `php artisan serve`
- O servidor estará rodando na url `http://localhost:8000/dashboard`
- Usuário e senha de testes `tester@admin.com 123456789`
- Qualquer dúvida entrar em contato via e-mail `hugoarpaulista@hotmail.com`
