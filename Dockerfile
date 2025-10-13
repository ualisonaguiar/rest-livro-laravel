# Usar imagem oficial do PHP com Apache
FROM php:8.3-apache

RUN apt update && apt install -y \
    git \
    libpq-dev \
    zip \
    unzip \
    libzip-dev

# Instalar extensões PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql zip sockets \
    && docker-php-ext-enable pdo_mysql pdo_pgsql sockets

# Habilitar módulos necessários do Apache
RUN a2enmod headers rewrite

# Copiar config do Apache
COPY docker/apache/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Ajustar permissões para diretório storage
RUN mkdir -p /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/storage

EXPOSE 80
