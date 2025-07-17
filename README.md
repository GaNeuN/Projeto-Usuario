# Projeto Usuário

Este projeto é uma aplicação full-stack que demonstra a integração de um backend desenvolvido com Hyperf (PHP) e um frontend construído com React, utilizando React Query para gerenciamento de estado. A aplicação é conteinerizada com Docker para facilitar o desenvolvimento e a implantação.

## Tecnologias Utilizadas

- **Backend**: Hyperf (PHP), Swoole, MySQL
- **Frontend**: React, React Query, JavaScript
- **Orquestração**: Docker, Docker Compose

## Estrutura do Projeto

O projeto é dividido em três diretórios principais:

- `backend/`: Contém o código-fonte da aplicação Hyperf.
- `frontend/`: Contém o código-fonte da aplicação React.
- `docker-compose.yml`: Define os serviços Docker para o banco de dados (MySQL), backend e frontend.

## Instalação e Configuração

Para colocar o projeto em funcionamento, siga os passos abaixo:

### Pré-requisitos

Certifique-se de ter o Docker e o Docker Compose instalados em sua máquina. Você pode baixá-los em [https://www.docker.com/get-started](https://www.docker.com/get-started).

### 1. Clonar o Repositório

```bash
git clone https://github.com/GaNeuN/Projeto-Usuario.git
cd Projeto-Usuario
```

### 2. Configurar o Ambiente

O arquivo `docker-compose.yml` já está configurado para iniciar todos os serviços necessários. Ele define:

- Um serviço `mysql` utilizando a imagem `mysql:8`.
- Um serviço `backend` baseado na imagem `hyperf/hyperf:8.2-alpine-v3.21-swoole-v6.0`, mapeando a porta `9501`.
- Um serviço `frontend` que constrói a imagem a partir do `Dockerfile` no diretório `frontend/`, mapeando a porta `3000`.

### 3. Iniciar os Serviços Docker

No diretório raiz do projeto, execute o seguinte comando para iniciar todos os contêineres:

```bash
docker-compose up -d
```

Isso irá baixar as imagens necessárias, construir a imagem do frontend e iniciar os serviços em segundo plano.

### 4. Acessar a Aplicação

- **Backend**: A API do backend estará disponível em `http://localhost:9501`.
- **Frontend**: A aplicação React estará acessível em `http://localhost:3000`.

## Uso

Após a instalação e configuração, você pode interagir com a aplicação:

- Navegue para `http://localhost:3000` no seu navegador para acessar a interface do usuário.
- O frontend se comunicará com o backend na porta `9501` para buscar e enviar dados.

## Desenvolvimento

### Backend (Hyperf)

Para desenvolver no backend, você pode acessar o contêiner do backend:

```bash
docker-compose exec backend bash
```

Dentro do contêiner, você pode executar comandos Hyperf, como iniciar o servidor de desenvolvimento (embora o `docker-compose up` já faça isso):

```bash
php bin/hyperf.php start
```

Consulte o `backend/README.md` original para mais detalhes sobre o desenvolvimento com Hyperf.

### Frontend (React)

Para desenvolver no frontend, o Docker Compose já mapeia o diretório `frontend/` para dentro do contêiner, permitindo que você veja as mudanças em tempo real. Se precisar executar comandos npm diretamente no contêiner do frontend:

```bash
docker-compose exec frontend bash
```

Dentro do contêiner, você pode executar comandos como:

```bash
npm start
npm test
npm run build
```

Consulte o `frontend/README.md` original para mais detalhes sobre o desenvolvimento com Create React App.

