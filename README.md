# API CRUD Simples Pessoas

## Tecnologias

## Objetivo

## Como rodar a API

1 - Clonar repositório
```
https://github.com/AkimGomes/people-manager.git
```

2 - Criar o ```.env``` a partir do ```.env.example```

3 - Gerar APP_KEY com o comando
```
php artisan key:generate
```

4 - Fazer o build dos serviços com o Docker
```
docker-compose up --build
```

5 - Depois de buildar, rodar as migrations do banco
```
docker-compose exec php php artisan migrate
```

## Rodar os testes unitários

1 - Rodar migrations do banco de testes usando o ```.env.testing```
```
docker-compose exec php php artisan migrate --env=testing
```

2 - Rodar os testes
```
docker-compose exec php php artisan test
```
