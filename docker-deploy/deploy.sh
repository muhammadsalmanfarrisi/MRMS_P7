#!/bin/bash
set -e

echo "===== DEPLOY LARAVEL DOCKER - MRMS_SP7 ====="

# 1. Pastikan .env ada
if [ ! -f .env ]; then
    echo "File .env tidak ditemukan, membuat dari .env.example..."
    cp .env.example .env
    echo "Silakan edit .env dengan nilai production yang benar, lalu jalankan ulang script ini."
    exit 1
fi

# 2. Build image
echo "Membangun image Docker..."
docker compose build

# 3. Hentikan container lama jika ada
docker compose down

# 4. Jalankan semua service
echo "Menjalankan container..."
docker compose up -d

# 5. Tunggu beberapa saat agar database siap
echo "Menunggu database siap (10 detik)..."
sleep 10

# 6. Jalankan migrasi dan optimasi (optional, karena entrypoint sudah menjalankannya saat container app start)
echo "Menjalankan migrasi & cache..."
docker compose exec -T app php artisan migrate --force
docker compose exec -T app php artisan config:cache
docker compose exec -T app php artisan route:cache
docker compose exec -T app php artisan view:cache
docker compose exec -T app php artisan storage:link --force || true

echo "===== DEPLOY SELESAI ====="
echo "Akses aplikasi di http://<IP-SERVER>"
echo "Gunakan 'docker compose logs -f' untuk melihat log."