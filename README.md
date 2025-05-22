# 📙 Aplikasi Jadwal Sidang

Aplikasi ini terdiri dari dua bagian utama:

* *Backend* → [PBF (CodeIgniter 4)](https://github.com/Alledanaralle/PBF.git)
* *Frontend* → [frontend\_tugas (Laravel 10 + TailwindCSS)](https://github.com/JosindoRadit/frontend_tugas.git)

---

## 🧹 Alur Instalasi Lengkap

Langkah-langkah instalasi dimulai dari backend (CI4) lalu frontend (Laravel 10).

---

## 💻 1. Setup Backend (CodeIgniter 4)

### 📦 Clone Repositori Backend

bash
git clone https://github.com/Alledanaralle/PBF.git
cd PBF


### 📁 Salin File .env

bash
cp env .env


### ⚙ Konfigurasi File .env

Edit file .env untuk menyesuaikan koneksi database lokal:

env
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = jadwal_sidang
database.default.username = root
database.default.password = 


> Ganti konfigurasi database sesuai dengan setting lokal kamu.

### 🛂 Import Database

1. Buat database baru dengan nama jadwal_sidang
2. Import file SQL jika tersedia di repo (biasanya database/jadwal_sidang.sql atau sejenisnya)

### 📦 Install Dependency CI4

bash
composer install


### 🚀 Jalankan Backend Server

bash
php spark serve


> Default backend dapat diakses di http://localhost:8080

---

## 🌐 2. Setup Frontend (Laravel 10 + TailwindCSS)

### 📦 Clone Repositori Frontend

bash
git clone https://github.com/JosindoRadit/frontend_tugas.git
cd frontend_tugas


### 📁 Salin dan Konfigurasi .env

bash
cp .env.example .env
php artisan key:generate


Edit file .env untuk mengatur URL aplikasi dan API:

env
APP_URL=http://localhost:8000
API_URL=http://localhost:8080


> API_URL digunakan untuk melakukan request ke backend CI4

### 📦 Install Dependency Laravel

bash
composer install


### 📦 Install Tailwind CSS

bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p


### ⚙ Konfigurasi tailwind.config.js

js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}


### ✏ Tambahkan Direktif Tailwind di resources/css/app.css

css
@tailwind base;
@tailwind components;
@tailwind utilities;


### 🚀 Build Asset Tailwind

bash
npm install
npm run dev


> Untuk build versi production: npm run build

### ▶ Jalankan Frontend Laravel

bash
php artisan serve


Frontend Laravel akan berjalan di:


http://localhost:8000


---

## 🔗 Konsumsi API dari Backend

Gunakan fetch atau axios di frontend untuk mengakses endpoint backend CI4.

### Contoh (JavaScript di Blade):

html
<script>
fetch("http://localhost:8080/dosen")
  .then(res => res.json())
  .then(data => console.log(data));
</script>


### ⚠ Pastikan CORS Aktif di Backend CI4

Tambahkan header ini di controller atau middleware CI4:

php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


---

## 📁 Struktur Folder

### Backend (CodeIgniter 4)


PBF/
├── app/
├── public/
├── writable/
└── .env


### Frontend (Laravel 10)


frontend_tugas/
├── app/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── .env
└── tailwind.config.js


---

## 📌 Tips Tambahan

* Simpan URL API di file config/api.php agar bisa diakses global
* Gunakan .env untuk mengelola konfigurasi environment
* Tambahkan fitur autentikasi jika diperlukan di sisi frontend/backend

---

## 📝 Lisensi

Proyek ini open-source dan dapat digunakan untuk pembelajaran atau pengembangan lanjutan.
