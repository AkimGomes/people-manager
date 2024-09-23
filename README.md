# API CRUD Simples Pessoas

## Tecnologias

- Laravel - Framework PHP utilizado para construir a API.
- MySQL - Banco de dados para armazenar dados do modelo Pessoas.

A aplicação utiliza Docker Compose para orquestrar os contêineres.

## Objetivo
O objetivo deste projeto é desenvolver uma API simples que implemente um CRUD (Criar, Ler, Atualizar, Deletar) para o modelo Pessoa. A API permitirá operações básicas de gerenciamento de dados, possibilitando a interação com informações de pessoas de maneira eficiente e organizada.

## Como rodar a API

1 - Baixar o PHP na máquina
```
https://www.php.net/manual/pt_BR/install.php
```

2 - Baixar o Composer na máquina
```
https://getcomposer.org/download/
```

3 - Baixar o Docker e o Docker Compose na máquina
#### Docker
```
https://docs.docker.com/get-started/get-docker/
```
#### Docker Compose
```
https://docs.docker.com/compose/install/
```

4 - Clonar repositório
```
https://github.com/AkimGomes/people-manager.git
```

5 - Acessar diretório do projeto no terminal
#### Exemplo
```
cd caminho/para/o/diretorio/people-manager
```

6 - Criar o ```.env``` a partir do ```.env.example```

7 - Gerar APP_KEY e aplicar no .env
```
php artisan key:generate --show
```

8 - Fazer o build dos serviços com o Docker
```
docker-compose up --build
```

9 - Depois de buildar, rodar as migrations do banco
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
