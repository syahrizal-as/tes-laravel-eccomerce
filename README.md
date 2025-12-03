# Laravel 10 - PostgreSQL Starter Project

Project Laravel 10 dengan PostgreSQL sebagai database, dilengkapi dengan authentication, role & permission management, dan fitur e-commerce dasar.

## 📋 Requirements

- PHP >= 8.1
- Composer
- PostgreSQL >= 12
- Node.js & NPM

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/syahrizal-as/tes-laravel-eccomerce.git
cd tes-laravel-eccomerce
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

```

### 3. Setup Environment

```bash
# Copy file .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database PostgreSQL

Buka file `.env` dan sesuaikan konfigurasi database PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database_anda
DB_USERNAME=postgres
DB_PASSWORD=password_anda
```

> **Catatan:** Pastikan database PostgreSQL sudah dibuat terlebih dahulu sebelum menjalankan migration.

### 5. Membuat Database PostgreSQL

Buat database baru di PostgreSQL:

```bash
# Login ke PostgreSQL
psql -U postgres

# Buat database baru
CREATE DATABASE nama_database_anda;

# Keluar dari PostgreSQL
\q
```

Atau gunakan pgAdmin atau tools GUI PostgreSQL lainnya untuk membuat database.

### 6. Jalankan Migration

```bash
php artisan migrate
```

Migration akan membuat tabel-tabel berikut:
- `users` - Tabel pengguna
- `password_reset_tokens` - Token reset password
- `failed_jobs` - Log job yang gagal
- `personal_access_tokens` - Token untuk API authentication (Sanctum)
- `roles` & `permissions` - Tabel role dan permission (Spatie Permission)
- `model_has_roles` & `model_has_permissions` - Relasi role & permission
- `products` - Tabel produk
- `carts` - Tabel keranjang belanja
- `transactions` - Tabel transaksi
- `transaction_details` - Detail transaksi
- `images` - Tabel gambar/foto

### 7. Jalankan Seeder

```bash
php artisan db:seed
```

Atau jalankan seeder spesifik:

```bash
# Seeder untuk roles
php artisan db:seed --class=RolesTableSeeder

# Seeder untuk permissions
php artisan db:seed --class=PermissionsTableSeeder

# Seeder untuk user
php artisan db:seed --class=UserTableSeeder
```

**Default User Credentials:**
- Email: `superadmin@gmail.com`
- Password: `11111111`
- Role: `admin`

### 8. Setup Storage Link

```bash
php artisan storage:link
```


### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📦 Packages yang Digunakan

### Dependencies Utama
- **Laravel Framework** `^10.10` - Framework PHP
- **Laravel Fortify** `^1.17` - Authentication backend
- **Laravel Sanctum** `^3.2` - API authentication
- **Spatie Laravel Permission** `^5.10` - Role & Permission management
- **Yajra DataTables** `^10.0` - Server-side DataTables


## 🗂️ Struktur Database

### Tabel Utama

#### Users
Tabel untuk menyimpan data pengguna dengan fitur two-factor authentication.

#### Products
Tabel untuk menyimpan data produk e-commerce.

#### Carts
Tabel untuk menyimpan item keranjang belanja pengguna.

#### Transactions
Tabel untuk menyimpan data transaksi pembelian.

#### Transaction Details
Tabel detail item yang dibeli dalam setiap transaksi.

#### Images
Tabel untuk menyimpan path gambar/foto produk atau lainnya.

## 🔐 Authentication & Authorization

Project ini menggunakan:
- **Laravel Fortify** untuk authentication (login, register, password reset, dll)
- **Spatie Permission** untuk role-based access control (RBAC)

### Default Roles
- `admin` - Role administrator dengan semua permission

## 🛠️ Helper Functions

Project ini memiliki custom helper functions yang di-autoload melalui `composer.json`:
- File: `app/Helper/helpers.php`

## 📝 Catatan Penting

1. **PostgreSQL vs MySQL**: Project ini dikonfigurasi untuk PostgreSQL. Jika ingin menggunakan MySQL, ubah `DB_CONNECTION=mysql` di file `.env` dan sesuaikan konfigurasi database.

2. **File Upload**: Pastikan folder `storage/app/public` memiliki permission yang tepat untuk upload file.

3. **Environment**: Jangan lupa ubah `APP_ENV=production` dan `APP_DEBUG=false` saat deploy ke production.

4. **Security**: Ganti `APP_KEY` dan semua credentials default sebelum deploy ke production.

