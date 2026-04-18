FROM wordpress:6.4-php8.2-apache

# Sao chép toàn bộ thư mục wordpress của bạn vào máy chủ
COPY ./wordpress /var/www/html

# Phân quyền cho Apache truy cập file
RUN chown -R www-data:www-data /var/www/html

# Cổng mặc định
EXPOSE 80
