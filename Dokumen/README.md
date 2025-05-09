# Tugas Besar

## Struktur Folder Projek

    ci4-app/

│
├── app/ <-- Folder utama untuk logika aplikasi (MVC)
│ ├── Config/ <-- Konfigurasi aplikasi (routes, database, dll)
│ ├── Controllers/ <-- Controller (logic yang menangani request user)
│ ├── Database/
│ │ ├── Migrations/ <-- Struktur tabel database (mirip schema)
│ │ └── Seeds/ <-- Data awal / dummy ke database
│ ├── Filters/ <-- Filter request (middleware)
│ ├── Helpers/ <-- Fungsi bantu khusus aplikasi
│ ├── Language/ <-- File untuk multi-bahasa (localization)
│ ├── Libraries/ <-- Class PHP kustom buatan sendiri
│ ├── Models/ <-- Kelas yang mewakili tabel/database (ORM)
│ ├── Views/ <-- Template tampilan (HTML, Blade-style)
│ └── ... <-- File lainnya (Constants, Events, dll)
│
├── public/ <-- Web root (akses dari browser langsung ke sini)
│ ├── index.php <-- Entry point aplikasi
│ └── assets/ <-- CSS, JS, image (static files)
│
├── system/ <-- Core-nya CodeIgniter (JANGAN diubah)
│ └── ... <-- Semua file internal CI4 ada di sini
│
├── tests/ <-- Untuk unit testing (pakai PHPUnit)
│
├── vendor/ <-- Composer dependencies (otomatis generate)
│
├── writable/ <-- Tempat file runtime: cache, logs, session, dll
│ ├── cache/
│ ├── logs/
│ ├── session/
│ └── uploads/
│
├── .env <-- Konfigurasi environment (base URL, DB, dll)
├── composer.json <-- File untuk dependency management
├── phpunit.xml <-- Konfigurasi testing
└── README.md <-- Dokumentasi awal

##Penjelasan Singkat per Folder
