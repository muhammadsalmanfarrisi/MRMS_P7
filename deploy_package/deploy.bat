@echo off
setlocal enabledelayedexpansion

echo ============================================
echo    DEPLOY MRMS_SP7 KE SERVER UBUNTU
echo ============================================

:: ---------- KONFIGURASI SERVER (SESUAIKAN!) ----------
set SERVER_IP=192.168.1.100
set SERVER_USER=root
set SERVER_PATH=/home/user/mrms_sp7
set SSH_KEY=id_rsa.ppk
:: Ganti dengan path lengkap private key PuTTY, misal C:\Users\Teman\.ssh\id_rsa.ppk
:: Jika tidak pakai key, kosongkan dan gunakan password (tidak disarankan)

:: ---------- CEK DOCKER ----------
docker --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Docker tidak ditemukan. Pastikan Docker Desktop terinstall dan berjalan.
    pause
    exit /b 1
)

:: ---------- BUILD IMAGE ----------
echo [1/6] Membangun Docker image...
docker build -t mrms_sp7:latest .
if %errorlevel% neq 0 (
    echo [ERROR] Gagal build image.
    pause
    exit /b 1
)

:: ---------- SAVE IMAGE KE .TAR ----------
echo [2/6] Mengekspor image ke mrms_sp7.tar...
docker save -o mrms_sp7.tar mrms_sp7:latest
if %errorlevel% neq 0 (
    echo [ERROR] Gagal menyimpan image.
    pause
    exit /b 1
)

:: ---------- UPLOAD FILE KE SERVER ----------
echo [3/6] Mengunggah file ke server...
:: Upload tar image
pscp -i "%SSH_KEY%" mrms_sp7.tar %SERVER_USER%@%SERVER_IP%:%SERVER_PATH%/
if %errorlevel% neq 0 (
    echo [ERROR] Gagal upload mrms_sp7.tar.
    pause
    exit /b 1
)

:: Upload docker-compose.yml
pscp -i "%SSH_KEY%" docker-compose.yml %SERVER_USER%@%SERVER_IP%:%SERVER_PATH%/
if %errorlevel% neq 0 (
    echo [ERROR] Gagal upload docker-compose.yml.
    pause
    exit /b 1
)

:: Upload folder nginx (termasuk default.conf)
pscp -i "%SSH_KEY%" -r nginx %SERVER_USER%@%SERVER_IP%:%SERVER_PATH%/
if %errorlevel% neq 0 (
    echo [ERROR] Gagal upload konfigurasi nginx.
    pause
    exit /b 1
)

:: Upload .env (pastikan sudah diisi sebelumnya)
echo [4/6] Mengunggah .env...
pscp -i "%SSH_KEY%" .env %SERVER_USER%@%SERVER_IP%:%SERVER_PATH%/
if %errorlevel% neq 0 (
    echo [ERROR] Gagal upload .env.
    pause
    exit /b 1
)

:: ---------- LOAD IMAGE & JALANKAN CONTAINER ----------
echo [5/6] Menjalankan perintah di server...
plink -i "%SSH_KEY%" -batch %SERVER_USER%@%SERVER_IP% "cd %SERVER_PATH% && docker load -i mrms_sp7.tar && docker compose down --remove-orphans && docker compose up -d && sleep 5 && docker compose exec -T app php artisan migrate --force && docker compose exec -T app php artisan config:cache && docker compose exec -T app php artisan route:cache && docker compose exec -T app php artisan view:cache && docker compose exec -T app php artisan storage:link --force"
if %errorlevel% neq 0 (
    echo [ERROR] Ada masalah saat menjalankan perintah remote.
    pause
    exit /b 1
)

:: ---------- SELESAI ----------
echo [6/6] Deploy selesai!
echo Aplikasi dapat diakses di http://%SERVER_IP%
pause