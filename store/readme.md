## Requisitos do Sistema

#### Possuir instalado o [MySQL][1].

#### Possuir instalado PHP versão 7.1.3 (ou posterior).

#### Possuir o [Composer][2] instalado.

#### (OPCIONAL) Possuir o [Postman][3] instalado para testes.
---------------------------------


# Instalação

## Passos para instalação

### Instalação do repositório e do banco de dados.

#### 1. Após a instalação dos requisitos e inicialização do Apache, faça o clone do projeto.

#### 2. Crie um novo banco (create database) e altere os dados do arquivo .env (store/.env) conforme os dados do banco criado (ou utilize as mesmas credenciais do arquivo .env para a criação do banco).
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=store
    DB_USERNAME=root
    DB_PASSWORD=


### Execute o seguinte comando no Prompt de Comando para acessar a pasta do repositório.

    cd <diretório do repositório>\store

#### 1. Uma vez que esteja na pasta \store, execute o comando para instalação do Composer no diretório.

	composer install

#### 2. Execute o comando para gerar a **chave de segurança**.

    php artisan key:generate

##### 2.1: Após executar o comando, o arquivo **.env** do diretório será alterado, passando a constar na sua variável **APP_KEY** a sua chave de segurança, essa chave é importante pois será a responsável por criptografar o tráfego de dados da aplicação.

#### 3. Execute o comando para criar as tabelas do banco de dados.

	php artisan migrate

##### 3.1: Com a adição do comando `--seed` serão populadas as tabelas products e carts, com o intuito de testar os GETs da aplicação.

    php artisan migrate --seed

#### 4. Execute o comando para inicialização do ambiente.
	
    php artisan serve

#### 5. (OPCIONAL) Para fins de testes, através do Postman utilize as rotas para enviar requisições POST para popular as tabelas, e GET para validar os retornos. 

[1]: https://www.mysql.com/downloads/
[2]: https://getcomposer.org/
[3]: https://www.getpostman.com/
