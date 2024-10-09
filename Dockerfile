FROM php:8.0-apache

# PDO MySQL eklentisini yükle
RUN docker-php-ext-install pdo pdo_mysql

# Apache rewrite modunu aktif et
RUN a2enmod rewrite

# Apache ve PHP ayarlarını güncelle
COPY . /var/www/html/
