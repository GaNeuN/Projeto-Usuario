# 📋 Projeto Usuário

Sistema completo de **cadastro, listagem, edição e exclusão de usuários**, utilizando:
- ⚛️ Frontend em React
- 🐘 Backend em Hyperf (PHP 8.1)
- 🐬 Banco de dados MySQL
- 🐳 Contêineres Docker para orquestração

Este projeto foi desenvolvido como parte de um processo seletivo técnico, com foco em apresentar uma solução funcional e modular, respeitando boas práticas de desenvolvimento fullstack e integração entre camadas.

---

## ✨ Funcionalidades

- ✅ Listagem de usuários
- ✅ Cadastro de novos usuários
- ✅ Edição de usuários existentes
- ✅ Exclusão de usuários
- ✅ Integração entre frontend React e API Hyperf
- ✅ Banco de dados MySQL com persistência em Docker

---

## 🧠 Tecnologias utilizadas

| Camada | Ferramentas |
|--------|-------------|
| Frontend | React, Axios, React-Query |
| Backend | PHP 8.1, Hyperf Framework |
| Banco de dados | MySQL 8 |
| Containerização | Docker, Docker Compose |

---

## 📂 Estrutura do Projeto

```
Projeto-Usuario/
│
├── backend/          # API Hyperf (PHP)
│   ├── app/
│   ├── config/
│   └── ...
│
├── frontend/         # Aplicação React
│   ├── src/
│   ├── public/
│   └── ...
│
├── docker-compose.yml
└── README.md
```

---

## 🚀 Como executar o projeto

### Pré-requisitos:
- Docker e Docker Compose instalados.

### Passos:

```bash
# Clone o repositório
git clone https://github.com/GaNeuN/Projeto-Usuario.git
cd Projeto-Usuario

# Suba os containers
docker-compose up -d
```

- Acesse o frontend em: `http://localhost:5173`
- Acesse o backend (API) em: `http://localhost:9501`

---

## 📬 Endpoints da API

| Método | Rota               | Descrição                 |
|--------|--------------------|---------------------------|
| GET    | /usuarios/listar   | Lista todos os usuários   |
| POST   | /usuarios/salvar   | Cria um novo usuário      |
| POST    | /usuarios/editar   | Edita um usuário existente|

> 💡 A comunicação é feita em JSON. Para testar, você pode usar Postman ou Insomnia.

---

## 🧠 Diferenciais

- Projeto dockerizado e separado por camadas
- Integração fluida entre React e Hyperf
- Arquitetura clara e extensível para escalar

---

## 👤 Autor

Guilherme Neuenfeldt  
