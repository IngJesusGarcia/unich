FROM php:8.2-apache

# Instala extensiones necesarias (opcional)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita el módulo rewrite de Apache (útil para frameworks o rutas amigables)
RUN a2enmod rewrite

# Copia el contenido de tu proyecto al directorio web
COPY . /var/www/html/

# Establece permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
