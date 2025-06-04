FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Habilita mod_rewrite
RUN a2enmod rewrite

# Copia el código al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Puerto por defecto
EXPOSE 80
