#!/bin/bash

# ========== Konfigurasi ==========
# Folder lokal Laravel kamu (jika ingin backup atau referensi, tapi tidak dipakai di script ini)
LOCAL_DIR=~/laravel-d4rpl2c-kelompok9/

# Folder tujuan di server (HARUS cocok dengan target rsync dan server path di GitHub Actions)
REMOTE_DIR=/var/www/laravel-d4rpl2c-kelompok9/

# Ganti sesuai user dan IP/hostname server
REMOTE_USER=your_user
REMOTE_HOST=your.server.ip.or.hostname

# ========== Deploy Command ==========
echo "Mulai proses deployment ke $REMOTE_HOST..."

ssh $REMOTE_USER@$REMOTE_HOST << EOF
    echo "Masuk ke direktori aplikasi..."
    cd $REMOTE_DIR || exit

    echo "Membuat struktur folder storage jika belum ada..."
    mkdir -p storage/framework/{cache,sessions,testing,views}
    mkdir -p storage/logs

    echo "Mengatur hak akses folder..."
    sudo chown -R www-data:www-data storage bootstrap/cache
    sudo chmod -R 775 storage bootstrap/cache

    echo "Membersihkan cache Laravel..."
    php artisan config:clear
    php artisan cache:clear
    php artisan view:clear

    echo "Deployment selesai."
EOF
