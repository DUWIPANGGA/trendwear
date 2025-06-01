#!/bin/bash

# Folder lokal Laravel kamu (sesuaikan)
LOCAL_DIR=~/laravel-d4rpl2c-kelompok9/

# Folder tujuan di server
REMOTE_DIR=/var/www/laravel-d4rpl2c-kelompok9/

# User dan host server produksi (ubah sesuai server kamu)
REMOTE_USER=your_user
REMOTE_HOST=your.server.ip.or.hostname


echo "Membuat folder storage/framework di server..."

ssh $REMOTE_USER@$REMOTE_HOST << EOF
    cd $REMOTE_DIR || exit

    mkdir -p storage/framework/{cache,sessions,testing,views}
    mkdir -p storage/logs
    
    sudo chown -R www-data:www-data storage
    sudo chmod -R 775 storage
    
    # Clear cache Laravel (optional tapi direkomendasi)
    php artisan config:clear
    php artisan cache:clear
    php artisan view:clear
    
    echo "Deploy selesai."
EOF
