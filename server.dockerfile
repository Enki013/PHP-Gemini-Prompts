FROM php:latest

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80"]
