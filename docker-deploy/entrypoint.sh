#!/bin/sh
set -e

# Fungsi tunggu koneksi database PostgreSQL
wait_for_db() {
  echo "Menunggu database PostgreSQL di $DB_HOST:$DB_PORT..."
  until PGPASSWORD=$DB_PASSWORD psql -h "$DB_HOST" -U "$DB_USERNAME" -d "$DB_DATABASE" -c '\q' 2>/dev/null; do
    sleep 2
  done
  echo "Database siap!"
}

# Tunggu database
if [ -n "$DB_HOST" ]; then
  wait_for_db
fi

# Jalankan perintah Laravel optimasi & migrasi
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Pastikan symbolic link storage
php artisan storage:link --force || true

exec "$@"