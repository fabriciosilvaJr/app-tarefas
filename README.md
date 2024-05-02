

## Requisitos

Certifique-se de que você possui as seguintes dependências instaladas:

- [Composer](https://getcomposer.org/)
- [PHP 8.1](https://www.php.net/)
- [MySQL 8](https://www.mysql.com/)

## Instalação

1. Clone o repositório do GitHub:

   ```bash
   git clone https://github.com/fabriciosilvaJr/app-tarefas.git
   
2. Navegue até o diretório do projeto:
    `cd app-tarefas`

3. Renomeie o arquivo .env.example para .env:
   `mv .env.example .env`

4. Instale as dependências do Composer:
   `composer install`

5. Crie um usuário no banco de dados Mysql com o nome  e senha de sua preferência para ser utilizando no arquivo .env


6. Execute as migrações para criar as tabelas do banco de dados:
    `php artisan migrate`
   
`
    
## Executando o Aplicativo

Agora que o aplicativo está configurado, você pode executá-lo com o seguinte comando:
`php artisan serve`

## Utilizando a API

A API estará disponível em [http://localhost:8000/api](http://localhost:8000/api).

### Criando um usuário para testes

Para criar um usuário diretamente na API para testes, você pode usar o Postman ou Insomnia.

- **URL:** `http://localhost:8000/api/register
- **Método:** `POST`
- **Corpo da Requisição:**

json
{
  "name": "user",
  "email": "usertest@email.com",
  "password": "12345678"
}



### Para fazer login, utilize a seguinte URL:

- **URL:** `http://localhost:8000/api/login
- **Método:** `POST`
- **Corpo da Requisição:**
json
{
  "email": "usertest@email.com",
  "password": "12345678"
}

O endpoint de login retorna o nome do usuário, o ID e o token.

### Para criar uma tarefa, utilize a seguinte URL:
- **URL:** `http://localhost:8000/api/task
- **Método:** `POST`
- **Corpo da Requisição:**






