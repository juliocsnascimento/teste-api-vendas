
# Setup Docker

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/juliocsnascimento/teste-api-vendas.git
```

Entre na pasta
```sh
cd projects/api
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=tray
DB_USERNAME=devuser
DB_PASSWORD=dev123456

```

Suba os containers do projeto
```sh
docker-compose up -d
```

# API

Acessar o container
```sh
docker-compose exec app bash
```

Entre na pasta
```sh
cd projects/api
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Gerar tabelas no banco de dados
```sh
php artisan migrate
```

Acessar o projeto
[http://localhost:8080](http://localhost:8080)

## APP
Entre na pasta
```sh
cd projects/app
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Acessar o projeto
[http://localhost:8080](http://localhost:8080)



