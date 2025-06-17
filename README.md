# Para rodar a aplicação, siga o passo a passo

## Esse projeto tem como finalidade a criação de uma aplicação Laravel que permita cadastrar e listar **endereços de usuários**, consumindo a API pública do [ViaCEP](https://viacep.com.br/) para preencher os dados de endereço a partir do CEP informado.

### Tecnologias utilizadas

- **`Laravel 11`**
- **`MySQL`**
- **`Docker`**

## Clone o repositório

```bash
git clone https://github.com/rafPH1998/teste-smartlead.git
```

## Acesse a pasta

```bash
cd teste-smartlead
```
Suba os containers do projeto
```sh
docker-compose up -d
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```

Caso gerar erro ao rodar o comando, pode ser erro de permissão, caso aconteça, saia do container, escrava EXIT e em seguida rode o comando abaixo para dar as permissões:
```sh
sudo chmod -R 777 .
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Rodar as migrations
```sh
php artisan migrate
```

Rode o comando para gerar os seed e dados ficticios
```sh
php artisan db:seed
```

Rode o comando para executar os testes
```sh
php artisan test
```


Acesse o projeto por padrão na porta 8000
[http://localhost:8000/users](http://localhost:8000/users)

