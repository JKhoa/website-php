#!/bin/bash

echo "🚀 Khởi động WordPress với Docker..."
echo ""

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker không chạy. Vui lòng khởi động Docker Desktop."
    exit 1
fi

# Create wordpress directory if not exists
if [ ! -d "wordpress" ]; then
    echo "📁 Tạo thư mục WordPress..."
    mkdir -p wordpress
fi

echo "🐳 Chạy Docker Compose..."
docker-compose up -d

echo ""
echo "⏳ Chờ WordPress khởi động (30 giây)..."
sleep 30

echo ""
echo "✅ WordPress đã khởi động!"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🌐 Website: http://localhost"
echo "📊 Admin: http://localhost/wp-admin"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "📊 Database:"
echo "   Host: db:3306"
echo "   User: wordpress"
echo "   Password: wordpress_password_123"
echo "   Database: wordpress"
echo ""
echo "🛠️ Câu lệnh hữu ích:"
echo "   Xem log: docker-compose logs -f wordpress"
echo "   Dừng: docker-compose down"
echo "   Khởi động lại: docker-compose restart"
echo ""
