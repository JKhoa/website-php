@echo off
chcp 65001 >nul
title WordPress Portfolio Theme - Docker Startup

echo.
echo 🚀 Khởi động WordPress với Docker...
echo.

REM Check if Docker is running
docker --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Docker không được cài đặt hoặc không chạy.
    echo Vui lòng:
    echo   1. Cài đặt Docker Desktop: https://www.docker.com/products/docker-desktop
    echo   2. Khởi động Docker Desktop
    pause
    exit /b 1
)

REM Create wordpress directory if not exists
if not exist "wordpress" (
    echo 📁 Tạo thư mục WordPress...
    mkdir wordpress
)

echo 🐳 Chạy Docker Compose...
docker-compose up -d

if errorlevel 1 (
    echo ❌ Lỗi khi khởi động Docker Compose
    pause
    exit /b 1
)

echo.
echo ⏳ Chờ WordPress khởi động (30 giây)...
timeout /t 30 /nobreak

echo.
echo ✅ WordPress đã khởi động!
echo.
echo ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
echo 🌐 Website:      http://localhost
echo 📊 Admin Panel:  http://localhost/wp-admin
echo ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
echo.
echo 📊 Database:
echo    Host:     db:3306
echo    User:     wordpress
echo    Password: wordpress_password_123
echo    Database: wordpress
echo.
echo 🛠️  Câu lệnh hữu ích:
echo    Xem log:  docker-compose logs -f wordpress
echo    Dừng:     docker-compose down
echo    Khởi động lại: docker-compose restart
echo.
pause
