FROM wordpress:6.4-php8.2-apache

# Copy custom themes, plugins, and uploads
COPY ./wordpress/wp-content /var/www/html/wp-content

# Tối ưu hóa cho Render (sử dụng cổng 80)
EXPOSE 80
