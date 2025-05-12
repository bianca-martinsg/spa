# 📦 SPA de Cadastro e Listagem de Produtos (Laravel 6.2)

Este projeto é uma aplicação **single-page** desenvolvida com Laravel 6.2 para fluxo principal de **cadastro e listagem de produtos**, contendo as seguintes funcionalidades:

- Cadastro de produtos com **nome**, **categoria** e **preço**;
- Exibição em listagem dinâmica;
- Interface responsiva.

---

## 🔧 Requisitos

Antes de iniciar o projeto, verifique se as seguintes ferramentas estão instaladas:

- [XAMPP 7.3.33](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.3.33/) (PHP 7.3, MySQL)
- [Composer](https://getcomposer.org/)
- [Node.js e NPM](https://nodejs.org/)
- Git

---

## ⚙️ Passo a passo para rodar o projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/bianca-martinsg/spa.git
```

### 2. Mover o projeto para o diretório do XAMPP
```bash
mv seu-repositorio /caminho/para/xampp/htdocs/
```

### 3. Acesse a pasta do projeto
```bash
cd /caminho/para/xampp/htdocs/seu-repositorio
```

### 4. Instale as dependências PHP
```bash
composer install
```

### 5. Copie o arquivo .env
```bash
cp .env.example .env
```

### 6. Gere a chave da aplicação
```bash
php artisan key:generate
```

### 7. Criar o banco de dados
Você pode criar o banco de dados de duas formas:

- Opção 1 — Manual via phpMyAdmin:
    Acesse: http://localhost/phpmyadmin
    Crie um banco com o nome definido no .env (ex: spa)

- Opção 2 — Automática com comando Artisan:
    Após configurar o .env, rode o seguinte comando:
```bash
php artisan db:create
```

### 8. Verifique o .env
```bash
DB_DATABASE=spa
DB_USERNAME=root
DB_PASSWORD=
```

### 9. Execute as migrações
```bash
php artisan migrate
```

### 10. Execute os seeders
```bash
php artisan db:seed
```

### 11. Execute o servidor Laravel
```bash
php artisan serve
```

### 12. Compile os assets do front-end
```bash
npm install
npm run dev
```
Para compilar automaticamente ao alterar arquivos:
```bash
npm run watch
```
