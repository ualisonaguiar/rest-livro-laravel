# Usar imagem oficial do PHP com Apache
FROM php:8.3-apache

RUN apt update && apt install -y git libpq-dev

# Habilitar módulos necessários do Apache
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql \
    && docker-php-ext-enable pdo_mysql pdo_pgsql

RUN a2enmod headers

# Copiando o arquivo de configuração do Apache
COPY docker/apache/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Ativar mod_rewrite (muito usado em frameworks PHP)
RUN a2enmod rewrite

RUN mkdir -p /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/storage

# Expor a porta padrão do Apache
EXPOSE 80
