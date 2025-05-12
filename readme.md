# 📦 Product Registration and Listing SPA (Laravel 6.2)

This project is a **single-page application** built with Laravel 6.2 for the main flow of **product registration and listing**, featuring:

- Product registration with **name**, **category**, and **price**;
- Dynamic listing display;
- Responsive user interface.s

---

## 🔧 Requirements

Make sure the following tools are installed on your machine:

- [XAMPP 7.3.33](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.3.33/) (PHP 7.3, MySQL)
- [Composer](https://getcomposer.org/)
- [Node.js e NPM](https://nodejs.org/)
- Git

---

## ⚙️ Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/bianca-martinsg/spa.git
```

### 2. Move the project to your XAMPP htdocs directory
```bash
mv seu-repositorio /caminho/para/xampp/htdocs/
```

### 3. Navigate to the project folder
```bash
cd /caminho/para/xampp/htdocs/seu-repositorio
```

### 4. Install PHP dependencies
```bash
composer install
```

### 5. Copy the .env file
```bash
cp .env.example .env
```

### 6. Generate the application key
```bash
php artisan key:generate
```

### 7. Create the database
You can create the database in two ways:

- Option 1 — Manually via phpMyAdmin:
    Go to http://localhost/phpmyadmin and create a new database with the name defined in your .env (e.g., spa)
    Crie um banco com o nome definido no .env (ex: spa)

- Option 2 — Automatically with an Artisan command:
After setting up your .env file, run:
```bash
php artisan db:create
```

### 8. Configure the .env file
```bash
DB_DATABASE=spa
DB_USERNAME=root
DB_PASSWORD=
```

### 9. Run the migrations
```bash
php artisan migrate
```

### 10. Run the seeders
```bash
php artisan db:seed
```

### 11. Start the Laravel development server
```bash
php artisan serve
```
Visit the app at: http://localhost:8000

### 12. Install and compile front-end assets
```bash
npm install --force
npm run dev
```
To watch for changes and auto-compile:
```bash
npm run watch
```
