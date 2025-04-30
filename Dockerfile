# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Copia todos los archivos del proyecto al servidor web
COPY . /var/www/html/

# Asigna los permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Render usa el puerto 10000 internamente, pero no hace falta exponerlo manualmente
EXPOSE 80
